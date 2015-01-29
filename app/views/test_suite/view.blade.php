@extends('layouts/master')
@section('content')
    <h1><a href="{{ URL::route('projects.index'); }}">Project</a>: {{ $test_suite->project->name }} > {{ $test_suite->name }}<span class="pull-right"><button class="btn btn-primary" onclick="toggleCreate();">Create TestCase</button></span></h1>
    <span class="project_description">{{ $test_suite->description }}</span><br/>

    <div id="create_test_case" style="display: none;">
        <h2>Create TestCase</h2>
        <div class="form-group">
            <label for="description">Test</label>
            <select id="type_id" class="form-control">
                @foreach($test_types as $t)
                    <option id="{{ $t['id'] }}">{{ $t['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div id="url_group" class="form-group">
            <label for="type">URL (Optional)</label><input class="form-control" id="url" type="text" placeholder="Leave blank to test base url or enter a URL eg /posts or post/1" />
        </div>
        <div id="expectation_group" class="form-group">
            <label id="expectation_label" for="expectation">Expectation</label><input class="form-control" id="expectation" type="text" />
        </div>
        <div id="selector_group" class="form-group">
            <label id="selector_label" for="selector">Selector (Optional)</label><input class="form-control" id="selector" type="text" placeholder="For ID simple type the id as text (no hash), for json use comma seperated values." />
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

        <div id="testResults" style="display: none; height: 400px; min-width: 50%; position: absolute; left: 300px; top: 200px; background: #232323; padding: 8px; border: 2px solid #484848; border-radius: 8px;">
            <h1>Test Results</h1>
            <table class="table" id="results">
                <thead>
                <tr><th>URL</th><th>Test</th><th>Expectation</th><th>Result</th></tr>
                </thead>
                <tbody id="testResultData">
                </tbody>
            </table>
            <button class="btn btn-danger" onclick="$('#testResults').hide();">Close</button>
        </div>
    @endif

    <script>
        function toggleCreate()
        {
            disableUselessFields();
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

        function clearPreviousTests()
        {
            $('#testResultData').html('');
        }

        function addResult(url, test, expectation, result)
        {
            var html = $('#testResultData').html();
            var newrow = '<tr class="' + result + '"><td>'+ url +'</td><td>'+ test +'</td><td>'+ expectation +'</td><td>'+ result +'</td></tr>';
            $('#testResultData').html(html + newrow);
        }

        function runTests()
        {
            // remove previous results
            clearPreviousTests();

            // show test results screen.
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

                $.getJSON( "/runtest", data).done( function( json ) {
                    // append new results
                    url = json.url;
                    result = json.result;
                    assertion = json.assertion;
                    expectation = json.expectation;
                    addResult(url, assertion, expectation, result)
                });
            });
        }

        /* Disable Un-required Fields when testType is changed */
        $('#type_id').change(function() {
            disableUselessFields()
        });

        function disableUselessFields()
        {
            var testType = $('#type_id').val();
            switch (testType) {
                case 'hasText':
                    $('#selector_group').hide();
                    $('#expectation_label').html('Text');
                    break;
                case 'idHasText':
                    $('#selector_group').show();
                    $('#expectation_label').html('Text');
                    $('#selector_label').html('CSS ID');
                    break;
                case 'hasStatusCode':
                    $('#selector_group').hide();
                    $('#expectation_label').html('Status Code');
                    break;
                case 'hasJson':
                    $('#selector_group').show();
                    $('#expectation_label').html('JSON Value');
                    $('#selector_label').html('JSON Pattern');
                    break;
                case 'hasJsonKey':
                    $('#selector_group').hide();
                    $('#expectation_label').html('JSON Key');
                    break;
                default:
                    break;
            }
        }
    </script>
@stop