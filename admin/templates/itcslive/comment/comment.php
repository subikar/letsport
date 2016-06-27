<?php  error_reporting(0); 
 $post=IRequest::get("POST"); ?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Comments</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <!--<a href="index.php?view=comment&task=addnew">New Comment</a>-->
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
       <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Comment Manager</h4>
				<form name="CommentFrm" id="CommentFrm" method="post">
                <div class="options" align="left">
					<input class="form-control" type="text" name="search_cmnt" value="<?php echo $post["search_cmnt"]; ?>" placeholder="Search here" />			
					<input type="submit" value="Go" onclick="document.CommentFrm.submit()" />	
				</div>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
                        <th>Comment ID</th>
                        <th>Name </th>
                        <th>Comments</th>
						<th>Type</th>
                        <th>Created On</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php  foreach($this->comment as $comment): ?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $comment->id; ?>]"  /></td>
                         <td><?php echo $comment->id; ?></td>
						<td><a href="index.php?view=comment&task=addnew&comment_id=<?php echo (int)$comment->id; ?>"><?php echo $comment->name; ?></a></td>
                        <td>
						<?php
						$position = strpos($comment->comment,". ",130);
						if((int)$position > 0 && (int)$position < 200):
							echo substr($comment->comment, 0 , $position);
						else:
							echo substr($comment->comment, 0 , 130);
						endif;
						 ?>
						</td>
                        <td><?php echo $comment->type; ?></td>
                       <td><?php echo $comment->created; ?></td>
                        <td class="text-right"><div class="btn-group">
						<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=comment&task=addnew&comment_id=<?php echo (int)$comment->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                            <button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$comment->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>">
							</i></button>
							<span class="btn btn-xs btn-default-alt">
							<a title="Delete" href="index.php?view=comment&task=RemoveComment&comment_id=<?php     echo (int)$comment->id; ?>"><i class="fa fa-fw fa-times"></i></a>
							</span>
                          </div></td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() -->
                      <?php  endforeach; ?> 
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
		<input type="hidden" name="view" value="comment" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>