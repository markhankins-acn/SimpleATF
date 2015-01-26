$.get( "{{ $from }}", {{ $data }} )
    .done(function( data ) {
        return data;
    });