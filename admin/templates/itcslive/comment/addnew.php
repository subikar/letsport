<?php 
	error_reporting(0);
	$comment=$this->commentData;
?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	
	<form name="SavePage" action="" method="post" enctype="multipart/form-data" onsubmit="return Comment.validateForm(this);">
      <div class="ng-scope" id="page-heading">
        <h1>Add/Edit Comment</h1>
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
			  	&nbsp;&nbsp;<a href="index.php?view=comment">Cancel </a>
			  </div>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Create Comment</h4>
              </div>
			  
              <div class="panel-body no-padding">
			  	<div class="panel-body-left">
					<div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-link"></i></span>
				<input class="form-control" type="text" name="alias" value="<?php echo $this->seoData->seo; ?>" placeholder="Enter alias" onblur="return Comment.checkDuplicate(this);" />
				 <span id="error_alias" style="color:#FF00CC;"></span>
				  </div>
					<div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-male"></i></span>
					<input class="form-control" type="text" name="name" value="<?php echo $comment->name; ?>" placeholder="Enter Name" onblur="return Comment.checkDuplicate(this);" />
				 <span id="error_title" style="color:#FF00CC;"></span>
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input class="form-control" type="text" name="email" value="<?php echo $comment->email; ?>" placeholder="Enter Email ID" />
				  </div>				 
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
					<input class="form-control" type="text" name="type" value="<?php echo $comment->type; ?>" placeholder="Enter Comment Type" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
					<textarea class="form-control" name="comment" id="editor" placeholder="Enter Description"><?php echo  $comment->comment; ?></textarea>
				</div>				 
				</div>				
				 <div class="clear"></div>
			  </div>
			  <input type="hidden" name="view" value="comment" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" id="comment_id" name="comment_id" value="<?php echo (int)$comment->id; ?>" />
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
    </div>
	</form>
  </div>
  <div class="clear"></div>
  </div>
  <style>
  .page{ width:300px;}
  </style>
  