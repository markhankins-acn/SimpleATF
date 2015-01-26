<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class TestCase extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'project_testcases';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = ['selector', 'expectation', 'type_id', 'url', 'testsuite_id'];

    public function testsuite()
    {
        return $this->belongsTo('testsuite');
    }
}
