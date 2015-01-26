<?php
$scripts = [
        'jquery-2.1.1.min.js',
        'satf.js',
];
?>
@foreach($scripts as $js)
<script src="{{ asset('assets/js/' . $js) }}"></script>
@endforeach