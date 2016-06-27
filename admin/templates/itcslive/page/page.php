<?php error_reporting(0);  
$post=IRequest::get("POST"); 
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Pages</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=page&task=addnew">New Page</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
	  <form name="PageForm" id="PageForm" method="post" >
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Page Manager</h4>
                <div class="options"> 
				  <input class="form-control" type="text" name="title_text" value="<?php echo $post["title_text"]; ?>" placeholder="Search here" /> 
				  <input type="button" name="Go" value="Go" onclick="document.PageForm.submit();" />
				  </div>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
                        <th class="col-xs-1 col-sm-1">Page ID</th>
                        <th class="col-xs-9 col-sm-4">Title</th>
                        <th class="col-sm-5 hidden-xs">Page Content</th>
                        <th class="col-sm-5 hidden-xs">Metadescription</th>
                        <th class="col-sm-5 hidden-xs">Created on</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects" style="font-size:13px;">
					   <?php  foreach($this->pages as $page): ?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $page->id; ?>]"  /></td>
                         <td><?php echo $page->id; ?></td>
						<td><a href="index.php?view=page&task=addnew&page_id=<?php echo (int)$page->id; ?>"><?php echo $page->title; ?></a></td>
                        <td>
						<?php
						$position = strpos($page->content,". ",130);
						if((int)$position > 0 && (int)$position < 200):
							echo substr($page->content, 0 , $position);
						else:
							echo substr($page->content, 0 , 130);
						endif;
						 ?>
						</td>
                        <td><?php echo $page->metadescription; ?></td>
                        <td><?php echo $page->created; ?></td>
                        <td class="text-right"><div class="btn-group">
							<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=page&task=addnew&page_id=<?php echo $page->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                            <span class="btn btn-xs btn-default-alt">
							<i class="<?php echo ((int)$page->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>"></i>
							</span>
							<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=page&task=RemovePage&page_id=<?php echo $page->id; ?>"><i class="fa fa-fw fa-times"></i></a>
							</span>
                          </div></td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() -->
                      <?php  endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr class="active">
                        <td colspan="4" class="text-left" style="background: none;">
						<div class="clearfix">
                          <div class="pull-right">
							  <?php echo $this->Pagination; ?>
                              </div>
						  </div>
						  </td>
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
	  <input type="hidden" name="view" value="page" />
	  </form>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>