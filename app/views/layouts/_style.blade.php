<?php
$styles = [
    'bootstrap/yeti.min.css',
    'satf.css'
];
?>
@foreach($styles as $style)
<link rel="stylesheet" href="{{ asset('assets/css/' . $style) }}">
@endforeach