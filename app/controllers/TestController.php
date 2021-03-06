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
        $testclass = $testType->idToName($test->type_id);

        /* Run the test */
        $result = $this->test($test, $testclass);
        $result_json = json_encode(['url' => $test->buildUrl(), 'assertion' => $testclass, 'selector' => $test->selector, 'expectation' => $test->expectation, 'result' => $result]);
        if ($result === false) {
            return \Response::make($result_json, 200);
        } else {
            return \Response::make($result_json, 200);
        }
    }

    public function test($test, $type)
    {
        switch ($type) {
            case 'hasText':
                $class = new SimpleATF\Tests\hasText($test);
                return $class->test();
            case 'idHasText':
                $class = new SimpleATF\Tests\idHasText($test);
                return $class->test();
            case 'hasStatusCode':
                $class = new SimpleATF\Tests\hasStatusCode($test);
                return $class->test();
            case 'hasJsonKey':
                $class = new SimpleATF\Tests\hasJsonKey($test);
                return $class->test();
            case 'hasJson':
                $class = new SimpleATF\Tests\hasJson($test);
                return $class->test();
        }
    }
}