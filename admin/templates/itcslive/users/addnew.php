<?php 
if(isset($this->User))
$User=$this->User;

$UserType=array("customer"=>"Customer","Admin"=>"Admin","owner"=>"Transport Owner","broker"=>"Transport Broker","agent"=>"Transport Agent");
?>  
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <!-- ngView:  -->
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	
      <div class="ng-scope" id="page-heading">
        <h1>Add New Users</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-group" dropdown="">
              <input type="button" name="Save user" value="Save" onclick="User.validateAddUser('userForm');"/>
            </div>
			 <div class="btn-group" dropdown="">
             <a href="index.php?view=users">Cancel or Back</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <form name="userForm" action="" method="post" id="userForm" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Create New Acount</h4>
              </div>
			  
              <div class="panel-body no-padding">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-male"></i></span>
									<input class="form-control" type="text" name="name" value="<?php echo $User->name; ?>" placeholder="Enter Name" />
								</div><span class="user_error" id="error_name"></span>
							</div>
						</div>	
								  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<input class="form-control" type="text" name="email" value="<?php echo $User->email; ?>" placeholder="Enter email" />
								</div><span class="user_error" id="error_email"></span>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
									<input class="form-control" type="text" name="phone" value="<?php echo $User->phone; ?>" placeholder="Enter phone" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
									<input class="form-control" type="text" name="PAN_Card_No" value="<?php echo $User->PAN_Card_No; ?>" placeholder="Enter PAN Card OR Adhar Card No" />
								</div>
							</div>
						</div>			  
								  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
									<input class="form-control placepicker" data-type="geo_code" type="text" name="address" value="<?php echo $User->address; ?>" placeholder="Enter Address" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
									<input class="form-control" type="text" name="city" value="<?php echo $User->city; ?>" placeholder="Enter city" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
									<input class="form-control" type="text" name="state" value="<?php echo $User->state; ?>" placeholder="Enter state" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
									<input class="form-control" type="text" name="country" value="<?php echo $User->country; ?>" placeholder="Enter country" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
									<input class="form-control" type="text" name="Transport_Name" value="<?php echo $User->Transport_Name; ?>" placeholder="Transport Name" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input class="form-control" type="text" name="password" value="<?php echo $User->password; ?>" placeholder="Enter password" />
								</div>
							</div>
						</div>		
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input class="form-control" type="text" name="Registration_no" value="<?php echo $User->password; ?>" placeholder="Registration No" />
								</div>
							</div>
						</div>		
						<div class="form-group">
												<label for="img_busi_reg" class="control-label">Upload your Profile image: <span class="require">*</span> </label>
												<div><input type="file" name="avatar" id="img_busi_reg" class="form-control " data-bv-field="img_busi_reg"/></div>
												<div class="messageContainer has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="img_busi_reg" data-bv-result="NOT_VALIDATED" style="display: none;">The Business Registration Image is required and cannot be empty</small><small class="help-block" data-bv-validator="file" data-bv-for="img_busi_reg" data-bv-result="NOT_VALIDATED" style="display: none;">The selected file is not valid</small></div>
												<label for="img_busi_reg" class="control-label"><i>(500 KB Max file size allowed)</i></label>
						</div>		  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
								   <select name="usertype" class="form-control">
									   <?php foreach($UserType as $key=>$type):  $selectedType=(strcasecmp($key,$User->usertype)==0) ? 'selected="selected"' : '' ; ?>
										<option value="<?php echo $key; ?>" <?php echo $selectedType; ?> ><?php echo $type; ?></option>
									   <?php endforeach; ?>
								   </select>
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-ban"></i></span>
								   <select name="status" class="form-control">
								     <option value="1" <?php echo (int)$User->status==1 ? 'selected="selected"' : '' ; ?> >UnBlock</option>
									 <option value="0" <?php echo (int)$User->status==0 ? 'selected="selected"' : '' ; ?> >Block</option>									 
								   </select>
								</div>
							</div>
						</div>			  
			  
              </div>
			  <input type="hidden" name="view" value="users" />
			  <input type="hidden" name="task" value="saveuser" />
			  <input type="hidden" name="uid" id="user_id" value="<?php echo (int)$User->uid ?>" />
            </div>
          </div>
		  </form>
        </div>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
  </div>
  <!-- page-content -->

  <div class="clear"></div>