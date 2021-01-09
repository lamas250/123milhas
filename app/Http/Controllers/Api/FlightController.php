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

        $array = json_decode($request->getBody(),true);

        return $array;
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

    public function setGroups()
    {
        $allFligths = $this->getApiData();

        $inbound = $this->inboundFlights($allFligths);
        $outbound = $this->outboundFlights($allFligths);

        $groupInbound = array();
        $groupOutbound = array();

        foreach($inbound as $flight)
        {
            $groupInbound[$flight['fare']][$flight['price']][] = $flight;
        }

        foreach($outbound as $flight)
        {
            $groupOutbound[$flight['fare']][$flight['price']][] = $flight;
        }

        dd($groupInbound);
        // return $groupInbound;
    }


}
