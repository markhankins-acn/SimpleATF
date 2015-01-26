<?php

class TestSuiteController extends BaseController
{
    public function show($id)
    {
        try {
            $test_suite = TestSuite::with('project')->where('id', $id)->firstOrFail();
            $data = [
                'test_suite' => $test_suite,
                'test_types' => TestType::getTestTypes()
            ];
            return View::make('test_suite/view', $data);
        } catch (Exception $e) {
            return View::make('errors/404');
        }
    }
}