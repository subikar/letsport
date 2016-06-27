<?php error_reporting(0);  
$post=IRequest::get("POST"); 
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope" fit-height="">
    <div style="" id="wrap" ng-view="" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
        <h1>Companies</h1>
        <div class="options">
          <div class="btn-toolbar">
            
        </div>
      </div>
      <div class="container ng-scope" ng-controller="DashboardController">
	  <form name="CompanyForm" id="CompanyForm" method="post" >
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-gray">
              <div class="panel-heading">
                <h4>Company Manager</h4>
                <div class="options"> 
				  <input class="form-control" type="text" name="title_text" value="<?php echo $post["title_text"]; ?>" placeholder="Search here" /> 
				  <input type="button" name="Go" value="Go" onclick="document.CompanyForm.submit();" />
				  </div>
				  <h4>
				<input type="button" name="Delete" value="delete" onclick="Company.multipleDelete('CompanyForm')" />
				</h4>
              </div>
              <div class="panel-body no-padding">
                <div class="table-responsive">
                  <table class="table" style="margin-bottom: 0px;">
                    <thead>
                      <tr>
                        <th class="col-xs-1 col-sm-1"><input type="checkbox" class="chk_boxes" label="check all"  /></th>
                        <th class="col-xs-1 col-sm-1">Company ID</th>
                        <th class="col-xs-9 col-sm-4">Company Name</th>
                        <th class="col-sm-5 hidden-xs">Owner Name</th>
						<th class="col-sm-5 hidden-xs">Creator Name</th>
                        <th class="col-sm-5 hidden-xs">Created on</th>
						<th class="col-sm-5 hidden-xs">status</th>
                        <th class="col-xs-2 col-sm-2 text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="selects" style="font-size:13px;">
					   <?php  foreach($this->Companies as $company): ?>   
                      <!-- ngRepeat: ua in accountsInRange() -->
                      <tr class="ng-scope" ng-repeat="ua in accountsInRange()">
                        <td><input type="checkbox" class="chk_boxes1" name="to_select[<?php echo $company->id; ?>]" value="<?php echo $company->id; ?>"  /></td>
                         <td><?php echo $company->id; ?></td>
						<td><?php echo $company->company_name; ?></td>
                        <td><?php echo $company->owner; ?></td>
						<td><?php echo $company->creator; ?></td>
                        <td><?php echo $company->create_date; ?></td>
						<td><?php echo ($company->archive == 1)? 'Archived' : 'Live' ; ?></td>
                        <td class="text-right"><div class="btn-group">
							<span class="btn btn-xs btn-default-alt">
							<a href="javascript:void(0);" title="Delete" onclick="Company.Remove(<?php echo $company->id; ?>);" /><i class="fa fa-fw fa-times"></i></a>
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
	  <input type="hidden" name="view" value="company" />
	  </form>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>