<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Project extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    protected $fillable = ['name', 'description', 'base_url'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
