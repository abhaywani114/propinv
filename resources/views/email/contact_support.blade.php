@extends('email.template')

@section('content')
<strong>You received a message from : {{ $data['first_name'] }} {{ $data['last_name'] }}</strong>

<p>
<strong>Email:</strong> {{ $data['email'] }}
<br/>
<strong>Subject:</strong> {{ $data['subject'] ?? '' }}
</p>
 
<p>
<strong>Message:</strong><br/> {!! nl2br(strip_tags($data['message'], '<p><a><br>'));  !!}
</p>
----------End of message------
@endsection