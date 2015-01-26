@extends('layouts/master')
@section('content')
<h1><a href="{{ URL::route('projects.index'); }}">Project</a>: {{ $project->name }}<span class="pull-right"><button class="btn btn-primary" onclick="toggleCreate();">Create TestSuite</button></span></h1>
<span class="project_description">{{ $project->description }}</span><br/>
<span class="project_url">Base URL: {{ $project->base_url }}</span>

<div id="create_test_suite" style="display: none;">
    <h2>Create Test Suite</h2>
    <div class="form-group">
        <label for="name">Name</label><input class="form-control" id="name" type="text" />
    </div>
    <div class="form-group">
        <label for="description">Description</label><input class="form-control" id="description" type="text" />
    </div>

    <input id="project_id" type="hidden" value="{{ $project->id }}" />

    <div class="form-group">
        <button class="btn btn-primary" onclick="createTestSuite();">Create Test Suite</button>
    </div>
</div>

@if(isset($test_suites))
    <table class="table">
        <thead>
        <tr><th>Test Suite</th><th>Description</th></tr>
        </thead>
        <tbody>
        @foreach($test_suites as $ts)
            <tr><td><a href="/test_suite/{{ $ts->id }}">{{ $ts->name }}</a></td><td>{{ $ts->description }}</td></tr>
        @endforeach
        </tbody>
    </table>
@endif

<script>
function toggleCreate()
{
    $('#create_test_suite').toggle( "slow" );
}

function createTestSuite()
{
    var data = {
        "name": $('#name').val(),
        "project_id": $('#project_id').val(),
        "description": $('#description').val(),
        "type": 'testsuite'
    }

    <?php
    $post_data = [
        'data' => 'data',
        'to' => '/post',
        'success' => 'function(){
            location.reload();
        }'
    ];
    ?>
    @include('jQuery/_post', $post_data)
}
</script>
@stop