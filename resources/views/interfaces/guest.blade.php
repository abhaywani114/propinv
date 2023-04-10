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

  .back {   
    border: none;
    text-decoration: none;
    transition: background .5s ease;
    -moz-transition: background .5s ease;
    -webkit-transition: background .5s ease;
    -o-transition: background .5s ease;
    display: inline-block;
    cursor: pointer;
    outline: none;
    text-align: center;
    color: #fff;
    background: #4b749f;
    position: relative;
    font-size: 14px;
    font-size: 0.875rem;
    font-weight: 600;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    line-height: 1;
    padding: 12px 30px;
    margin: auto 10px;
  }

  .back:hover {
    color: #fff;
  }

  </style>

  <div id="wizard_container" class="my-auto mx-auto wizard" novalidate="novalidate">
      <a href="{{route('usermanagement.login')}}" class="back">I am an existing user</a>
      <a href="{{route('usermanagement.signup')}}" class="back">I am a new user</a>
  </div>
@endsection

