<?php

namespace SimpleATF\Tests;

use GuzzleHttp\Client;
use Exception;

abstract class AbstractTest
{
    public function getResponse()
    {
        try {
            $test = $this->test;
            $url = $test->buildUrl();
            $data = $this->getdata($url);
            return $data;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getdata($url)
    {
        return $this->guzzle($url);
    }

    private function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        $content = curl_exec ($ch);
        curl_close ($ch);
        return $content;
    }

    private function guzzle($url, $json = false)
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