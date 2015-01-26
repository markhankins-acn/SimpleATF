@extends('layouts.master')
@section('content')
<h1>Projects <button class="pull-right btn btn-primary" onclick="toggleProjectCreate();">Create Project</button></h1>
<div id="create_project" style="display: none;">
    <h2>Create Project</h2>
    <div class="form-group">
        <label for="name">Name</label><input class="form-control" id="name" type="text" />
    </div>
    <div class="form-group">
        <label for="base_url">Base URL</label><input class="form-control" id="base_url" type="text" />
    </div>
    <div class="form-group">
        <label for="description">Description</label><input class="form-control" id="description" type="text" />
    </div>

    <div class="form-group">
        <button class="btn btn-primary" onclick="createProject();">Create Project</button>
    </div>
</div>
@if(isset($projects))
    <table class="table">
    <thead>
    <tr><th>Project</th><th>Base URL</th><th>Description</th></tr>
    </thead>
    <tbody>
    @foreach($projects as $p)
        <tr><td><a href="project/{{ $p->id }}">{{ $p->name }}</a></td><td>{{ $p->base_url }}</td><td>{{ $p->description }}</td></tr>
    @endforeach
    </tbody>
    </table>
@endif
@stop

<script>
function toggleProjectCreate()
{
    $('#create_project').toggle( "slow" );
}

function createProject()
{
    var data = {
        "name": $('#name').val(),
        "base_url": $('#base_url').val(),
        "description": $('#description').val(),
        "type": 'project'
    }

    <?php
    $post_data = [
        'data' => 'data',
        'to' => 'post',
        'success' => 'function(){
            location.reload();
        }'
    ];
    ?>
    @include('jQuery/_post', $post_data)
}
</script>