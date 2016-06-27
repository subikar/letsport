  <?php 
  error_reporting(0); 
  $post=IRequest::get("POST");  
  //print_r($this->blogs); exit;
  ?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <!-- ngView:  -->
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Users</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=blog&task=addnew">Add Blog</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <form name="BlogForm" id="BlogForm" method="post" >
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>All Blog Posts</h4>
                <div class="options">
				  <input class="form-control" type="text" name="search_text" value="<?php echo $post["search_text"]; ?>" placeholder="Search here" />
				  <input type="button" name="Go" value="Go" onclick="document.BlogForm.submit();" />
				   </div>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1">Blog ID</th>
                        <th class="col-sm-5 hidden-xs">Blog Title</th>
                        <th class="col-sm-5 hidden-xs">Blog Update on</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php foreach($this->blogs as $blog):  ?>   
                      <tr class="ng-scope">
                        <td><?php echo $blog->id; ?></td>
                        <td class="ng-binding"><a href="index.php?view=blog&task=addnew&blog_id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></td>
                        <td class="ng-binding"><?php echo $blog->created; ?></td>
                        <td class="text-right"><div class="btn-group">
							<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=blog&task=addnew&blog_id=<?php echo $blog->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                             <button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$blog->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>">
							</i></button>
                            <span class="btn btn-xs btn-default-alt">
							<a title="Delete" href="index.php?view=blog&task=RemoveBlog&blog_id=<?php  echo (int)$blog->id; ?>"><i class="fa fa-fw fa-times"></i></a>
							</span>
                          </div>
						  </td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() -->
                      <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr class="active">
                        <td colspan="4" class="text-left" style="background: none;"><div class="clearfix">
                            <div class="pull-right">
							  <?php echo $this->Pagination; ?>
                              </div>
                          </div></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div class="clear"></div>
      </div>
	 <input type="hidden" name="view" value="blog" />
	  </form>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->

  <div class="clear"></div>