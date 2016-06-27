<?php
 error_reporting(0); 
 global $my;
 $BlogData=$this->BlogData;  
 $user_id=((int)$BlogData ->author > 0) ? $BlogData ->author : $my->uid; 
?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <!-- ngView:  -->
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
	<form name="SaveUser" action="" method="post" enctype="multipart/form-data" onsubmit="return Blog.validateForm(this);">
      <div class="ng-scope" id="page-heading">
        <!-- <ol class="breadcrumb">
                <li class='active'><a href="index.htm">Dashboard</a></li>
            </ol> -->
        <h1>Add New Blogs</h1>
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
			  	<a href="index.php?view=blog">Cancel</a>
			  </div>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Create Blog</h4>
              </div>
			  
              <div class="panel-body no-padding">
			  		<div class="panel-body-left">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-link"></i></span>
									<input class="form-control" type="text" name="alias" value="<?php echo isset($BlogData->alias) ? $BlogData->alias : ''; ?>" placeholder="url Name" onblur="return Blog.checkDuplicate(this);" />
								</div>
							</div>
							<span id="error_alias" style="color:#FF00CC;"></span>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<input class="form-control" type="text" name="title" value="<?php echo $BlogData->title; ?>" placeholder="Enter Blog Title" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
									<textarea class="form-control" name="content" id="editor" placeholder="Enter Description"><?php echo $BlogData->content; ?></textarea>
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
								<input type="text" class="form-control" name="metadescription" placeholder="Enter Meta Description" value="<?php echo $BlogData->metadescription; ?>" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<input type="text" class="form-control" name="metatitle" placeholder="Enter Meta Title" value="<?php echo $BlogData->metatitle; ?>" />
								</div>
							</div>
						</div>			  
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key"></i></span>
									<input type="text" class="form-control" name="metakeyword" placeholder="Enter Meta Keyword" value="<?php echo $BlogData->metakeyword; ?>" />
								</div>
							</div>
						</div>			  
			  		</div>
					<div class="panel-body-right">
						<div><span>Last Updated:</span><span></span></div>
						<!--<div class="btn-group" dropdown="">
						<button aria-expanded="false" aria-haspopup="true" type="button" class="btn btn-default dropdown-toggle btn-save">
						<input type="submit" name="Save user" value="Save" /></button></div>-->
						<div class="select_cat">
							<select name="category">
								<option>Select Category</option>
								<?php foreach($this->Category as $cat): $catSelect=($cat->id == $BlogData->category) ? 'selected="selected"' : '';?>
								<option value="<?php echo $cat->id ?>" <?php echo $catSelect; ?> ><?php echo $cat->category_name; ?></option>	
								<?php endforeach; ?>
							</select>
						</div>
						 <div id="">
						 <?php if(isset($BlogData->gallery)): foreach($BlogData->gallery as $image): ?>
						 <span>
						 <img src="../images/gallery/<?php echo $image; ?>"  style="height:80px; width:80px;"/>Delete:
						 <input type="checkbox" name="remove_gallery[]" value="<?php echo $image; ?>" />
						 </span>
						 <?php endforeach;  endif; ?>
						  </div>
						<div class="btn-group" dropdown="">
						<!--<button aria-expanded="false" aria-haspopup="true" type="button" class="btn btn-default dropdown-toggle btn-save"></button>
						<button aria-expanded="false" aria-haspopup="true" type="button" class="btn btn-default dropdown-toggle btn-save"></button>-->
						<input type='button' value='Add Gallery' id='addButton'>
						 <input type='button' value='Remove Gallery' id='removeButton'></div>
						<div class="picgallery">
							<span>
							<div id='prevworkGroup'>
							<div class="add_image">
								<div id="prevworkBoxDiv1" class="input_browse">
								<div id="message1"></div>
								<label>Gallery#1: </label>
								<input class="pop_button file_uploadd" type="file" name="image_upload[]"  onchange="Blog.uplodeGallery(this,1);"/>
							  	</div>
							  <span class="sp_image_upload"><img id="blah1" src="../images/no_image_found.jpg" style="height:100px; width:100px;" align="right" /></span>
							  <div class="clear"></div>
							  </div>
						  </div>
						  </span>
							<span></span>
						</div>						
					</div>
              </div>
			  <input type="hidden" name="view" value="blog" />
			  <input type="hidden" name="task" value="saveblog" />
		  	  <input type="hidden" id="blog_id" name="blog_id" value="<?php echo $BlogData->id; ?>" />
			  <input type="hidden" name="gallery_id" value="<?php echo $BlogData->gallery_id; ?>" />
			  <input type="hidden" name="author" value="<?php echo $user_id; ?>" />
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
	</form>
    <!--wrap -->
  </div>
  <!-- page-content -->

  <div class="clear"></div>