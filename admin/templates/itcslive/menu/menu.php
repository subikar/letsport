<?php
error_reporting(0); 
$post=IRequest::get("POST"); 
?>  
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Menu Manager</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=menu&task=addnew&parent=<?php echo (int)$post["parent"]; ?>">Add Menu</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <form method="post" name="MenuForm" id="MenuForm">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Menu Items</h4>
				<div class="options" align="center">
				Menu: 
				  <select name="parent" onchange="document.MenuForm.submit();">
				  <option value="0">All</option>
				  <?php foreach($this->ParentMenus as $pmenu): $select=((int)$post["parent"] == (int)$pmenu->id) ? 'selected="selected"' : '';  ?>
				  	<option value="<?php echo $pmenu->id ?>" <?php echo $select; ?> ><?php echo $pmenu->title; ?></option>
				  <?php endforeach; ?>
				  </select>
				   </div>
                <div class="options" align="right"> 
				  <input class="form-control" type="text" name="title_text" value="<?php echo $post["title_text"]; ?>" placeholder="Search here" />
				  <input type="button" name="go" value="GO" onclick="document.MenuForm.submit();" />
				   </div> 
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class=""></th>
                        <th class="">Menu Title</th>
                        <th class="">Ordering</th>
                        <th class="">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php foreach($this->menus as $menu):?>   
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td></td>
                        <td class="ng-binding"><a href="index.php?view=menu&task=addnew&menu_id=<?php echo $menu->id; ?>"><?php echo $menu->title; ?></a></td>
                        <td class="ng-binding"><?php echo $menu->ordering; ?></td>
                        <td class="text-right">
							<div class="btn-group">
							<span class="btn btn-xs btn-default-alt">
							<a href="index.php?view=menu&task=addnew&menu_id=<?php echo $menu->id; ?>"><i class="fa fa-fw fa-pencil"></i></a></span>
                            <span class="btn btn-xs btn-default-alt"><i class="fa fa-fw fa-check"></i></span> 
                            <span class="btn btn-xs btn-default-alt">
							<a title="Delete" href="index.php?view=menu&task=RemoveMenu&menu_id=<?php echo $menu->id; ?>"><i class="fa fa-fw fa-times"></i></a>
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
		<input type="hidden" name="view" value="menu" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->

  <div class="clear"></div>