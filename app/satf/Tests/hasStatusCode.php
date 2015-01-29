<?php

namespace SimpleATF\Tests;

/**
 * Class hasText
 * Determine if a target string has given text.
 *
 * @package SimpleATF\Tests
 */
class hasStatusCode extends AbstractTest implements TestInterface
{
    /**
     * Run the test.
     * @return bool
     */
    public function test()
    {
        $test = $this->test;
        $status = $this->getStatusCode();
        return $status == $test->expectation;
    }
}