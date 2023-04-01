@extends('email.template')

@section('content')
<p>You have service request {{$request_type}}, from:</p>
{!! $html !!}
@if ($uploadedFile)
<p>File attached: <a href="{{$uploadedFile}}">View Uploaded File</a></p>
@endif
@endsection
