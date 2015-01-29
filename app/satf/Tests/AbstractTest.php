<?php

namespace SimpleATF\Tests;

use GuzzleHttp\Client;
use Exception;

abstract class AbstractTest
{
    /**
     * Guzzle Http Client.
     * @var Client
     */
    public $guzzle;
    /**
     * Test Case.
     * @var
     */
    public $test;

    public function __construct($test)
    {
        $this->guzzle = new Client();
        $this->test = $test;
    }

    public function getStatusCode()
    {
        $response = $this->getResponse();
        return $response->getStatusCode();
    }

    public function getBody()
    {
        $response = $this->getResponse();
        return $response->getBody();
    }

    public function getJson()
    {
        $response = $this->getResponse();
        return $response->json();
    }

    public function getResponse()
    {
        $url = $this->getUrl();
        $response = $this->guzzle->get($url);
        return $response;
    }

    /**
     * Get the URL from the current testcase.
     * @return mixed
     */
    public function getUrl()
    {
        $test = $this->test;
        return $test->buildUrl();
    }
}