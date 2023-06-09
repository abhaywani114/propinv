@extends('common.layout')

@section('title', 'Response')

@section('content')
<div id="wizard_container">
   <div style="display: flex;flex-direction: column;align-items: center;">
  @if($msg['success'] == false)
    <a href="{{route('homepage')}}">Home</a> 
  @endif
  @if($msg['success'] == true)
    <div class="icon icon--order-success svg" style="margin-bottom: 30px;">
         <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
          <g fill="none" stroke="#8EC343" stroke-width="2">
             <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
             <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
          </g>
         </svg>
     </div>
  @endif
	  <h4 @if($msg['success'] == false) style="color: red" @endif><span style="text-align: center;display: block;">{{$msg['msg']}}</span></h4>
  </div>
  
</div>
  <!-- /Wizard container -->
@endsection

@section('js')
	<!-- Wizard script -->
	<script src="/js/registration_func.js"></script>
@endsection
