@extends('email.template')

@section('content')
<p>We have successfully reset your password. <br/>Your new password is: <strong>{{$password}}</strong></p>

@endsection
