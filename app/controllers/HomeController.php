<?php

class HomeController extends BaseController
{
    public function index()
    {
        if (!Schema::hasTable('users')) {
            return $this->install();
        } else {
            /* Check if user was created */
            $query = DB::select('select count(*) as count from users');
            if ($query[0]->count > 0) {

                $data = [
                    'projects' => Project::all(),
                ];

                return View::make('projects/index', $data);

            } else {
                return $this->register();
            }
        }
    }

    /**
     * Provides installation instructions on a fresh clone.
     * @return mixed
     */
    public function install()
    {
        return View::make('install');
    }

    /**
     * Provides user registration form.
     */
    public function register()
    {
        return View::make('user/register');
    }
}
