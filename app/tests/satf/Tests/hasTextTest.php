<?php

namespace SimpleATF\Tests\Tests;

use SimpleATF\Tests\TestCase;
use SimpleATF\Tests\hasText;

class hasTextTest extends TestCase
{
    public function testHasTextPasses()
    {
        $test = new hasText();
        $result = $test->test("I have a substring containing Spoons and other words", "Spoon");
        $this->assertTrue($result);
    }

    public function testHasTextFails()
    {
        $test = new hasText();
        $result = $test->test("I have different words", "Spoon");
        $this->assertTrue($result === false);
    }
}