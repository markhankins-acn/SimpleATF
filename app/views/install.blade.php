@extends('layouts/master')
@section('content')
    <h1>Welcome</h1>
    <p>Welcome to Simple Acceptance Testing Framework.  It appears you have not yet installed the database.

    <h2>Installation</h2>
    <p><ul>
        <li><code class="bash">php artisan composer install</code> if you have not already.</li>
        <li><code class="bash">php artisan migrate</code> creates the database tables required.</li>
    </ul></p>
@stop
