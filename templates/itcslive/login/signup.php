<div class="container">
		<div class="col-lg-12">
			<h2 class="section-heading">
				<span>Register</span>
			</h2>
			<div class="line"></div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-yellow">
					<!-- Begening of yellow panel -->
					<input type="hidden" id="valid_step" value="0">
					<form action="" method="post" id="signup" name="signup" enctype="multipart/form-data" novalidate="novalidate" class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
						<input type="hidden" name="is_secure" id="is_secure" value="704028" class="form-control" data-bv-field="is_secure">
						
												<div id="form1">
							<!-- Begening of form 1 -->
							<div class="panel-heading" style="color: #FFF; background: none repeat scroll 0% 0% #F2994B; border-color: #F2994B">Registration Form
							</div>
							<div class="panel-body pan">
								<div class="alert alert-success" style="display: none" id="notsave"><strong>Warning! </strong></div>
								<div class="form-body pal">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-cust_type">
												<label for="inputFirstName" class="control-label">
													Customer Type <span class="require">*</span>
												</label>
												<div class="input-icon right">
													<select name="cust_type" id="cust_type" class="form-control" onchange="dispayuser_requirement();" value="" data-bv-field="cust_type">
														<option value="">Select customer type</option>
														<option value="1">I am a Truck User</option>
														<option value="2">I am a Truck Supplier</option>
														<option value="0">Both</option>
													</select>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="cust_type" data-bv-result="NOT_VALIDATED" style="display: none;">The Customer Type is required and cannot be empty</small></div>
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-busi_type">
												<label for="inputLastName" class="control-label">Business Type <span class="require">*</span></label>
												<div class="input-icon right">
													<select id="busi_type" name="busi_type" value="" class="form-control" data-bv-field="busi_type">
														<option value="">Select business type</option>
														<option value="Manufacturing Company">Manufacturing Company</option>
														<option value="Distributor">Distributor</option>
														<option value="3PL/Logistic">3PL Player / Logistics Company</option>
														<option value="Transporter">Transporter</option>
														<option value="Broker/Agent">Broker / Agent</option>
														<option value="Fleet Owner">Fleet Owner</option>
													</select>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="busi_type" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Type is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-business_entity">
												<label for="inputEmail" class="control-label">Business Entity / Company Type <span class="require">*</span></label>
												<div class="input-icon">
													<select class="form-control" name="busi_entity" id="busi_entity" data-bv-field="busi_entity">
														<option value="">Select business entity / company type</option>
														<option value="Individuals">Individuals</option>
														<option value="Proprietorship">Proprietorship</option>
														<option value="Private Limited Company">Private Limited Company</option>
														<option value="Public Limited Company">Public Limited Company</option>
													</select>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="busi_entity" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Entity is required and cannot be empty</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error_company_establish_date">
												<label for="selGender" class="control-label">Date of Business Establishment <span class="require">*</span></label>
												<div class="input-group datetimepicker-disable-time date">
													<input type="text" value="" id="company_establish_date" name="company_establish_date" placeholder="Select date" class="form-control datepicker_new" data-bv-field="company_establish_date">
													 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="company_establish_date" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Registration Date is required and cannot be empty</small><small class="help-block" data-bv-validator="date" data-bv-for="company_establish_date" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Registration Date is not a valid</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error_busi_name">
												<label for="inputBirthday" class="control-label">Business Name </label>
												<div><input type="text" value="" id="busi_name" placeholder="Business name" name="busi_name" class="form-control"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="selCountry" class="control-label">Company Website <i>(Eg: http://www.abc.com)</i></label>
												<input type="url" name="website" id="website" value="" placeholder="Company Website" class="form-control  " data-bv-field="website">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-first_name">
												<label for="inputStreet" class="control-label">First Name of Primary Contact <span class="require">*</span></label>
												<div><input value="" id="first_name" placeholder="First Name" name="first_name" type="text" class="form-control " data-bv-field="first_name"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="first_name" data-bv-result="NOT_VALIDATED" style="display: none;">The First Name is required and cannot be empty</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-last_name">
												<label for="inputStreet" class="control-label">Last Name of Primary Contact <span class="require">*</span></label>
												<div><input id="last_name" value="" placeholder="Last name" name="last_name" type="text" class="form-control " data-bv-field="last_name"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="last_name" data-bv-result="NOT_VALIDATED" style="display: none;">The Last Name is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-address">
												<label for="inputCity" class="control-label">Full Address <span class="require">*</span></label>
												<div><input value="" name="address" id="address" placeholder="Address" type="text" class="form-control" data-bv-field="address"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED" style="display: none;">The Address is required and cannot be empty</small></div> 
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-locality">
												<label for="inputFirstName" class="control-label">Locality <span class="require">*</span></label>
												<div><input value="" name="locality" type="text" placeholder="Locality" class="form-control" id="locality" data-bv-field="locality"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="locality" data-bv-result="NOT_VALIDATED" style="display: none;">The Locality is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-city">
												<label for="inputFirstName" class="control-label">City <span class="require">*</span><i>(Start typing city name and select city from the list)</i></label>
												 <div><input id="city" value="" placeholder="City" name="city" type="text" class="form-control " data-bv-field="city" autocomplete="off"></div>
												 <div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="city" data-bv-result="NOT_VALIDATED" style="display: none;">The City is required and cannot be empty</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-state_id">
												<label for="inputFirstName" class="control-label">State <span class="require">*</span></label>
												<div>
													<select name="state" id="state" class="form-control" data-bv-field="state">
														<option value="">Select state</option>
														<option value="32">ANDAMAN &amp; NICOBAR</option><option value="1">ANDHRA PRADESH</option><option value="3">ARUNACHAL PRADESH</option><option value="2">ASSAM</option><option value="5">BIHAR</option><option value="31">CHANDIGARH</option><option value="37">CHATTISGARH</option><option value="30">DADRA &amp; NAGAR</option><option value="29">DAMAN &amp; DIU</option><option value="25">DELHI</option><option value="26">GOA</option><option value="4">GUJRAT</option><option value="6">HARYANA</option><option value="7">HIMACHAL PRADESH</option><option value="8">JAMMU &amp; KASHMIR</option><option value="36">JHARKHAND</option><option value="9">KARNATAKA</option><option value="10">KERALA</option><option value="28">LAKSHDWEEP</option><option value="11">MADHYA PRADESH</option><option value="12">MAHARASHTRA</option><option value="13">MANIPUR</option><option value="14">MEGHALAYA</option><option value="15">MIZORAM</option><option value="16">NAGALAND</option><option value="17">ORISSA</option><option value="27">PONDICHERY</option><option value="18">PUNJAB</option><option value="19">RAJASTHAN</option><option value="20">SIKKIM</option><option value="21">TAMIL NADU</option><option value="38">TELANGANA</option><option value="22">TRIPURA</option><option value="23">UTTAR PRADESH</option><option value="35">UTTARANCHAL</option><option value="24">WEST BENGAL</option>													</select>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="state" data-bv-result="NOT_VALIDATED" style="display: none;">The State is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-country">
												<label for="inputFirstName" class="control-label">Country <span class="require">*</span></label>
												<div><select name="country" id="country" placeholder="Country" value="" class="form-control " data-bv-field="country">
													<!-- <option value="">Select country</option> -->
													<option value="India">India</option>
												</select></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="country" data-bv-result="NOT_VALIDATED" style="display: none;">The Country is required and cannot be empty</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-pincode">
												<label for="inputPostCode" class="control-label">Pin Code <span class="require">*</span></label>
												<div>
													<input type="text" maxlength="6" value="" name="pincode" placeholder="Pincode" id="pincode" class="form-control " data-bv-field="pincode">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="pincode" data-bv-result="NOT_VALIDATED" style="display: none;">The Pincode is required and cannot be empty</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="pincode" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid pin code.</small><small class="help-block" data-bv-validator="integer" data-bv-for="pincode" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid pin code.</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<label for="selCountry" class="control-label">Landline No(0XX-XXXXX)</label><br>
											<div class="input-group">
												<input type="text" value="" size="3" name="LandLine1" id="LandLine1" class="form-control col-md-2" onchange="validlandline1();" data-bv-field="LandLine1">
												<span class="input-group-addon">-</span>
												<input type="text" value="" name="LandLine2" id="LandLine2" class="form-control col-md-3" onchange="validlandline2();" data-bv-field="LandLine2">
											</div>
											<div class="messageContainer has-error"><small class="help-block" data-bv-validator="regexp" data-bv-for="LandLine1" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Landline Number</small><small class="help-block" data-bv-validator="regexp" data-bv-for="LandLine2" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Landline Number</small></div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-pancard">
												<label for="selCountry" class="control-label">PAN Card No of Primary Contact <span class="require">*</span></label>
												<div>
													<input id="panCardNo" value="" type="text" name="panCardNo" placeholder="Pancard No" class="form-control  " data-bv-field="panCardNo">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="panCardNo" data-bv-result="NOT_VALIDATED" style="display: none;">The Pancard No is required and cannot be empty</small><small class="help-block" data-bv-validator="regexp" data-bv-for="panCardNo" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Pan Number</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-email">
												<label for="selCountry" class="control-label">Email <span class="require">*</span></label>
												<div>
													<input type="text" id="email" name="email" placeholder="Email" value="" class="form-control " data-bv-field="email">
												</div>
												 <div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">The Email is required and cannot be empty</small><small class="help-block" data-bv-validator="regexp" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">The value is not a valid email address</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-mobile">
												<label for="inputPhone" class="control-label">Mobile<span class="require">*</span></label>
												<div><input type="text" value="" id="mobile" placeholder="Mobile No" name="mobile" maxlength="10" class="form-control " data-bv-field="mobile"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="mobile" data-bv-result="NOT_VALIDATED" style="display: none;">The Mobile is required and cannot be empty</small><small class="help-block" data-bv-validator="regexp" data-bv-for="mobile" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Mobile Number</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="mobile" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a value with valid length</small></div>	
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-password">
												<label for="selCountry" class="control-label">Password <span class="require">*</span></label>
												<div>
													<input id="password1" type="password" value="" name="password" placeholder="Password" class="form-control " data-bv-field="password">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="password" data-bv-result="NOT_VALIDATED" style="display: none;">The Password is required and cannot be empty</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="confirm_passworddiv">
												<label for="selCountry" class="control-label">Confirm Password <span class="require">*</span></label>
												<div>
													<input type="password" placeholder="Confirm Password" name="confirm_password" value="" id="confirm_password" class="form-control " data-bv-field="confirm_password">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="confirm_password" data-bv-result="NOT_VALIDATED" style="display: none;">The Password is required and cannot be empty</small><small class="help-block" data-bv-validator="identical" data-bv-for="confirm_password" data-bv-result="NOT_VALIDATED" style="display: none;">The password and its confirm must be the same</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-membership_type">
												<label for="selCountry" class="control-label">Select membership <span class="require">*</span></label>
												<div>
													<select class="form-control" id="member_type" name="member_type">
														<option value="1">30 Days Free Trial</option><option value="2">Regular</option><option value="3">MSME</option><option value="4">Enterprise</option> 
													</select>
												</div>
												<div class="messageContainer"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<br>
												<label for="selCountry" class="control-label" style="color: #4683EA">
													If you select a membership plan,membership fees will be credited to your company's e-wallet
													to pay Transaction Fees.
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-pancard_img">
												<label for="pancard_image" class="control-label">Upload Copy of Personal PAN Card of Primary Contact (Recommended Size 300 X 200 - jpeg,jpg,png,gif)</label>
												<div><input type="file" value="" name="pancard_image" id="pancard_image" class="form-control" data-bv-field="pancard_image"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="file" data-bv-for="pancard_image" data-bv-result="NOT_VALIDATED" style="display: none;">The selected file is not valid</small></div>
												<label for="pancard_image" class="control-label"><i>(500 KB Max file size allowed)</i></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-business_pancard_image">
												<label for="pancard_image" class="control-label">Upload Copy of Business PAN Card <span class="require">*</span> (Recommended Size 300 X 200 - jpeg,jpg,png,gif)</label>
												<div><input type="file" value="" name="business_pancard_image" id="business_pancard_image" class="form-control" data-bv-field="business_pancard_image"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="business_pancard_image" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Pancard is required and cannot be empty</small><small class="help-block" data-bv-validator="file" data-bv-for="business_pancard_image" data-bv-result="NOT_VALIDATED" style="display: none;">The selected file is not valid</small></div>
												<label for="pancard_image" class="control-label"><i>(500 KB Max file size allowed)</i></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="img_busi_reg" class="control-label">Upload Copy of Business Registration Certificate <span class="require">*</span> </label>
												<label for="img_busi_reg" class="control-label">(shop &amp; establishment license, partnership deed, trade license, certificate of incorporation etc.) (Allowed files - jpeg,jpg,png,gif,pdf)</label>
												<div><input type="file" value="" name="img_busi_reg" id="img_busi_reg" class="form-control " data-bv-field="img_busi_reg"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="img_busi_reg" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Registration Image is required and cannot be empty</small><small class="help-block" data-bv-validator="file" data-bv-for="img_busi_reg" data-bv-result="NOT_VALIDATED" style="display: none;">The selected file is not valid</small></div>
												<label for="img_busi_reg" class="control-label"><i>(500 KB Max file size allowed)</i></label>
											</div>
										</div>
									</div>
									<div class="form-group">
								        <div class="col-md-10 col-md-offset-2">
								            <div id="messages"></div>
								        </div>
								    </div>
									<div class="form-actions text-right pal">
										<input value="NEXT" name="NEXT" type="submit" id="btn_next" class="btn btn-primary" onclick="Login.submitform('form');">
										
										&nbsp;<button type="button" class="btn btn-primary" onclick="window.location = 'http://192.168.9.100/custom/letsport/';" name="cancel">cancel</button>
									</div>
								</div><!-- End Form Body Panel -->
							</div>
						</div>
						<!-- end of form1 -->
						<div id="form2" style="display: none;">
								<!-- Begening of form2 -->
							<div class="panel-heading" style="color: #FFF; background: none repeat scroll 0% 0% #F2994B; border-color: #F2994B">Registration Form</div>
								<div class="form-body pal">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-company_logo_img">
												<div id="comp_logodiv">
													<label for="comp_logo" class="control-label">Company Logo: (Recommended Size 200 X 150 - jpeg,jpg,png,gif) </label>
													<input type="file" name="comp_logo" id="comp_logo" class="form-control">
													<label for="comp_logo" class="control-label"><i>(500 KB Max file size allowed)</i></label>
													<label id="msg5" style="color: red"></label>
												</div>
												<input id="businessNo" value="" type="hidden" placeholder="Business No" name="businessNo" class="form-control ">
												<!-- div class="form-group">
													<label for="selCountry" class="control-label">Business No</label>
												</div-->
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-busi_description">
												<label for="busi_desc" class="control-label">Business Description: <span class="require">* </span></label>
												<div class="input-icon right">
													<textarea name="busi_desc" rows="5" placeholder="Business Description" class="form-control" data-bv-field="busi_desc"></textarea>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="busi_desc" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Description Image is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="inputFirstName" class="control-label">Branches and Address:&nbsp; </label>
												<div class="branchandaddress">
				                        			<div class="col-sm-5" style="margin-bottom: 5px;padding-left:0px;">
				                        				<input class="form-control" id="branchname" name="branch_name[]" size="40" type="text" value="">
				                        			</div>
				                        			<div class="col-sm-5" style="margin-bottom: 5px;padding-left:0px;">
				                        				<textarea class="form-control" name="branch_address[]"></textarea>
				                        			</div>
				                        			<div class="col-sm-2" style="margin-bottom: 5px;padding-left:0px;">
				                        				&nbsp;
				                        			</div>
			                        			</div>
												<div id="TextBoxContainer">
													<!--Textboxes will be added here --> 
												</div>
												<div class="row" align="left" style="margin-left: 2%">
													<input type="button" id="btnAddbranch" align="right" class="btn btn-primary" value="Add more branch">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-statesoperated">
												<label for="inputStreet" class="control-label">States Being Operated: <span class="require">*</span></label>
												<div>
													<select id="stateoperated" multiple="multiple" name="stateoperated[]" class="form-control selectized" placeholder="Select states" data-bv-field="stateoperated[]" tabindex="-1" style="display: none;"></select><div class="selectize-control form-control multi plugin-remove_button"><div class="selectize-input items not-full has-options"><input type="text" autocomplete="off" tabindex="" placeholder="Select states" style="width: 85px;"></div><div class="selectize-dropdown multi form-control plugin-remove_button" style="display: none;"><div class="selectize-dropdown-content"></div></div></div>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="stateoperated[]" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Description Image is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row" id="for_truck_users">
										<div class="col-md-6">
											<div class="form-group" id="error-vehicle_required">
												<label for="vehicle_required" class="control-label">Vehicle required per month: <span class="require">*</span></label>
												<div>
													<input type="text" value="" name="vehicle_required" id="vehicle_required" class="form-control " placeholder="Vehicle required per month" data-bv-field="vehicle_required">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="vehicle_required" data-bv-result="NOT_VALIDATED" style="display: none;">The Number of Vehicle Required Par Month  is required and cannot be empty</small><small class="help-block" data-bv-validator="integer" data-bv-for="vehicle_required" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Vehicle Required.</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="vehicle_required" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Vehicle Required.</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-no_of_gps_system_required">
												<label for="vehicle_owned" class="control-label">No of trucks with GPS System Required: <span class="require"> * &nbsp;</span></label>
												<div>
													<input type="text" value="" id="no_of_gps_system_required" name="no_of_gps_system_required" class="form-control" placeholder="No of trucks with GPS system required" data-bv-field="no_of_gps_system_required">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="no_of_gps_system_required" data-bv-result="NOT_VALIDATED" style="display: none;">The No of trucks with GPS system required cannot be empty</small><small class="help-block" data-bv-validator="integer" data-bv-for="no_of_gps_system_required" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Number Of GPS System Required.</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="no_of_gps_system_required" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Number Of GPS System Required.</small></div>
											</div>
										</div>
										
									</div>
									<div class="row" id="for_truck_suppliers">
										<div class="col-md-6">
											<div class="form-group" id="error-vehicle_owned">
												<label for="vehicle_owned" class="control-label">No of vehicles owned: <span class="require"> * &nbsp;</span></label>
												<div>
													<input type="text" name="vehicle_owned" id="vehicle_owned" value="" class="form-control " placeholder="No of vehicles owned" data-bv-field="vehicle_owned">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="vehicle_owned" data-bv-result="NOT_VALIDATED" style="display: none;">The Number of Vehicle Owned is required and cannot be empty</small><small class="help-block" data-bv-validator="integer" data-bv-for="vehicle_owned" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Vehicle Owned.</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="vehicle_owned" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Vehicle Owned.</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-no_of_gps_system">
												<label for="vehicle_owned" class="control-label">No of trucks with GPS System Available: <span class="require"> * &nbsp;</span></label>
												<div>
													<input type="text" value="" id="no_of_GPS_system" name="no_of_gps_system" class="form-control" placeholder="How many of your trucks have GPS Tracking System" data-bv-field="no_of_gps_system">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="no_of_gps_system" data-bv-result="NOT_VALIDATED" style="display: none;">The No of trucks with GPS system available is required and cannot be empty</small><small class="help-block" data-bv-validator="integer" data-bv-for="no_of_gps_system" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Number Of GPS System.</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="no_of_gps_system" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Number Of GPS System.</small></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-truck_type">
												<label for="inputPhone" class="control-label">Type of Truck: </label>
												<div class="form-group">
													<select id="trucktype" multiple="multiple" name="trucktype[]" class="form-control selectized" placeholder="Select Truck Type" tabindex="-1" style="display: none;"></select><div class="selectize-control form-control multi plugin-remove_button"><div class="selectize-input items not-full has-options"><input type="text" autocomplete="off" tabindex="" placeholder="Select Truck Type" style="width: 117px;"></div><div class="selectize-dropdown multi form-control plugin-remove_button" style="display: none;"><div class="selectize-dropdown-content"></div></div></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="inputEmail" class="control-label">Service Offered: <span class="require">* </span></label>
												<div class="col-sm-10 services_offered_block" style="margin-bottom: 5px;padding-left:0px;">
													<input name="service_offered[]" type="text" value="" class="form-control " placeholder="Service Offered" data-bv-field="service_offered[]">
												</div>
												<div id="TextBoxContainer1"><!--Textboxes will be added here --></div>
											</div>
											<div class="row" align="left" style="margin-left: 2%">
												<input type="button" id="btnAddservice" align="right" class="btn btn-primary" value="Add more service">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="inputStreet" class="control-label">Major Routes being covered: <span class="require"> * &nbsp;</span></label>
												<br><br>
													<input type="hidden" name="rowcount" id="route_row_count" value="1">
<input type="hidden" value="" name="routes_busiid">	
<div class="row" id="route_number1" style="margin-bottom:0px;">
	<div class="col-md-5" style="margin-bottom:0px;">
		<div class="form-group">
			<input type="hidden" name="fromlatitude[]" id="latitudefromloc-1">
			<input type="hidden" name="fromlongitude[]" id="longitudefromloc-1">
			<input name="From_Location[]" type="text" id="fromloc-1" value="" placeholder="From location" class="form-control required location_input" data-value="fromloc-1" data-bv-field="From_Location[]" autocomplete="off">
		</div>
	</div>
	<div class="col-md-5" style="margin-bottom:0px;">
		<input type="hidden" name="tolatitude[]" id="latitudetoloc-1">
		<input type="hidden" name="tolongitude[]" id="longitudetoloc-1">
		<input name="To_Location[]" type="text" id="toloc-1" value="" placeholder="To location" class="form-control required location_input" data-value="toloc-1" data-bv-field="To_Location[]" autocomplete="off">
	</div>
	<div class="col-md-2" style="margin-bottom:0px;">
		&nbsp;
	</div>
</div>
		
<div id="TextBoxContainer2"><!--Textboxes will be added here --></div>
<div class="row">
	<div class="col-md-12">
		<div class="row" align="left" style="margin-left: 2%">
			<input type="button" id="addroute" style="align: right" class="btn btn-primary" onclick="addNewRoute();" value="Add more routes">
		</div>
	</div>
</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6"></div>
									</div>
									<div class="row">
										<div class="col-md-6" id="office_photodiv">
											<div class="form-group">
												<label for="inputCity" class="control-label">Upload Office Photo: (Recommended Size 500 X 350 - jpeg,jpg,png,gif)</label>
												<input type="file" name="office_photo" id="office_photo" class="form-control">
												<label for="selCountry" class="control-label"><i>(500 KB Max file size allowed)</i></label><br>
												<label id="msg3" style="color: red"></label>
											</div>
										</div>
										<div class="col-md-6" id="user_photodiv">
											<div class="form-group">
												<label for="inputPostCode" class="control-label">Upload User photo: (Recommended Size 300 X 400 - jpeg,jpg,png,gif) </label>
												<input type="file" name="user_photo" id="user_photo" class="form-control">
												<label for="selCountry" class="control-label"><i>(500 KB Max file size allowed)</i></label><br>
												<label id="msg4" style="color: red"></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-referral_code">
												<labiyak11el for="inputReferralCode" class="control-label">
													Do you have any referral code ?
												
												<div class="input-icon right">
													<input type="text" value="" id="referral_code" placeholder="Enter Referral Code" name="referral_code" class="form-control" onblur="checkAvailability()">
												<input type="hidden" value="" id="referral_code_id" placeholder="Referral Code" name="referral_code_id" class="form-control">
												</div>
												<div class="messageContainer"></div>
											</labiyak11el></div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div id="response1" class="alert"></div>
											</div>
											
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="selCountry" class="control-label">Enter Captcha</label>
												<div id="image1">
													<span><img id="captcha" src="https://freightbazaar.com/assets/captcha/1466842279.4365.jpg" style="width: 150; height: 30; border: 0;" alt=" "></span> &nbsp;
													<a href="javascript:refresh();" class="refresh">
														<i class="fa fa-refresh"></i>
													</a>
												</div>
												<div style="margin-top:5px;">
													<input type="text" name="secure" class="form-control" value="" data-bv-field="secure">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<br><br>
											<div class="form-group">
												<div>
													<input type="checkbox" class="form-control" name="terms_accepted[]" checked="" style="width: 15px; height: 15px; position: relative;float:left;" data-bv-field="terms_accepted[]">
													&nbsp;I agree &amp; accept <a href="terms&amp;condition.php" target="_blank">terms and conditions.</a>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="terms_accepted[]" data-bv-result="NOT_VALIDATED" style="display: none;">Please accept terms and condition.</small></div>
											</div>
											<div class="form-group">
												<div>
													<input type="checkbox" class="form-control" name="terms_accepted1[]" checked="" style="width: 15px; height: 15px; position: relative;float:left;">
													&nbsp;I agree to receive emails, SMS and news letters.
												</div>
												<div class="messageContainer"></div>
											</div>
										</div>
									</div>
									<div class="form-actions text-right pal">
										<button type="button" name="submit1" id="btn_submit" class="btn btn-primary">Submit</button>&nbsp;
										<button type="button" class="btn btn-primary" id="btn_prev" onclick="dispalyform1();">Previous</button>&nbsp;
										<button type="button" class="btn btn-primary" onclick="window.location = 'https://freightbazaar.com/';">cancel</button>
									</div>
								</div><!-- End panel body -->
							</div>	<!-- End Form2 -->
					</form>
				</div><!-- End Yellow Panel -->
			</div><!-- End Column -->
		</div><!-- End Row -->
	</div>