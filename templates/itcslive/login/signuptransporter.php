<?php $post = IRequest::get('POST'); ?>
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
					
					<form action="" method="post" id="signup_transporter" name="signup_transporter" enctype="multipart/form-data" novalidate="novalidate" class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
						<div id="form1">
							<!-- Begening of form 1 -->
							<div class="panel-heading" style="color: #FFF; background: none repeat scroll 0% 0% #F2994B; border-color: #F2994B">Registration Form
							</div>
							<div class="panel-body pan">
								<div class="alert alert-success"><strong><?php echo $this->RegistrationError; ?> </strong></div>
								<div class="form-body pal">



									<div class="row">
									    			<div class="col-md-6">
											<div class="form-group" id="error-password">
												<label for="selCountry" class="control-label">Transport Name: <span class="require">*</span></label>
												<div>
													<input id="Transport_Name" type="text" value="" name="Transport_Name" placeholder="Transport Name:" class="form-control " data-bv-field="password">
												</div>
												
											</div>
										</div>
										
										
										<div class="col-md-6">
											<div class="form-group" id="error-password">
												<label for="selCountry" class="control-label">Transporter Type: <span class="require">*</span></label>
												<div>
													
													<select name="Transporter_Type" id="Transporter_Type" class="form-control" data-bv-field="state">
														<option value="<?php echo Transporter_Type ;?>">Select state</option>  
														<option value="Owner">Owner</option>
														<option value="Broker">Broker</option>
														<option value="Agent">Agent</option> 
												</select >
											</div>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-first_name">
												<label for="inputStreet" class="control-label">Name <span class="require">*</span></label>
												<div><input value="<?php echo $post['name']; ?>" id="first_name" placeholder="Name" name="name" type="text" class="form-control " data-bv-field="first_name"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="first_name" data-bv-result="NOT_VALIDATED" style="display: none;">The First Name is required and cannot be empty</small></div>
											</div>
										</div>	
									
										<div class="col-md-6">
											
											<div class="form-group" id="error-email">
												<label for="selCountry" class="control-label">Email <span class="require">*</span></label>
												<div>
													<input type="text" id="email" name="email" placeholder="Email" value="<?php echo $post['email']; ?>" class="form-control " data-bv-field="email">
												</div>
												 <div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">The Email is required and cannot be empty</small><small class="help-block" data-bv-validator="regexp" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">The value is not a valid email address</small></div>
											</div>
										</div>								
										
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="error-address">
												<label for="inputCity" class="control-label">Address <span class="require">*</span></label>
												<div><input value="<?php echo $post['address']; ?>" name="address" id="address" placeholder="Address" type="text" class="form-control" data-bv-field="address"></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED" style="display: none;">The Address is required and cannot be empty</small></div> 
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="error-city">
												<label for="inputFirstName" class="control-label">City <span class="require">*</span></label>
												 <div><input value="<?php echo $post['city']; ?>" id="city"  placeholder="City" name="city" type="text" class="form-control " data-bv-field="city" autocomplete="off"></div>
												 <div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="city" data-bv-result="NOT_VALIDATED" style="display: none;">The City is required and cannot be empty</small></div>
											</div>
										</div>
									</div>
									<div class="row">

										<div class="col-md-6">
											<div class="form-group" id="error-state_id">
												<label for="inputFirstName" class="control-label">State <span class="require">*</span></label>
												<div>
													<select name="state" id="state" class="form-control" data-bv-field="state">
														<option value="<?php echo state; ?>">Select state</option>
														<option value="32">ANDAMAN &amp; NICOBAR</option><option value="1">ANDHRA PRADESH</option><option value="3">ARUNACHAL PRADESH</option><option value="2">ASSAM</option><option value="5">BIHAR</option><option value="31">CHANDIGARH</option><option value="37">CHATTISGARH</option><option value="30">DADRA &amp; NAGAR</option><option value="29">DAMAN &amp; DIU</option><option value="25">DELHI</option><option value="26">GOA</option><option value="4">GUJRAT</option><option value="6">HARYANA</option><option value="7">HIMACHAL PRADESH</option><option value="8">JAMMU &amp; KASHMIR</option><option value="36">JHARKHAND</option><option value="9">KARNATAKA</option><option value="10">KERALA</option><option value="28">LAKSHDWEEP</option><option value="11">MADHYA PRADESH</option><option value="12">MAHARASHTRA</option><option value="13">MANIPUR</option><option value="14">MEGHALAYA</option><option value="15">MIZORAM</option><option value="16">NAGALAND</option><option value="17">ORISSA</option><option value="27">PONDICHERY</option><option value="18">PUNJAB</option><option value="19">RAJASTHAN</option><option value="20">SIKKIM</option><option value="21">TAMIL NADU</option><option value="38">TELANGANA</option><option value="22">TRIPURA</option><option value="23">UTTAR PRADESH</option><option value="35">UTTARANCHAL</option><option value="24">WEST BENGAL</option>													</select>
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="state" data-bv-result="NOT_VALIDATED" style="display: none;">The State is required and cannot be empty</small></div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group" id="error-pancard">
												<label for="selCountry" class="control-label">PAN Card OR Adhar Card No. <span class="require">*</span></label>
												<div>
													<input id="panCardNo" value="<?php echo $post['PAN_Card_No']; ?>" type="text" name="PAN_Card_No" placeholder="Pancard No" class="form-control  " data-bv-field="panCardNo">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="panCardNo" data-bv-result="NOT_VALIDATED" style="display: none;">The Pancard No is required and cannot be empty</small><small class="help-block" data-bv-validator="regexp" data-bv-for="panCardNo" data-bv-result="NOT_VALIDATED" style="display: none;">Invalid Pan Number</small></div>
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-6">
											<div class="form-group">
												<label for="img_busi_reg" class="control-label">Upload your Profile image: <span class="require">*</span> </label>
												<div><input type="file" name="avatar" id="img_busi_reg" class="form-control " data-bv-field="img_busi_reg"/></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="img_busi_reg" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Registration Image is required and cannot be empty</small><small class="help-block" data-bv-validator="file" data-bv-for="img_busi_reg" data-bv-result="NOT_VALIDATED" style="display: none;">The selected file is not valid</small></div>
												<label for="img_busi_reg" class="control-label"><i>(500 KB Max file size allowed)</i></label>
											</div>
										</div>
									
										
										<div class="col-md-6">
											<div class="form-group" id="error-mobile">
												<label for="inputPhone" class="control-label">Mobile<span class="require">*</span></label>
												<div><input type="text" value="<?php echo $post['phone']; ?>" id="mobile" placeholder="Mobile No" name="phone" maxlength="10" class="form-control " data-bv-field="mobile"></div>
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
											<div class="form-group" id="confirm_passworddiv">
												<label for="selCountry" class="control-label">Registration no: <span class="require">*</span></label>
												<div>
													<input type="text" placeholder="Registration no:" name="Registration_no" value="" id="Registration_no" class="form-control " data-bv-field="Registration_no">
												</div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="confirm_password" data-bv-result="NOT_VALIDATED" style="display: none;">The Password is required and cannot be empty</small><small class="help-block" data-bv-validator="identical" data-bv-for="confirm_password" data-bv-result="NOT_VALIDATED" style="display: none;">The password and its confirm must be the same</small></div>
											</div>
										</div>
									</div>


									
										
									
									<div class="form-group">
								        <div class="col-md-10 col-md-offset-2">
								            <div id="messages"></div>
								        </div>
								    </div>
									<div class="form-actions text-right pal">
										<input value="NEXT" name="NEXT" type="button" id="btn_next" class="btn btn-primary" onclick="Transporter_SignUp.SubmitForm('signup_transporter');"/>
										
										&nbsp;<button type="button" class="btn btn-primary" onclick="window.location = '<?php echo $this->site; ?>';" name="cancel">cancel</button>
										<input name="view" value="contact" type="hidden" />
										<input name="task" value="SaveRegister" type="hidden" />
										<input name="usertype" value="transporter" type="hidden" />
									</div>
								</div><!-- End Form Body Panel -->
							</div>
						</div>
						<!-- end of form1 -->
					</form>
				</div><!-- End Yellow Panel -->
			</div><!-- End Column -->
		</div><!-- End Row -->
	</div>