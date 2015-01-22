<?php

class HomeController extends BaseController
{
    public function index()
    {
        if (!Schema::hasTable('users')) {
            return View::make('install');
        } else {
            /* Check if user was created */
            $query = DB::select('select count(*) as count from users');
            if ($query[0]->count > 0) {
                return View::make('dashboard');
            } else {
                return View::make('user/register');
            }
        }
    }
}
