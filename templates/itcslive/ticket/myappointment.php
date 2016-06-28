<?php
	defined ('ITCS') or die ("Go away.");
	global $my,$Config;
	$post=IRequest::get("POST");
?>

<div id="primary">
   <div role="main" id="contactus">
      <div class="article-body">
	  <div class="box_area">
	  	<div class="myappointment">
			<form name="aSearchForm" action="" method="post">
				<div class="each_box_area">
				<input type="text" name="text_customer" id="text_user" placeholder="Search By Customer.." value="<?php echo $post['text_customer']; ?>" />		
               </div>
			   <?php if(strtolower($my->usertype) == "telecaller" || strtolower($my->usertype) == "admin"): ?>
               <div class="each_box_area">
				<input type="text" style="width:100%" name="text_executive" id="field_executive" placeholder="Search By Executive.." value="<?php echo $post['text_executive_input']; ?>" />		
               </div>
			   <?php endif; ?>
               <div class="each_box_area">
                  <input placeholder="Search By Date.." name="text_date" id="text_date" type="text" value="<?php echo $post["text_date"] ?>">
               </div>
			   <div class="login_btns">
               <input value="Search" class="login" style="line-height:0;" id="search_adbuttn" type="submit">
			   </div>
               <div class="clear"></div>
			</form> 
			</div>  
            </div>
            <div class="line"></div>
         <div class="padDiv row10">
            <div class="boiteHeader">
               <ol>
                  <li>
                     <a href='<?php echo $Config->site."mytickets"; ?>' class="addticket" title="Add Ticket"><span class="fa add"></span>My Tickets</a>
                  </li>
               </ol>
               <h5><span class="fa fa-tasks"></span><a href="#" class="titleLink">Appiontments</a> &nbsp;&nbsp;(<?php echo count($this->Appointments); ?>)</h5>
            </div>
            <div class="line"></div>
            <div class="boiteContent">
               <?php if(count($this->Appointments) > 0): ?>
			   <div class="defaultBoxLine">
			   <div style="width:25%;">Customer Name</div>
			   <div style="width:22%;">Appointment Time</div>
			   <div style="width:22%;">Phone No</div>
			   <div style="width:25%;">Address</div>
			   </div>
			   <div class="clear"></div>
               <?php foreach($this->Appointments as $Appo): ?>
               <div class="defaultBoxLine">
				  <div style="width:25%;"><?php echo $Appo->name; ?><br /><?php echo ($Appo->Company!="")? "<br><small>(".$Appo->Company.")</small>": ""; ?></div>
				  <div style="width:22%;"><?php echo date("d-m-Y h:i A",strtotime($Appo->visit_date)); ?></div>
				  <div style="width:22%;"><?php echo $Appo->phone; ?></div>
				  <div style="width:25%;"><?php echo $Appo->address; ?></div>
			   </div>
               <div class="clear"></div>
               <?php endforeach; ?>
               <?php else: ?>
               <p>Sorry!! You Have No Appointments.</p>
               <?php endif; ?>
            </div>
         </div>
         <div class="clear"></div>
      </div>
   </div>
</div>