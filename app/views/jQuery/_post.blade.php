jQuery.ajax({
    url: "{{ $to }}",
    type: "POST",
    data: {{ $data }},
    @if(isset($success))
    success: {{ $success }},
    @endif
    @if(isset($error))
    error: {{ $error }},
    @endif
});