<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('/img/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('/img/favicon/favicon.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('/img/favicon/favicon.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('/img/favicon/favicon.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('/img/favicon/favicon.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('/css/menu.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('/css/vendors.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="/js/modernizr.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<style>
nav {
    position: absolute;
    right: 0;
    width: 20%;
    overflow: hidden;
    box-shadow: 1px 0px 3px 1px #dad5d5cc;
    transform: translateY(-25%);
    z-index: 1;
}

.cd-primary-nav.fade-in {
  width: 100%;
  position: relative;
}
.cd-primary-nav li {
    margin: 11px 0px;
}
.cd-primary-nav a {
  font-size: 12px;
} 
.cd-nav-trigger:hover ~ .cd-primary-nav.fade-in {
    visibility: visible;
    opacity: 1;
}
@media (max-width: 767px){
  nav {
      width: 60%;
  }
}
</style>
</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<nav>
		<ul class="cd-primary-nav">
			<li><a href="{{route('homepage')}}" class="animated_link">Home</a></li>
      @guest
			<li><a href="{{route('usermanagement.signup')}}" class="animated_link">Sign up</a></li>
			<li><a href="{{route('usermanagement.login')}}" class="animated_link">Sign In</a></li>
      @endguest
      @auth
        <li><a href="{{route('usermanagement.change_password')}}" class="animated_link">Change Password</a></li>
        <li><a href="{{route('usermanagement.logout')}}" class="animated_link">Logout</a></li>
      @endauth 
			<li><a href="{{route('contact_us')}}" class="animated_link">Contact Us</a></li>
		</ul>
	</nav>
	<!-- /menu -->
	
	<div class="container-fluid full-height">
		<div class="row row-height">
  @if (isset($admin))
        @yield('content')
  @else
 <style>
    .content-right {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .logo_wrapper {
      display: flex !important;
      justify-content: space-between;
      align-items: center;
      max-width: 70%;
      margin: auto;
  }
</style>

		<div class="col-lg-6 content-left">
				<div class="content-left-wrapper">
					<a href="{{route('homepage')}}" id="logo" class=""><img src="{{asset('/img/restart.svg')}}" alt="" width="25" height="25"></a>
					<div id="social">
						<ul>
							<li><a href="#0"><i class="icon-facebook" hidden="hidden"></i></a></li>
							<li><a href="#0"><i class="icon-twitter" hidden="hidden"></i></a></li>
							<li><a href="#0"><i class="icon-google" hidden="hidden"></i></a></li>
							<li><a href="#0"><i class="icon-linkedin" hidden="hidden"></i></a></li>
						</ul>
					</div>
					<!-- /social -->
					<div>
						<figure class="logo_wrapper"><img src="{{asset('/img/logo.png')}}" alt="house" class="img-fluid"/></figure>
						<h2>Request a Service</h2>
						<p>Please use the form to request a service from us. Should you encounter any issues or have any queries, please do not hesitate to contact us.</p>
						<p>If you are requesting a <b>fire asset check or block inspection</b> for the first time, or an <b>eviction</b> is taking place, <b>please contact us first.</b></p>
						<a href="{{route('contact_us')}}" class="btn_1 rounded">Contact Us</a>
						<a href="#start" class="btn_1 rounded mobile_btn">Contact Us</a>
					</div>
					<div class="copy">© {{date('Y')}} Property Report Management Services LTD. All rights reserved.</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

      <div class="col-lg-6 content-right" id="start">
        @yield('content')
      </div>
			<!-- /content-right-->
  @endif
		</div>
    <!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
	<!-- /menu button -->
	
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<!-- COMMON SCRIPTS -->
	<script src="{{asset('/js/jquery-3.6.1.min.js')}}"></script>
  <script src="{{asset('/js/common_scripts.min.js')}}"></script>
	<script src="{{asset('/js/velocity.min.js')}}"></script>
	<script src="{{asset('/js/functions.js')}}"></script>
	<script src="{{asset('/js/pw_strenght.js')}}"></script>
  <script src="{{asset('/js/file-validator.js')}}"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
  <script>
		$.ajaxSetup({
   			 headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			}
 		});

  </script>
<script src="https://cdn.websitepolicies.io/lib/cconsent/cconsent.min.js" defer></script>
<script>window.addEventListener("load",function(){window.wpcb.init({"border":"thin","corners":"small","colors":{"popup":{"background":"#606060","text":"#ffffff","border":"#f9f9f9"},"button":{"background":"#f9f9f9","text":"#000000"}},"position":"bottom","padding":"small","content":{"href":"{{route('cookie_policy')}}"}})});</script>
  @yield('js')
</body>
</html>
