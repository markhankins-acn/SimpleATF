<?php

/**
 * Class TestController
 */
class TestController extends BaseController
{
    public function runTest()
    {
        $testcase_id = Input::get('testcase_id');
        \Log::info('Running test for testcase: ' . $testcase_id);
        $test = TestCase::where('id', $testcase_id)->firstOrFail();

        $testType = new TestType();
        $testType->idToName($test->type_id);

        /* Run the test */
        $result = $this->test($test, $testType);
        if ($result === false) {
            return \Response::make("Fail", 400);
        } else {
            return \Response::make("Success", 200);
        }
    }

    public function test($test, $type)
    {
        switch ($type) {
            case 'hasText':
                $class = new SimpleATF\Tests\hasText();
                return $class->test($test->url, $test->expectation);
                break;
            case 'idHasText':
                return new SimpleATF\Tests\hasText();
                break;
        }
    }
}