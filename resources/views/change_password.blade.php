@extends('common.layout')

@section('title', 'Change Password')

@section('content')
<div id="wizard_container">
    <form id="wrapped" method="POST" action="{{route('usermanagement.change_password.handle')}}">
      <input id="website" name="website" type="text" value="">
      <div id="middle-wizard">
         <div class="step">
          <h3 class="main_question"><strong>Change Password</strong>Plase provide your password details</h3>
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
            <input class="form-control" type="password"  name="oldpassword" placeholder="Old Password" />
          </div>

          <div class="form-group">
            <input class="form-control" type="password"  name="password" placeholder="New Password" />
          </div>

          <div class="form-group">
            <input class="form-control" type="password"  name="password_confirmation" placeholder="Confirm Password" />
          </div>

          <div id="pass-info" class="clearfix"></div>
          <div class="form-group">
            @csrf
            <button type="submit" name="process" class="submit">Change Password</button>
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
