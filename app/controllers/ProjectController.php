<?php

/**
 * Class ProjectController
 */
class ProjectController extends BaseController
{
    public function show($id)
    {
        try {
            $project = Project::where('id', $id)->firstOrFail();
            $test_suites = TestSuite::where('project_id', $id)->get();
            $data = [
                'project' => $project,
                'test_suites' => $test_suites
            ];
            return View::make('projects/view', $data);
        } catch (Exception $e) {
            return View::make('errors/404');
        }
    }
}