<?php

namespace SimpleATF\Tests;

use SimpleATF\Iterators\JsonIterator;

class hasJson extends AbstractTest implements TestInterface
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
        $json_key_pattern = $test->selector;
        $json = $this->getJson();
        $value = $this->iterator->getKeyValue($json, $json_key_pattern);
        return $value == $test->expectation;
    }
}