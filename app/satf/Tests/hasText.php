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
    /**
     * Run the test.
     * @return bool
     */
    public function test()
    {
        $test = $this->test;
        $result = strpos($this->getResponse(), $test->expectation);
        return $result !== false;
    }
}