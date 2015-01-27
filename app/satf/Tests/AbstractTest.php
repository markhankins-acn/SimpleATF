<?php

namespace SimpleATF\Tests;

use GuzzleHttp\Client;

abstract class AbstractTest
{
    public function getdata($url)
    {
        return $this->guzzle($url);
    }

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        $content = curl_exec ($ch);
        curl_close ($ch);
        return $content;
    }

    public function guzzle($url, $json = false)
    {
        $client = new Client();
        $response = $client->get($url);
        if ($json) {
            $json = $response->json();
            return $json;
        }
        return $response->getBody();
    }
}