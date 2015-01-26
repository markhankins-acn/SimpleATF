<?php

class TestSuiteController extends BaseController
{
    public function show($id)
    {
        $test_types = new TestType();
        try {
            $test_suite = TestSuite::with('project')->where('id', $id)->firstOrFail();
            $data = [
                'test_suite' => $test_suite,
                'test_types' => $test_types->getTestTypes(),
                'test_cases' => TestCase::where('testsuite_id', $id)->get(),
                'TestType' => $test_types
            ];
            return View::make('test_suite/view', $data);
        } catch (Exception $e) {
            return View::make('errors/404');
        }
    }
}