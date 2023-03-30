@extends('common.layout')

@section('title', 'Sign Up')

@section('content')
<div id="wizard_container">
  <div id="top-wizard">
      <div id="progressbar"></div>
    </div>
    <!-- /top-wizard -->
    <form id="wrapped" method="POST" action="{{@route('usermanagement.signup.handle')}}">
      <input id="website" name="website" type="text" value="">
      <!-- Leave for security protection, read docs for details -->
      <div id="middle-wizard">
        <div class="step">
          <h3 class="main_question"><strong>1/3</strong>Please fill with your details</h3>
          <div class="form-group">
            <input type="text" name="first_name" class="form-control required" placeholder="First Name" onchange="getVals(this, 'first_name');">
          </div>
          <div class="form-group">
            <input type="text" name="last_name" class="form-control required" placeholder="Last Name" onchange="getVals(this, 'last_name');">
          </div>
          <div class="form-group">
            <div class="styled-select clearfix">
              <select class="wide required" name="country" onchange="getVals(this, 'country');">
                <option value="">Your Country</option>
                <option value="Europe">Europe</option>
                <option value="Asia">Asia</option>
                <option value="North America">North America</option>
                <option value="South America">South America</option>
                <option value="Oceania">Oceania</option>                             
              </select>
            </div>
          </div>
          <div class="form-group terms">
            <label class="container_check">Please accept our <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a>
              <input type="checkbox" name="terms" value="Yes" class="required">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
        <!-- /step-->
        <div class="step">
          <h3 class="main_question"><strong>2/3</strong>Plase provide your account details</h3>
          <div class="form-group">
            <input type="email" name="email" class="form-control required" placeholder="Your Email" onchange="getVals(this, 'email');">
          </div>
          <div class="form-group">
            <input class="form-control" type="password" id="password1" name="password" placeholder="Password" onchange="getVals(this, 'password');">
          </div>
          <div class="form-group">
            <input class="form-control" type="password" id="password2" name="password_confirmation" placeholder="Confirm Password">
          </div>
          <div id="pass-info" class="clearfix"></div>
        </div>
        <!-- /step-->
        <div class="submit step">
          <h3 class="main_question"><strong>3/3</strong>Summary</h3>
          <div class="summary">
            <ul>
              <li><strong>1</strong>
                <h5>Personal Details</h5>
                <ul>
                  <li><label>First Name</label>: <span id="first_name"></span></li>
                  <li><label>Last Name</label>: <span id="last_name"></span></li>
                  <li><label>Country</label>: <span id="country"></span></li>
                </ul>
              </li>
              <li><strong>2</strong>
                <h5>Account Details</h5>
                <ul>
                  <li><label>Email</label>: <span id="email"></span></li>
                  <li><label>Password</label>: <span id="password"></span></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <!-- /step-->
      </div>
      <!-- /middle-wizard -->
      <div id="bottom-wizard">
        <button type="button" name="backward" class="backward">Prev</button>
        <button type="button" name="forward" class="forward">Next</button>
        <button type="submit" name="process" class="submit">Submit</button>
      </div>
      <!-- /bottom-wizard -->
@csrf
    </form>
  </div>
  <!-- /Wizard container -->
@endsection

@section('js')
	<!-- Wizard script -->
	<script src="/js/registration_func.js"></script>
@endsection
