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
<p>We have recieved payment and  transaction id is: <strong>{{$tx_id}}</strong></p>
<table style="width:100%;">
	<thead>
	  <tr>
	    <th style="text-align: center;width:70px;" >S. No</th>
	    <th style="text-align: left">Field</th>
	    <th style="width:150px;text-align: right">Information</th>
	  </tr>		
	</thead>
	 <tr>
	    <td style="text-align: center">1</td>
	    <td style="text-align: left">Name</td>
	    <td style="text-align: right;">{{$payment->name}}</td>
	  </tr>
	 <tr>
	    <td style="text-align: center">2</td>
	    <td style="text-align: left">Email</td>
	    <td style="text-align: right;">{{$payment->email}}</td>
	 </tr>
	 <tr>
	    <td style="text-align: center">3</td>
	    <td style="text-align: left">Mobile</td>
	    <td style="text-align: right;">{{$payment->phone_no}}</td>
	 </tr>
	  <tr>
	    <td style="text-align: center">4</td>
	    <td style="text-align: left">Hospital / Institution</td>
	    <td style="text-align: right;">{{$payment->hospital}}</td>
	 </tr>
	 <tr>
	    <td style="text-align: center">5</td>
	    <td style="text-align: left">Country</td>
	    <td style="text-align: right;">{{$payment->country}}</td>
	 </tr>
	 <tr>
	    <td style="text-align: center">6</td>
	    <td style="text-align: left">Area of Intrest</td>
	    <td style="text-align: right;">{{$payment->intrest}}</td>
	 </tr>
	 	 <tr>
	    <td style="text-align: center">8</td>
	    <td style="text-align: left">Course</td>
	    <td style="text-align: right;">{{$courses->name}}</td>
	 </tr>
	  <tr>
	    <td style="text-align: center">8</td>
	    <td style="text-align: left">Subscription Type</td>
	    <td style="text-align: right;">{{$payment->type}}</td>
	 </tr>
	 <tr>
	    <td style="text-align: center">9</td>
	    <td style="text-align: left">Price</td>
	    <td style="text-align: right;">{{$payment->price}}</td>
	 </tr>
	 <tr>
	    <td style="text-align: center">10</td>
	    <td style="text-align: left">Date</td>
	    <td style="text-align: right;">{{date("d F Y", strtotime($payment->booking_date))}}</td>
	 </tr>
</table>
@endsection