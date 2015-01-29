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
            var data = {
                'type': 'user',
                'name': $('#name').val(),
                'email': $('#email').val(),
                'password': $('#password').val()
            };

            data.type = 'user';

            <?php
                $post_data = [
//                    'to' => '/ac2/public/post',
                    'to' => URL::to('/post'),
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
