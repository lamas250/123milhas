<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;

class FlightController extends Controller
{
    private $baseUrl = "http://prova.123milhas.net/api/flights";

    public function getApiData($query = null)
    {
        $client = new Client();
        $request = $client->request('GET', $this->baseUrl . $query);

        try {
            $array = json_decode($request->getBody(),true);

            return $array;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getType($query)
    {
        try {
            $typeFlights = [];
                $query = "?" . $query . "=1";
                $typeFlights = $this->getApiData($query);
                
                return $typeFlights;
        }catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }

    public function inboundFlights()
    {
        $inbound = $this->getType('inbound');

        return $inbound;
    }

    public function outboundFlights()
    {
        $outbound = $this->getType('outbound');

        return $outbound;
    }
    
    public function setGroups($flights)
    {
        $uniqueId = 0;

        $inbound = $this->inboundFlights($flights);
        $outbound = $this->outboundFlights($flights);

        $groupInbound = array();
        $groupOutbound = array();
        $groups = array();
        $group = array();

        foreach($inbound as $flight)
        {
            $groupInbound[$flight['fare']][$flight['price']][] = $flight;
        }

        foreach($outbound as $flight)
        {
            $groupOutbound[$flight['fare']][$flight['price']][] = $flight;
        }

        foreach($groupOutbound as $fare => $outPrice){
            $groupInboundFare = $groupInbound[$fare];
            if(!empty($groupInboundFare)){
                foreach($outPrice as $priceOUT => $grupoOUT){
                    foreach($groupInboundFare as $priceIN => $grupoIN){
                        $group['id'] = ++$uniqueId;
                        $group['price'] = $priceIN + $priceOUT;
                        $group['outboundsID'] = $grupoOUT;
                        $group['inboundsID'] = $grupoIN;

                        $groups[] = $group;
                    }
                }
            }
        }
        return $groups;
    }

    public function finalResult()
    {
        $flights = $this->getApiData();

        $flightsGroups = $this->setGroups($flights);
        usort($flightsGroups, function($a, $b) {
                return $a['price'] <=> $b['price'];
        });

        $finalResult = array();

        $finalResult['flights'] = $flights;
        $finalResult['groups'] = $flightsGroups;
        $finalResult['totalGroups'] = count($finalResult['groups']);
        $finalResult['totalFlights'] = count($finalResult['flights']);
        $finalResult['cheapestPrice'] = $finalResult['groups']['0']['price'];
        $finalResult['cheapestGroup'] = $finalResult['groups']['0']['id'];
        
        try {
            return response()->json([
                'message' => '',
                'data' => $finalResult,
                'result' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => '',
                'result' => false,
            ], 401);
        }
    }

}
