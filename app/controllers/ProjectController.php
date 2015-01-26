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
            $data = [
                'project' => $project
            ];
            return View::make('projects/view', $data);
        } catch (Exception $e) {
            return View::make('errors/404');
        }
    }
}