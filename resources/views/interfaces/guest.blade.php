@extends('common.layout')

@section('title', 'Property Reporting Services - Book a Property Report')

@section('content')
  <style>
    #wizard_container {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
    }

    .prompt-btn {
        display: block;
        border: 1px solid #434bdf;
        padding: 15px;
        margin: 12px;
    }

     .prompt-btn:hover {
        background: #434bdf;
        color: #fff;
    }

  </style>

  <div id="wizard_container" class="my-auto mx-auto wizard" novalidate="novalidate">
      <a href="{{route('usermanagement.login')}}" class="prompt-btn">I am an existing user</a>
      <a href="{{route('usermanagement.signup')}}" class="prompt-btn">I am a new user</a>
  </div>
@endsection

