@extends('email.template')

@section('content')
<p>Thank you. Your instruction has been received and will be processed shortly.</p>
{!! $html !!}
@if ($uploadedFile)
<p>File attached: <a href="{{$uploadedFile}}">View Uploaded File</a></p>
@endif
@endsection
