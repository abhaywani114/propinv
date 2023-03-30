@extends('common.layout')

@section('title', 'Login')

@section('content')
<div id="wizard_container">
    <form id="wrapped" method="POST" action="{{route('usermanagement.login.handle')}}">
      <input id="website" name="website" type="text" value="">
      <!-- Leave for security protection, read docs for details -->
      <div id="middle-wizard">
         <div class="step">
          <h3 class="main_question"><strong>Login</strong>Plase provide your account details</h3>
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:3px;">
                    @foreach ($errors->all() as $error)
                        <li style="margin: 5px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <div class="form-group">
            <input type="email" name="email" class="form-control required" placeholder="Email" onchange="getVals(this, 'user_name');" value="{{ old('email') }}" >
          </div>
          <div class="form-group">
            <input class="form-control" type="password"  name="password" placeholder="Password" onchange="getVals(this, 'password');">
          </div>
          <div id="pass-info" class="clearfix"></div>
          <div class="form-group">
            @csrf
            <button type="submit" name="process" class="submit">Submit</button>
          </div>
        </div>
      </div>
      <!-- /bottom-wizard -->
    </form>
    @if ($errors->any())
      <form method="post" action='{{route('usermanagement.reset')}}'>
        <input name='email' type='hidden' value="{{ old('email') }}" />
        <br/>
        <a href="#" onclick="this.parentNode.submit();">Reset and mail me a new password</a>
        @csrf
      </form>
    @endif
  </div>
  <!-- /Wizard container -->
@endsection

@section('js')
	<!-- Wizard script -->
@endsection
