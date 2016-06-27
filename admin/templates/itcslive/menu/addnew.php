 <?php
 error_reporting(0); 
 global $my;
 $MenuData=$this->menuData;  
 if(!isset($this->menuData))
 $parent_id=IRequest::getInt("parent");
 else
 $parent_id=$this->menuData->parent;
 ?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	<form name="SaveUser" action="" method="post" enctype="multipart/form-data" onsubmit="return Menu.validateForm(this);">
      <div class="ng-scope" id="page-heading">
        <h1>Add New Menu</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-group" dropdown="">
			 <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save" value="Publish" />
			  </div>
              <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save_close" value="Publish&Close" />
			  </div>
			   <div class="btn btn-default dropdown-toggle btn-save">
			  	<a href="index.php?view=menu">Cancel</a>
			  </div>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Menu Description</h4>
              </div>
			  
              <div class="panel-body no-padding">
			  		<div class="panel-body-left">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-link"></i></span>
									<input class="form-control" id="alias" type="text" name="alias" value="<?php echo isset($MenuData->alias) ? $MenuData->alias : ''; ?>" placeholder="url Name" onblur="return Menu.checkDuplicate(this);" />
								</div>
							</div>
							<span id="error_alias" style="color:#FF00CC;"></span>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<input class="form-control" id="title" type="text" name="title" value="<?php echo $MenuData->title; ?>" placeholder="Enter Blog Title" />
								</div>
							</div>
						</div>	
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<select name="parent" >
									<option value="0">Select Parent</option>
									<?php foreach($this->ParentMenuList as $parent): $parentSelect=((int)$parent_id ==$parent->id ) ? 'selected="selected"' : ''; ?>
									<option value="<?php echo $parent->id; ?>" <?php echo $parentSelect; ?> ><?php echo $parent->title; ?></option>
									<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>	
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<input type="text" name="ordering" value="<?php echo $MenuData->ordering; ?>" />
								</div>
							</div>
						</div>	  			  
			  		</div>
					<div class="panel-body-right">
						<div><span>Last Updated:</span><span></span></div>
						<div class="select_cat">
						Select Menu Type: 
							<select name="menuType" onchange="Menu.showMenu(this);">
								<option value="">External Link</option>
								<?php foreach($this->MenuType as $Type): ?>	
								<option value="<?php echo $Type->type; ?>"><?php echo ucfirst($Type->type); ?></option>
								<?php endforeach; ?>						
							</select>
							
						</div>
						<div id="selectList" class="">
						<select name="menuItem" id="menuItem" onchange="Menu.PopulateData(this)">
						<option value="0">Select Item</option>
						</select>
						</div>
					</div>
              </div>
			  <input type="hidden" name="view" value="menu" />
			  <input type="hidden" name="task" value="savemenu" />
		  	  <input type="hidden" id="menu_id" name="menu_id" value="<?php echo (int)$MenuData->id; ?>" />
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
    </div>
	</form>
  </div>
  <div class="clear"></div>