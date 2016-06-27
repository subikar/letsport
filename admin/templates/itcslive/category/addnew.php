<?php 
error_reporting(0);
$Category=$this->categoryData;
if(!isset($this->categoryData))
 $parent_id=IRequest::getInt("category");
 else
 $parent_id=$this->categoryData->category_parent;
/*global $my;
$user_id=((int)$Page->author)? $Page->author : $my->uid;*/
?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	<form name="SavePage" action="" method="post" enctype="multipart/form-data" onsubmit="return Category.validateForm(this);">
      <div class="ng-scope" id="page-heading">
        <h1>Add/Edit Category</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-group" dropdown="">	
			 <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save" value="Save" />		 
			  </div>	
			 <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save_close" value="Save&Close" />			 
			  </div>
			   <div class="btn btn-default dropdown-toggle btn-save">
			  	<a href="index.php?view=category">Cancel</a>			 
			  </div>             
            </div>
        </div>
      </div>
       <div class="container ng-scope" ng-controller="DashboardController">	   
        <div class="row">		          
          <div class="col-md-12">		  
            <div class="panel panel-gray">						
              <div class="panel-heading">
                <h4>Create Category</h4>       			  
			  </div>
              <div class="panel-body no-padding">
			  		<div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-link"></i></span>
				<input class="form-control" type="text" name="alias" value="<?php echo $this->seoData->seo; ?>" placeholder="Enter alias" onblur="return Category.checkDuplicate(this);" />
				 <span id="error_alias" style="color:#FF00CC;"></span>
				  </div>
					<div class="input-group">
				  	<span class="input-group-addon">Category Name:</span>
					<input class="form-control" type="text" name="category_name" value="<?php echo $Category->category_name; ?>" placeholder="Enter Category Name"  onblur="return Category.checkDuplicate(this);"  />
					<span id="error_title" style="color:#FF00CC;"></span> 				 
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Type:</span>
					<input class="form-control" type="text" name="type" value="<?php echo $Category->type;  ?>" placeholder="Enter Category Type" />					
 				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon">Parent:</span>
					<select class="form-control" name="category_parent">
						<option>Select Parent</option>
						<?php   $selectP = ((int)$Category->category_parent == (int)$Category->id)? '' : 'selected="selected"'; ?>
						<option value="0" <?php echo $selectP; ?> >No Parent</option>
						
						<?php  foreach($this->CategoryType as $CateParent):  
							$select = ((int)$parent_id == (int)$CateParent->id)? 'selected="selected"' : '';   ?>
						<option value="<?php echo $CateParent->id; ?>" <?php echo $select;  ?> >
								 <?php  echo $CateParent->type; ?>
						</option>							
							<?php  endforeach;  ?>
							
					</select>
				  </div>
			  </div>
			  <input type="hidden" name="view" value="category" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" id="category_id" name="category_id" value="<?php echo (int)$Category->id; ?>" />			 
			  </form>
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <style>
  .page{ width:300px;}
  </style>