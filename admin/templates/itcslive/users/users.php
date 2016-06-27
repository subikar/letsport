  <?php $post=IRequest::get("POST"); ?>
  <div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <!-- ngView:  -->
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <!-- <ol class="breadcrumb">
                <li class='active'><a href="index.htm">Dashboard</a></li>
            </ol> -->
        <h1>Users</h1>
        <div class="options">
          <div class="btn-toolbar">
            <div class="btn-sm btn-default btn-top" dropdown="">
               <a href="index.php?view=users&task=addnew">New User</a>
            </div>
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-3 col-sm-6"> <a class="info-tiles tiles-danger" href="#">
                <div class="tiles-heading">
                  <div class="pull-left">Active Users</div>
                  <div class="pull-right">1000</div>
                </div>
                <div class="tiles-body">
                  <div class="pull-left"><i class="fa fa-download"></i></div>
                  <div class="pull-right">1000</div>
                </div>
                </a> </div>
              <div class="col-md-3 col-sm-6"> <a class="info-tiles tiles-indigo" href="#">
                <div class="tiles-heading">
                  <div class="pull-left">Inactive users</div>
                  <div class="pull-right">10%</div>
                </div>
                <div class="tiles-body">
                  <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                  <div class="pull-right">679</div>
                </div>
                </a> </div>
              <div class="col-md-3 col-sm-6"> <a class="info-tiles tiles-success" href="#">
                <div class="tiles-heading">
                  <div class="pull-left">Send Mail</div>
                  <div class="pull-right">+40%</div>
                </div>
                <div class="tiles-body">
                  <div class="pull-left"><i class="fa fa-money"></i></div>
                  <div class="pull-right">800</div>
                </div>
                </a> </div>
              <div class="col-md-3 col-sm-6"> <a class="info-tiles tiles-midnightblue" href="#">
                <div class="tiles-heading">
                  <div class="pull-left">All</div>
                  <div class="pull-right">100%</div>
                </div>
                <div class="tiles-body">
                  <div class="pull-left"><i class="fa fa-group"></i></div>
                  <div class="pull-right">1679</div>
                </div>
                </a> </div>
            </div>
          </div>
        </div>
        <div class="row">
          <form name="UserForm" id="UserForm" method="post"> 
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>User Accounts</h4>
                <div class="options">
				  <input class="form-control" type="text" name="text_title" value="<?php echo $post["text_title"]; ?>" placeholder="Search here" />
				  </div>
				  <h4>
				<input type="button" name="Delete" value="delete" onclick="User.multipleDelete('UserForm')" />
				</h4>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
                        <th class="col-xs-9 col-sm-4">User ID</th>
						  <th class="col-sm-5 hidden-xs">Name</th>
                        <th class="col-sm-5 hidden-xs">Email Address</th>
                        <th class="col-sm-5 hidden-xs">User Type</th>
                        <th class="col-sm-5 hidden-xs">Last Login</th>
                        <th class="col-sm-5 hidden-xs">Register on</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects">
					   <?php foreach($this->users as $user):?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $user->uid; ?>]" value="<?php echo $user->uid; ?>" /></td>
                         <td class="ng-binding"><?php echo $user->uid; ?></td>
						<td class="ng-binding"><?php echo $user->name; ?></td>
                        <td class="ng-binding"><?php echo $user->email; ?></td>
                        <td class="hidden-xs ng-binding"><?php echo $user->usertype; ?></td>
                        <td class="ng-binding"><?php echo $user->last_login; ?></td>
                        <td class="ng-binding"><?php echo $user->register_date; ?></td>
                        <td class="text-right">
						<div class="btn-group">
							 <a class="btn btn-xs btn-default-alt" href="index.php?view=users&task=addnew&uid=<?php echo $user->uid; ?>"><i class="fa fa-fw fa-pencil"></i></a>
							<a class="btn btn-xs btn-default-alt" href="javascript:void(0);" onclick="User.Remove(<?php echo (int)$user->uid ?>)" title="Delete">
							<i class="fa fa-fw fa-times"></i></a>
                         </div>
						</td>
                      </tr>
                      <!-- end ngRepeat: ua in accountsInRange() -->
                      <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr class="active">
                        <td colspan="4" class="text-left" style="background: none;"><div class="clearfix">
                            <button class="btn btn-sm btn-default pull-left" ng-click="uaHandleSelected()">Aprrove Selected</button>
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
		  <input type="hidden" name="view" value="users" />
		  </form>
        </div>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->

  <div class="clear"></div>