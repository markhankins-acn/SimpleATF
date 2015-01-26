<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class TestSuite extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'project_testsuites';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
