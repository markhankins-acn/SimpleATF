<?php

namespace SimpleATF\Tests;

/**
 * Class hasText
 * Determine if a target string has given text.
 *
 * @package SimpleATF\Tests
 */
class hasText implements TestInterface
{
    public function test($target, $expectation)
    {
        $result = strpos($target, $expectation);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }
}