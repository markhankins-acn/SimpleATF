<?php

namespace SimpleATF\Tests;

/**
 * Class hasText
 * Determine if a target string has given text.
 *
 * @package SimpleATF\Tests
 */
class hasText extends AbstractTest implements TestInterface
{
    public $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    public function test()
    {
        $test = $this->test;
        $result = strpos($this->getResponse(), $test->expectation);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function getResponse()
    {
        $test = $this->test;
        $url = $test->buildUrl();
        \Log::info($url);
        $data = $this->getdata($url);
        \Log::info($data);
        return $data;
    }
}