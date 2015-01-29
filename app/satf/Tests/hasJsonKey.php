<?php

namespace SimpleATF\Tests;

use SimpleATF\Iterators\JsonIterator;

class hasJsonKey extends AbstractTest implements TestInterface
{
    public $iterator;

    public function __construct($test)
    {
        parent::__construct($test);
        $this->iterator = new JsonIterator();
    }

    public function test()
    {
        $test = $this->test;
        $json_key_pattern = $test->expectation;
        $json = $this->getJson();
        return $this->iterator->keyExists($json, $json_key_pattern);
    }
}