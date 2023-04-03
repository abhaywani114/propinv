@extends('common.layout')

@section('title', 'Property Reporting Services - Book a Property Report')

@section('content')
<style>

    .content-right {
      justify-content: unset;
}
</style>
<div id="wizard_container" class="my-auto mx-auto wizard" novalidate="novalidate">
					<div id="top-wizard">
						<div id="progressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="100"><div class="ui-progressbar-value ui-widget-header ui-corner-left ui-corner-right" style="width: 100%;"></div></div>
					</div>
					<!-- /top-wizard -->
					<form id="wrapped" method="POST" enctype="multipart/form-data" novalidate="novalidate" action="{{route('request.form1')}}" class="wizard-form">
						<input id="website" name="website" type="text" value="">
						<!-- Leave for security protection, read docs for details -->
						<div id="middle-wizard" class="wizard-branch wizard-wrapper">
							<div class="step wizard-step" style="display: none;">
								<h3 class="main_question wizard-header"><strong>1/8</strong>Which service do you require?</h3>
								<div class="form-group">
									<label class="container_check version_2">
										Inventory and Check In
										<input type="checkbox" name="question_1[]" value="Inventory and Check In" class="required valid" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Inventory Only
										<input type="checkbox" name="question_1[]" value="Inventory Only" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Mid-Term Property Visit
										<input type="checkbox" name="question_1[]" value="Mid-Term Property Visit" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Check Out
										<input type="checkbox" name="question_1[]" value="Check Out" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Smoke and CO Inspection/Installation
										<input type="checkbox" name="question_1[]" value="Smoke and CO Inspection/Installation" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										30 minute viewing
										<input type="checkbox" name="question_1[]" value="30 minute viewing" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Marketing Photography
										<input type="checkbox" name="question_1[]" value="Marketing Photography" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										360 Virtual Tour
										<input type="checkbox" name="question_1[]" value="360 Virtual Tour" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Fire Safety Asset Check/Block Inspection
										<input type="checkbox" name="question_1[]" value="Fire Safety Asset Check/Block Inspection" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Abandonment Notice
										<input type="checkbox" name="question_1[]" value="Abandonment Notice" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										LPA- Visit/Lock Change Notice/Occupancy Check
										<input type="checkbox" name="question_1[]" value="LPA- Visit/Lock Change Notice/Occupancy Check" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_check version_2">
										Attend an Eviction
										<input type="checkbox" name="question_1[]" value="Attend an Eviction" class="required" onchange="getVals(this, 'question_1');">
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<!-- /step-->
							<div class="step wizard-step" style="display: none;">
								<h3 class="main_question"><strong>2/8</strong>Please provide <b>your</b> information</h3>
								<div class="form-group">
									<input type="text" name="agentname" class="form-control required valid" placeholder="Agent/Business Name" value="{{Auth::User()->agentname}}" onkeyup="getVals(this, 'agentname')"  readonly>
								</div>
								<div class="form-group">
									<input type="text" name="firstname" class="form-control required valid" placeholder="First Name" onkeyup="getVals(this, 'firstname')" value="{{Auth::User()->first_name}}"  readonly  >
								</div>
								<div class="form-group">
									<input type="text" name="lastname" class="form-control required valid" placeholder="Last Name" onkeyup="getVals(this, 'lastname')" value="{{Auth::User()->last_name}}"  readonly  >
								</div>
								<div class="form-group">
									<input type="email" name="agentemail" class="form-control required valid" placeholder="Your Email" onkeyup="getVals(this, 'agentemail')" value="{{Auth::User()->email}}" readonly  >
								</div>
								<div class="form-group">
									<input type="text" name="telephone" class="form-control required valid" placeholder="Telephone" onkeyup="getVals(this, 'agentphone')" value="{{Auth::User()->phone}}" readonly  >
								</div>
							</div>
							<!-- /step-->
							<div class="step wizard-step" style="display: none;">
								<h3 class="main_question"><strong>3/8</strong>Please provide property details</h3>
								<div class="styled-select clearfix form-group">
									<select class="wide required valid" name="propertytype" id="propertytype_select" style="display: none;">
										<option value="" disabled="" selected="">Type of property?</option>
										<option value="House">House</option>
										<option value="Bungalow">Bungalow</option>
										<option value="Flat/Apartment">Flat/Apartment</option>
										<option value="HMO">HMO</option>
										<option value="Not Applicable">Not Applicable</option>
                  </select>
                  <div class="nice-select wide required" tabindex="0">
                    <span class="current">Type of property?</span>
                    <ul class="list">
                      <li data-value="" class="option disabled focus selected">Type of property?</li>
                      <li data-value="House" class="option">House</li>
                      <li data-value="Bungalow" class="option">Bungalow</li>
                      <li data-value="Flat/Apartment" class="option">Flat/Apartment</li>
                      <li data-value="HMO" class="option">HMO</li>
                      <li data-value="Not Applicable" class="option">Not Applicable</li>
                    </ul>
                  </div>
								</div>
								<div class="styled-select clearfix form-group">
									<select class="wide required valid" name="propertysize" id="propertysize_select" style="display: none;">
										<option value="" disabled="" selected="">How many bedrooms?</option>
										<option value="Studio">Studio</option>
										<option value="One Bedroom">One Bedroom</option>
										<option value="Two Bedroom">Two Bedroom</option>
										<option value="Three Bedroom">Three Bedroom</option>
										<option value="Four Bedroom">Four Bedroom</option>
										<option value="Five Bedroom">Five Bedroom</option>
										<option value="Not Applicable">Not Applicable</option>
                  </select>
                  <div class="nice-select wide required" tabindex="0">
                        <span class="current">How many bedrooms?</span>
                        <ul class="list">
                          <li data-value="" class="option disabled focus selected">How many bedrooms?</li>
                          <li data-value="Studio" class="option">Studio</li>
                          <li data-value="One Bedroom" class="option">One Bedroom</li>
                          <li data-value="Two Bedroom" class="option">Two Bedroom</li>
                          <li data-value="Three Bedroom" class="option">Three Bedroom</li>
                          <li data-value="Four Bedroom" class="option">Four Bedroom</li>
                          <li data-value="Five Bedroom" class="option">Five Bedroom</li>
                          <li data-value="Not Applicable" class="option">Not Applicable</li>
                        </ul>
                      </div>
								</div>
								<div class="styled-select clearfix form-group">
									<select class="wide required valid" name="propertyfurnishing" id="propertyfurnishing_select" style="display: none;">
										<option value="" disabled="" selected="">Furnished or unfurnished?</option>
										<option value="Furnished">Furnished</option>
										<option value="Part Furnished">Part Furnished</option>
										<option value="Unfurnished">Unfurnished</option>
                  </select>
                  <div class="nice-select wide required" tabindex="0">
                    <span class="current">Furnished or unfurnished</span>
                    <ul class="list">
                      <li data-value="" class="option disabled focus selected">Furnished or unfurnished?</li>
                      <li data-value="Furnished" class="option">Furnished</li>
                      <li data-value="Part Furnished" class="option">Part Furnished</li>
                      <li data-value="Unfurnished" class="option">Unfurnished</li>
                    </ul>
                  </div>
								</div>
								<div class="form-group">
									<input type="text" name="firstline" class="form-control required valid" placeholder="Street Name and House Number" onkeyup="getVals(this, 'firstline')">
								</div>
								<div class="form-group">
									<input type="text" name="area" class="form-control required valid" placeholder="Area" onkeyup="getVals(this, 'area')">
								</div>
								<div class="form-group">
									<input type="text" name="towncity" class="form-control required valid" placeholder="Town or City" onkeyup="getVals(this, 'towncity')">
								</div>
								<div class="form-group">
									<input type="text" name="postcode" class="form-control valid" placeholder="Post Code" onkeyup="getVals(this, 'postcode')">
								</div>
							</div>
							<!-- /step-->
							<div class="step wizard-step" style="display: none;">
								<div class="form-group">
									<h3 class="main_question"><strong>4/8</strong>Please provide the <b>tenants</b> details</h3>
									<label><strong>Tenant 1</strong></label>
									<div class="form-group">
										<input type="text" name="tt1name" class="form-control required valid" placeholder="Tenant One Name" onkeyup="getVals(this, 'tt1name')">
									</div>
									<div class="form-group">
										<input type="tel" name="tt1phone" class="form-control required valid" placeholder="Tenant One Phone Number" onkeyup="getVals(this, 'tt1phone')">
									</div>
									<div class="form-group">
										<input type="email" name="tt1email" class="form-control required valid" placeholder="Tenant One Email" onkeyup="getVals(this, 'tt1email')">
									</div>
									<label><strong>Tenant 2</strong></label>
									<div class="form-group">
										<input type="text" name="tt2name" class="form-control valid" placeholder="Tenant Two Name" onkeyup="getVals(this, 'tt2name')">
									</div>
									<div class="form-group">
										<input type="tel" name="tt2phone" class="form-control valid" placeholder="Tenant Two Contact No" onkeyup="getVals(this, 'tt2phone')">
									</div>
									<div class="form-group">
										<input type="email" name="tt2email" class="form-control valid" placeholder="Tenant Two Email" onkeyup="getVals(this, 'tt2email')">
									</div>
								</div>
							</div><!-- end step-->

          <div class="step wizard-step" style="display: none;">
								<h3 class="main_question"><strong>5/8</strong>Tenancy</h3>

								<div class="styled-select clearfix form-group">
									<select class="wide required valid" name="tenancytype" id="tenancytype_select" style="display: none;">
										<option value="" disabled="" selected="">What type of tenancy is to be assigned?</option>
										<option value="Single">Single</option>
										<option value="Joint">Joint</option>
										<option value="Multiple">Multiple</option>
										<option value="HMO">HMO</option>
                  </select>
                  <div class="nice-select wide required" tabindex="0">
                    <span class="current">What type of tenancy is to be assigned?</span>
                    <ul class="list">
                      <li data-value="" class="option disabled focus selected">What type of tenancy is to be assigned?</li>
                      <li data-value="Single" class="option">Single</li>
                      <li data-value="Joint" class="option">Joint</li>
                      <li data-value="Multiple" class="option">Multiple</li>
                      <li data-value="HMO" class="option">HMO</li>
                    </ul>
                  </div>
								</div>

          			<label>Tenancy start date</label>
								<div class="form-group">
									<input type="text" name="tend_datepicker" class="form-control required tdate-pick-single valid" id="tend_datepicker_value" />
								</div>

								<div class="styled-select clearfix form-group">
									<select class="wide required valid" name="managementcategory" id="managementcategory_select" style="display: none;">
										<option value="" disabled="" selected="">Management Category</option>
										<option value="Not applicable">Not applicable</option>
										<option value="Fully Managed">Fully Managed</option>
										<option value="Let Only">Let Only</option>
										<option value="Rent Collection">Rent Collection</option>
                  </select>
                  <div class="nice-select wide required" tabindex="0">
                    <span class="current">What type of tenancy is to be assigned?</span>
                    <ul class="list">
                      <li data-value="" class="option disabled focus selected">Management Category</li>
                      <li data-value="Not applicable" class="option">Not applicable</li>
                      <li data-value="Fully Managed" class="option">Fully Managed</li>
                      <li data-value="Let Only" class="option">Let Only</li>
                      <li data-value="Rent Collection" class="option">Rent Collection</li>
                    </ul>
                  </div>
								</div>


							</div>

							<!-- /step-->

							<!-- /step-->
							<div class="step wizard-step" style="display: none;">
								<h3 class="main_question"><strong>6/8</strong>Further information</h3>
								<label>When would you like the instruction to take place?</label>
								<div class="form-group">
									<input type="text" name="datepicker" class="form-control required date-pick-single valid" id="datepicker_value" />
								</div>
								<label>Finally, please provide key arrangements. If the keys are in a safe, please provide the location and code.</label>

								<div class="form-group">
									<input type="text" name="keycollection" class="form-control required valid" placeholder="Key Collection Location" onkeyup="getVals(this, 'keycollection');">
								</div>
								<div class="form-group">
									<input type="text" name="keyreturn" class="form-control required valid" placeholder="Key Return Location" onkeyup="getVals(this, 'keyreturn');">
								</div>
							</div>
							<!-- /step-->
    
              <div class="step wizard-step" style="display: none;">
								<h3 class="main_question"><strong>7/8</strong>Is there anything else we need to know?</h3>
								<div class="form-group add_top_30">
									<label>Please provide any additional information below.</label>
									<textarea name="furtherinfo" class="form-control valid" style="height:100px;" placeholder="Any additional information required?" onkeyup="getVals(this, 'furtherinfo');"></textarea>
								</div>
								<div class="form-group add_top_30">
									<label>Please upload any additional documentation we may require.<br><small>(Files accepted: gif, jpg, jpeg, .png, .pdf, .doc/docx)</small></label>
									<div class="fileupload">
										<input type="file" accept="image/*,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="getVals(this, 'fileupload');" name="fileupload" class="valid">
									</div>
								</div>
								<div class="form-group terms">
									<label class="container_check">
										I have read and I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a>
										<input type="checkbox" name="terms" value="Yes" class="required valid"><span for="terms" class="error" style="display: none;">Required</span>
										<span class="checkmark" onclick="fn()"></span>
									</label>
								</div>
							</div>
							<!-- end step-->
							<div class="submit step wizard-step current" style="">
								<h3 class="main_question"><strong>8/8</strong>Summary</h3>
								<div class="summary">
									<ul>
										<li>
											<strong>1</strong>
											<h5>Service requested:</h5>
											<p id="question_1"></p>
										</li>
										<li>
											<strong>2</strong>
											<h5>Your Information:</h5>
											<p>
												<span id="agentname">{{Auth::User()->agentname}}</span>
                        <br><span id="firstname">{{Auth::User()->first_name}}</span> <span id="lastname">{{Auth::User()->last_name}}</span>
												<br><span id="agentemail">{{Auth::User()->email}}</span>
												<br><span id="agentphone">{{Auth::User()->phone}}</span>
											</p>

										</li>
										<li>
											<strong>3</strong>
											<h5>Property Specification:</h5>
											<p>
												<b>Type:</b> <span id="propertytype"></span>
												<br><b>Size:</b> <span id="propertysize"></span>
												<br><b>Furnishing:</b> <span id="propertyfurnishing"></span>
											</p>
										</li>

										<li>
											<strong>4</strong>
											<h5>Property Address:</h5>
											<p>
												<b>First Line:</b> <span id="firstline"></span>,
												<br><b>Area:</b> <span id="area"></span>,
												<br><b>Town/City:</b> <span id="towncity"></span>,
												<br><b>Post Code</b> <span id="postcode"></span>
											</p>
										</li>

										<li>
											<strong>5</strong>
											<h5>Tenant Details:</h5>
											<p>
												<b>TT1 Name:</b> <span id="tt1name"></span>
												<br><b>TT1 Email:</b> <span id="tt1email"></span>
												<br><b>TT1 Phone:</b> <span id="tt1phone"></span>
											</p>
											<p>
												<b>TT2 Name:</b> <span id="tt2name">Two</span>
												<br><b>TT2 Email:</b> <span id="tt2email"></span>
												<br><b>TT2 Phone:</b> <span id="tt2phone"></span>
											</p>
										</li>
                  	<li>
											<strong>6</strong>
											<h5>Tenancy Type</h5>
											<p>
												<b>Tenancy Type:</b> <span id="tenancytype_span"></span>
												<br><b>Tenancy start date</b> <span id="tend_datepicker_span"></span>
												<br><b>Management Category</b> <span id="managementcategory_span"></span>
                      </p>
                    </li>
										<li>
											<strong>7</strong>
											<h5>Date &amp; Key Information:</h5>
											<b>Date:</b> <span id="date"></span>
											<p>
												<b>Key collection:</b> <span id="keycollection"></span>
												<br><b>Key return:</b> <span id="keyreturn"></span>
										</p></li>
										<li>
											<strong>8</strong>
											<h5>Further Information:</h5>
											<b>Additional Info: </b><span id="furtherinfo"></span>
											<p><label>File upload</label>: <span id="fileupload"></span></p>

										</li>
									</ul>
								</div>
							</div>
							<!-- /step-->
						</div>
						<!-- /middle-wizard -->
						<div id="bottom-wizard">
              @csrf
							<button type="button" name="backward" class="backward">Prev</button>
							<button type="button" name="forward" class="forward" disabled="disabled">Next</button>
							<button type="submit" name="process" class="submit">Submit</button>
						</div>
						<!-- /bottom-wizard -->
					</form>
				</div>
