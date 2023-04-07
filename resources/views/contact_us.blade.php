@php $admin = true; @endphp
@extends('common.layout')

@section('title', 'Contact Us')


@section('content')
<main id="general_page">
<div class="container margin_60_35">
	<div class="row">
		<div class="col-lg-8">
			<h3>Contact us</h3>
			<p>
        Please fill out the form below and a member of our team will contact you soon.
			</p>
			<div>
				<div id="message-contact"></div>
				<form method="post" action="{{route('request.contact_form')}}" id="contactform">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>First name</label>
								<input type="text" class="form-control" id="name_contact" name="first_name" placeholder="John">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Last name</label>
								<input type="text" class="form-control" id="lastname_contact" name="last_name" placeholder="Doe">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email_contact" name="email" class="form-control" placeholder="John@email.com">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Phone number</label>
								<input type="text" id="phone_contact" name="phone" class="form-control" placeholder="00 44 123 456 789">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Your message</label>
								<textarea rows="5" id="message_contact" name="message" class="form-control" style="height:100px;" placeholder="Hello world!"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
						    @csrf
							<p><input type="submit" value="Submit" class="btn_1 add_bottom_15" id="submit-contact"></p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- End col lg 9 -->
		<aside class="col-lg-4">
			<div class="box_style_2">
				<h4>Contacts info</h4>
				<p>
            35 Firs Avenue, London, N11 3NE
          <br> +44 33 333 999 57				
          <br><a href="mailto://hello@prms.uk">hello@prms.uk</a>
				</p>
				<hr class="styled">
				<h4>Departments</h4>
				<ul class="contacts_info">
					<li>Administration
						<br>
						<a href="tel://+44 33 333 999 57">+44 33 333 999 57</a>
						<br><a href="mailto://hello@prms.uk">hello@prms.uk</a>
						<br>
						<small>Monday to Friday 9am - 5pm</small>
					</li>
					<li>Compliance & Privacy
						<br>
						<a href="tel://+44 33 333 999 57">+44 33 333 999 57</a>
						<br><a href="mailto://hello@prms.uk">privacy@prms.uk</a>
						<br>
						<small>Monday to Friday 9am - 5pm</small>
					</li>
				</ul>
			</div>
		</aside>
		<!--End aside -->
	</div>
	<!-- end row-->
</div>
</main>
@endsection
