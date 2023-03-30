@extends('email.template')

@section('content')
<style>
	table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  color: #000;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<p>Thank you for purchasing courses from us. <br/>We have recieved your payment and your transaction id is: <strong>{{$tx_id}}</strong></p>
<p>Booking Type: {{ucfirst($payment->type)}} | Booking Date: {{date("d F Y")}}</p>
<table style="width:100%;">
	<thead>
	  <tr>
	    <th style="text-align: center;width:70px;" >S. No</th>
	    <th style="text-align: left">Course Name</th>
	    <th style="width:150px;text-align: right">Price</th>
	  </tr>		
	</thead>
	@foreach($courses as $c)
		  <tr>
		    <td style="text-align: center">{{$loop->index + 1}}</td>
		    <td style="text-align: left">{{$c->name}}</td>
		    <td style="text-align: right;">{{$payment->price}} {{env('CURRENCY_CODE')}}</td>
		  </tr>
	@endforeach
	  <tr>
	    <td style="text-align: center;" colspan="2"><strong>Total Price</strong></td>
	    <td style="text-align: right;">{{$payment->price}} {{env('CURRENCY_CODE')}}</td>
	  </tr>
	<tbody>
	</tbody>
</table>
<br/>
@endsection
