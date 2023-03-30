@extends('email.template')

@section('content')
<p>{!! nl2br(strip_tags($body, '<p><a><br>')); !!}</p>
@endsection