@endsection

@section('js')
	<!-- Wizard script -->
	<script src="js/quotation_func.js"></script>
	<script type="text/javascript">

    Array.from(document.links).forEach((anchor) => {
          const href = anchor.getAttribute("href");
          if (href.startsWith("#")) {
              anchor.addEventListener("click", function(e) {
                  e.preventDefault();
                  const targetId = this.getAttribute("href").substring(1);
                  const targetEl = document.getElementById(targetId);
                  targetEl.scrollIntoView();
              });
          }
      });
                  
    $('input.tdate-pick-single').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        autoApply: true,
        minDate: new Date(),
        showCustomRangeLabel: false,
        locale: {
        	separator:' > ',
            direction: 'ltr',
            format: 'MM/DD/YY'
        }
      }, function (chosen_date) {
        $('input.tdate-pick-single').val(chosen_date.format('MM/DD/YY'));
        $("#tend_datepicker_span").text(chosen_date.format('MM/DD/YY'));
      });

    // Date picker single
    $('input.date-pick-single').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        autoApply: true,
        minDate: new Date(),
        showCustomRangeLabel: false,
        locale: {
        	separator:' > ',
            direction: 'ltr',
            format: 'MM/DD/YY'
        }
      }, function (chosen_date) {
        $('input.date-pick-single').val(chosen_date.format('MM/DD/YY'));
        $("#date").text(chosen_date.format('MM/DD/YY'));
    });

    function fn() {}
  </script>
@endsection
