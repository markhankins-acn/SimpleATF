@extends('layouts/master')
@section('content')
    <h1><a href="{{ URL::route('projects.index'); }}">Project</a>: {{ $test_suite->project->name }} > {{ $test_suite->name }}<span class="pull-right"><button class="btn btn-primary" onclick="toggleCreate();">Create TestCase</button></span></h1>
    <span class="project_description">{{ $test_suite->description }}</span><br/>

    <div id="create_test_case" style="display: none;">
        <h2>Create TestCase</h2>
        <div class="form-group">
            <label for="type">URL</label><input class="form-control" id="name" type="text" placeholder="Leave blank to test base url or enter a URL eg /posts or post/1" />
        </div>
        <div class="form-group">
            <label for="type">Expectation</label><input class="form-control" id="expectation" type="text" />
        </div>
        <div class="form-group">
            <label for="type">Selector</label><input class="form-control" id="selector" type="text" placeholder="If using an ID or CSS based rule, enter a selector." />
        </div>
        <div class="form-group">
            <label for="description">Test</label>
            <select id="type_id" class="form-control">
                @foreach($test_types as $t)
                    <option id="{{ $t['id'] }}">{{ $t['name'] }}</option>
                @endforeach
            </select>
        </div>

        <input id="testsuite_id" type="hidden" value="{{ $test_suite->id }}" />

        <div class="form-group">
            <button class="btn btn-primary" onclick="createTestCase();">Create TestCase</button>
        </div>
    </div>

    @if(isset($test_cases))
        <table class="table">
            <thead>
            <tr><th>ID</th><th>URL</th><th>Assertion</th><th>Expectation</th></tr>
            </thead>
            <tbody>
            @foreach($test_cases as $tc)
                <tr>
                    <td>{{ $tc->id }}</td>
                    <td><a href="/test_suite/{{ $tc->id }}">{{ $tc->testsuite->project->base_url }}{{ $tc->url }}</a></td>
                    <td>{{ $TestType->idToName($tc->type_id) }}</td>
                    <td>{{ $tc->expectation }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button class="btn-primary btn" onclick="runTests();">runTests</button>

        <div id="testResults" style="display: none; height: 400px; width: 50%; position: absolute; left: 300px; top: 200px; background: #232323;">
            <h1>Test Results</h1>
            <table id="results">
                <thead>
                <tr><th>Test</th><th>Result</th></tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button class="btn btn-danger" onclick="$('#testResults').hide();">Close</button>
        </div>
    @endif

    <script>
        function toggleCreate()
        {
            $('#create_test_case').toggle( "slow" );
        }

        function createTestCase()
        {
            /* Get Selected Element */
            var type_select = document.getElementById('type_id'); console.log()
            var type_id = type_select.selectedIndex + 1;

            var data = {
                "testsuite_id": $('#testsuite_id').val(),
                "selector": $('#selector').val(),
                "type_id": type_id,
                "expectation": $('#expectation').val(),
                "url": $('#url').val(),
                "type": 'testcase'
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

        function runTests()
        {
            $('#testResults').show();
            var trs = $('tbody tr');
            $.each(trs, function(index, elem) {
                var cols = $(this).find("td");
                var testcase_id = cols[0].innerHTML;
                var data = {
                    'testcase_id': testcase_id
                };
                <?php
                $get_data = [
                    'from' => '/runtest',
                    'data' => 'data'
                ];
                ?>
                $.get( "/runtest", data )
                    .done(function( response ) {
                        var text = response.responseText;
                        console.log(text);
                });

                <!--include('jQuery/_get', $get_data)-->
            });
        }
    </script>
@stop