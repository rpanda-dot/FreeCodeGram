<?php

namespace Raja\QuickMetrics;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class QuickMetrics
{
    public static function event(string $name, float $val, ?string $dimention = null)
    {
        $client = new Client([
            'base_uri' => 'https://qckm.io/',
        ]);
        $json = [
            'name' => $name,
            'val' => $val
        ];
        // dd($json);
        if ($dimention) {
            $json['dimension'] = $dimention;
        }
        try {
            $res = $client->request('post', '/json', [
                'json' => $json,
                'headers' => [
                    'x-qm-key' => config('quickmetrics.key')
                ]
            ]);
            return response()->json([
                'code' => $res->getStatusCode(),
                'message' => $res->getReasonPhrase()
            ]);
        } catch (GuzzleException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 500
            ]);
        }
        // return $name . '--' . $val;
    }
}
