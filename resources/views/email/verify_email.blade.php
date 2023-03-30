@extends('email.template')

@section('content')
<p>Kindly verify your email <strong>{{$email}}</strong> by clicking on link: <a href="{{route('usermanagement.verify.email',$hash)}}"><strong>Verify</strong></a></p>


@endsection
