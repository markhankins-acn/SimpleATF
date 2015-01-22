@extends('layouts/master')
@section('content')
<h1>Projects <button class="pull-right btn btn-primary">Create Project</button></h1>
@if(isset($projects))
    @foreach($projects as $p)
        {{ $p->name }}
    @endforeach
@endif
@stop
