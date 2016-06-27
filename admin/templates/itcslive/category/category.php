<?php  error_reporting(0); 
 $post=IRequest::get("POST");   ?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Category</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=category&task=addnew&category=<?php echo (int)$post["category"]; ?>">New Category</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
	  <form method="post" name="CategoryFrm" id="CategoryFrm">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Category Manager</h4>					
                <div class="options" align="center">				
				 Type :
				  	<select name="category" onchange="document.CategoryFrm.submit();">
						<option>Select Type</option>						
						<?php foreach($this->category as $category): 
									$select = ((int)$post["category"] == (int)$category->id) ? 'selected="selected"' : ''; ?>
						<option value="<?php echo $category->id; ?>" <?php echo $select; ?> > <?php  echo $category->type."_category"; ?> </option>							
						 
						<?php  endforeach; ?>
					</select> 					
					</div>
					<div class="options" align="right"> 
					<input class="form-control" type="text" name="type" value="<?php echo $post["type"]; ?>" placeholder="Search here" />			<input type="submit" value="Go" onclick="document.CategoryFrm.submit()" />					
					</div>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">                 
					<div id="categoryResult">
				  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
						<th>Category Type</th>
						<th>Category Name</th>
						<th>Created On</th>
						<th>Action</th>
                      </tr>
                    </thead>
					
                    <tbody class="selects">					   
                      <!-- ngRepeat: ua in accountsInRange() -->
					  <?php  foreach($this->categoryID as $ID):  ?>
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()"> 
					  <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $ID->id; ?>]"  /></td>
						<td><a href="index.php?view=category&task=addnew&category_id=<?php echo $ID->id; ?>">
									<?php echo $ID->type; ?></a></td>
						<td><?php echo $ID->category_name?></td>  
						<td><?php echo $ID->created_on; ?></td>
						<td><div class="btn-group">
						<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=category&task=addnew&category_id=<?php echo $ID->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                            <button class="btn btn-xs btn-default-alt" ng-click="uaHandle($index)">
							<i class="<?php echo ((int)$ID->status==1) ? 'fa fa-fw fa-check': 'fa fa-fw fa-times'; ?>"></i>
							</button>
							<span class="btn btn-xs btn-default-alt">
							<a title="Delete" href="index.php?view=category&task=RemoveCategory&category_id=<?php echo $ID->id; ?>"><i class="fa fa-fw fa-times"></i></a>
							</span>
                          </div></td>               
                      </tr>
					  <?php  endforeach;  ?>
                      <!-- end ngRepeat: ua in accountsInRange() -->                     
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
        </div>
		<input type="hidden" name="view" value="category" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>