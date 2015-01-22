@extends('layouts/master')
@section('content')
    <h1>Register</h1>


    <div class="form-group">
        <input id="name" class="form-control" type="text" placeholder="Username" />
    </div>

    <div class="form-group">
        <input id="email" class="form-control" type="email" placeholder="E-Mail Address" />
    </div>

    <div class="form-group">
        <input id="password" class="form-control" type="password" placeholder="Password" />
    </div>

    <div class="form-group">
        <input id="password_confirmation" class="form-control" type="password" placeholder="Confirm Password" />
    </div>

    <div class="form-group">
        <button class="btn-primary btn" onclick="createUser()">Register</button>
    </div>
    <script>
        function createUser()
        {
            var data = {};
            $.each([ "name", "password", "email", "password_confirmation" ], function(field) {
                data.field = $('#' + field).val();
            });

            <?php
                $post_data = [
                    'to' => 'users',
                    'data' => 'data',
                    'success' => 'function() {
                        window.location = "/";
                    }
                    '
                ];
            ?>

            @include('jQuery/_post', $post_data)
        }
    </script>
@stop
