<?php 
error_reporting(0); 
$Page=$this->pageData;
global $my;
$user_id=((int)$Page->author)? $Page->author : $my->uid;
 //require_once IPATH_ROOT."/classes/external/phphtmledit/cuteeditor_files/include_CuteEditor.php" ;
 //$editor=new CuteEditor(); 

 ?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	<form name="SavePage" action="" method="post" enctype="multipart/form-data" onsubmit="return Page.validateForm(this);">
	
      <div class="ng-scope" id="page-heading"> 
        <h1>Add/Edit Page</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-group" dropdown="">
              <div class="btn btn-default dropdown-toggle btn-save">
			  	<input type="submit" name="Save" value="Save" />
				</div>
				<div class="btn btn-default dropdown-toggle btn-save">
				<input type="submit" name="save_close" value="Save&Close" />
			  </div>
			   <div class="btn btn-default dropdown-toggle btn-save">
			  	<a href="index.php?view=page">Cancel</a>
			  </div>			  
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Create Page</h4>
              </div>
			  
              <div class="panel-body no-padding">
			  	<div class="panel-body-left">
				<div class="input-group">
				  	<span class="input-group-addon" title="Page Url"><i class="fa fa-link"></i></span>
				<input class="form-control" type="text" name="alias" value="<?php echo $Page->alias; ?>" placeholder="Enter alias" onblur="return Page.checkDuplicate(this);" />
				 <span id="error_alias" style="color:#FF00CC;"></span>
				  </div>
				<div class="input-group">
				  	<span class="input-group-addon" title="Page Title"><i class="fa fa-pencil-square-o"></i></span>
					<input class="form-control" type="text" name="title" value="<?php echo $Page->title; ?>" placeholder="Enter Title"/>
				 <span id="error_title" style="color:#FF00CC;"></span>
				  </div>
				<div class="input-group">
				  	<span class="input-group-addon" title="Page Class"><i class="fa fa-pencil-square-o"></i></span>
					<input class="form-control" type="text" name="pageclass" value="<?php echo $Page->pageclass; ?>" placeholder="Enter Page class"/>
				 <span id="error_title" style="color:#FF00CC;"></span>
				  </div>				  
				  <div class="input-group">
				  	<span class="input-group-addon" title="Page Meta Title"><i class="fa fa-pencil-square-o"></i></span>
					<input class="form-control" type="text" name="metatitle" value="<?php echo $Page->metatitle; ?>" placeholder="Enter Meta Title" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon" title="Page Meta Description"><i class="fa fa-list-alt"></i></span>
					<input class="form-control" type="text" name="metadescription" value="<?php echo $Page->metadescription; ?>" placeholder="Enter Meta Description" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon" title="Page Meta Keyword"><i class="fa fa-key"></i></span>
					<input class="form-control" type="text" name="metakeyword" value="<?php echo $Page->metakeyword; ?>" placeholder="Enter Meta Keyword" />
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon" title="Select Is Full Page"><i class="fa fa-key"></i></span>
					<select class="form-control" name="isfullpage"><option value="0" <?php echo ($Page->isfullpage ==0)?'selected="selected"':''; ?>>No</option><option value="1"<?php echo ($Page->isfullpage ==1)?'selected="selected"':''; ?>>Yes</option></select>
				  </div>
				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-th"></i></span>
					<textarea class="tinyEditor" id="editor" name="content" placeholder="Enter Content" style="height:400px;">
					<?php echo $Page->content; ?>
					</textarea>
				  
				  </div>
				</div>
				<div class="panel-body-right">
				  <div class="input-group">Gallery ID: <?php echo (int)$Page->gallery_id; ?>
				  <div id="" class="uploaded_area">
				 <?php foreach($Page->gallery as $image): ?>
				 <span class="total_uploaded_pic">
				 <span>
				 <img src="../images/gallery/<?php echo $image; ?>" />
				 </span>
				 <span>
				 <input type="checkbox" name="remove_gallery[]" value="<?php echo $image; ?>" />Delete:
				 </span>
				 <div class="clear"></div>
				 </span>
				 <?php endforeach; ?>
				  </div>
				  <div class="clear"></div>
				  	<div class="upload_area"><span><i class="fa fa-upload"></i></span><span class="upload_div">Upload Gallery:</span></div>
						<div id="prevworkGroup" class="galleryarea">
							<div class="add_image">
								<div id="prevworkBoxDiv1" class="input_browse">
								<div id="message1"></div>
								<label>Gallery#1: </label>
								<input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Page.uplodeGallery(this,1);"/>
							  	</div>
							  <span class="sp_image_upload"><img id="blah1" src="../images/no_image_found.jpg" style="height:100px; width:100px;" align="right" /></span>
							  <div class="clear"></div>
							  </div>
						  </div>
						  <input type='button' value='+' id='addButton'>
						 <input type='button' value='-' id='removeButton'>
				  </div>

				  <div class="input-group">
				  	<span class="input-group-addon"><i class="fa fa-th"></i></span>
					<textarea  name="jsscript" placeholder="Enter JS" style="height:100px;">
					<?php echo $Page->jsscript; ?>
					</textarea>
				  
				  </div>

				  
				  </div>
				  <div class="clear"></div>
			  </div>
			  <input type="hidden" name="view" value="page" />
			  <input type="hidden" name="task" value="savepage" />
			  <input type="hidden" name="author" value="<?php echo $user_id; ?>" />
			  <input type="hidden" id="page_id" name="page_id" value="<?php echo (int)$Page->id; ?>" />
			  <input type="hidden" name="gallery_id" value="<?php echo (int)$Page->gallery_id; ?>" />
			  
			  
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
    </div>
	</form>
  </div>
  </div>
  <div class="clear"></div>
  <style>
  .page{ width:300px;}
  .MyClass{ width:200px;}
  </style>