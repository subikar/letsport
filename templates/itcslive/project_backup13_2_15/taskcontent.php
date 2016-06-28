<?php
error_reporting(0);
	global $my,$Config,$template;
	$linkID = $task_id;
	if((int)$mainTask->task_completion != 0)
	{
		$completionDate = $mainTask->task_completion;
	}
	else
	{
		$completionDate = $post['text_date'];
	}
	$post = IRequest::get('post');
?>
<div class="padDiv row5 box_1">
	<div class="boiteHeader">
		<h5 class="bulet1"><span id="taskname"><?php echo $mainTask->task_name; ?></span></h5>
		<ol>
			<li>
				<span class="fa assign_2" style="float:left; "></span>
				<a href="<?php echo $Config->site."assigntask?task_id=".$mainTask->id; ?>" class="assigntask">Assign Task</a>
			</li>
		</ol>
    </div>
    <div class="line"></div>
    	<div class="defaultBoxLine3">	
		<?php  if($mainTask->status == 0):
	    if(strtolower($my->usertype) == 'customer' || strtolower($my->usertype) == 'admin' || strtolower($my->usertype) == 'telecaller'): ?>
		<div class="completetaskdiv small_div"><i class="fa fa-smile-o_1 calfont"></i><a href="<?php echo $Config->site.'completetask?task_id='.$task_id;  ?>" class="completetask anchor_height">Complete Task</a></div>
		<?php endif; else: ?>
			<div class="completetaskdiv"><i class="fa fa-calendar-o_1 calfont"></i> </strong> <?php  echo date('M d h:i A',strtotime($completionDate));  ?></div>
		<?php endif; ?>
		<div class="completetaskdiv small_div text-righ"><i class="fa fa-calendar-o_1 calfont"></i> <a href="javascript:void(0);" class="tip" tooltip="File Created on: <?php  echo date('M d h:i A',strtotime($mainTask->create_date));  ?>"><?php  echo date('M d h:i A',strtotime($mainTask->create_date));  ?></a></div>

		<div class="completetaskdiv small_div2"><bar><i class="fa fa-smile-o_2"></i></bar>
		<div class="styled">
		<select name="users" id="users_assigned" style="color:#fff;">
			<?php  foreach($users as $user): 
				$userSelect = ((int)$user->uid == $post['users'] && (int)$user->is_owner == 1) ? "selected='selected'" : ''; ?>
			<option value="<?php echo $user->uid; ?>" <?php echo $userSelect; ?>><?php echo $user->name; ?></option>
			<?php endforeach; ?>
		</select></div></div>
		<div class="completetaskdiv small_div1" style="padding-right:0;"><bar><i class="fa fa-calendar-o_1 calfont"></i></bar> 
     	<?php if(strtolower($my->usertype)=="employee"):
			   if((int)$employeeWorking == 0):	?>
		<input placeholder="Completion Date" name="text_datetime" id="text_datetime"   /><!--onblur="Project.completiondate();"-->
		<div style="background:#4eb6f3; float:right;">
		<a href="javascript:void(0);" onclick="Project.completiondate();"><i class="fa fa-save"></i></a>
		</div>
		<?php else:  echo date('M d h:i A',strtotime($completionDate)); endif;
			else: 
				if($completionDate != '') 
					echo date('M d h:i A',strtotime($completionDate)); 
				else echo "No Completion Date &nbsp;"; ?>
		<?php endif; ?>	
			
		</div>
		
		<div class="clear"></div>
		<div class="js-description object-description"><a href="javascript:void(0);" onclick="jQuery('#taskdescription_area').toggle('slow');" class="subaction-link">
		<i class="fa fa-arrow-circle-o-down"></i>
		show/hide Description</a>
		<div class="object-description-data" id="taskdescription_area" style="display:none;">
		<?php if($mainTask->task_description != ''): ?> 
		<?php echo preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $mainTask->task_description); 
			if(strtolower($my->usertype) == 'admin' || strtolower($my->usertype) == 'telecaller'): ?>
		<a class="js-toggle-description subaction-link" href="<?php echo $Config->site.'addtaskdescription?task_id='.$task_id; ?>" id="taskdescription">
			<i class="icon-pencil"></i>Edit task description</a>
		<?php  endif;	else: ?>
		<a class="js-toggle-description subaction-link" href="<?php echo $Config->site.'addtaskdescription?task_id='.$task_id; ?>" id="taskdescription">
			<i class="icon-pencil"></i>Add task description</a>
		<?php endif; ?>
		</div>
		</div>
			 <div id="error_com" style="display:none;"></div> 
			 <div class="comment">
			 	<div class="comment_box">
			<form name="taskComment" id="taskComment" method="post" onsubmit="Project.taskComment(this);">
			     <textarea name="comment" id="editor"></textarea>
				 <ul id="allAttechFile" class="attach_file"></ul>
				 
				  <?php if(strtolower($my->usertype)!="customer"): ?>
				<span><input type="checkbox" name="internal_comment" id="internal_comment" value="1">Comment For Internal Team.</span> 
				<?php endif; ?>
			   <?php if(strtolower($my->usertype)=="employee"): ?>
			   <span class="task"><input type="text" name="task_hour" id="task_hour" placeholder="Task Hour"/></span> 
				 <?php endif; ?>				 
				 <div id="attachfile"><i class="fa fa-fw fa-paperclip_1"></i>
					<a href="<?php echo $Config->site.'attach?linkId=task_'.$linkID; ?>" class="attachment">Attach files</a></div>
                  <input type="hidden" name="view" value="project" />
                  <input type="hidden" name="task" value="saveComment" />
                  <input type="hidden" id="content_task_id" name="task_id" value="<?php echo $task_id; ?>" />
                  <input type="hidden" id="user_id" name="user_id" value="<?php echo (int)$my->uid; ?>" />
				 <div class="clear"></div>
			</form>			
			<div class="login_btns">
			<input class="comment_btn" type="button" id="submitComment" value="COMMENT" onclick="Project.taskComment('taskComment');" /></div>
			</div>
			<div class="clear"></div>
			 </div>
			<ul id="contentbox" class="comment_list">
				<?php  if(count($taskContent) > 0):  ?>
				<?php foreach($taskContent as $Task): ?>
				<div id="comment_box_<?php echo $Task->id; ?>">
					<div class="defaultBoxLine5" style="width:96%;">
					<div class="tb-comment-list">
					<div class="tb-comment-header">
					<div class="user_avatar">			
					<span class="tb-avatars-initials undefined"><i class="icon icon-avater"></i></span>
					</div>
					<div class="tb-comment-info tb-comment-info--online">
					<a class="js-mention-link tb-comment-author"> <?php echo $Task->name; ?></a>
					</div><span class="internal_team" title="Internal Comment"><?php echo ((int)$Task->internal_comment==1) ? '<i class="fa fa-star"></i>': ''; ?></span>
					<?php if(strtolower($my->usertype)=="admin"): ?>
					<div style="float:right; color:#000;">
					<a onclick="Project.RemoveTaskComment('<?php echo $Task->id; ?>');" href="javascript:void(0);"><i class="fa fa-trash-o_1 fa-right"></i></a>
					</div>
					<?php endif; ?>
					</div>	
					<div>
					<span class="tb-comment-meta-info">
					<?php  echo date('j F Y h:i A',strtotime($Task->create_date));  ?> 
					</span>
					
					<span style="float:right; color:#acadad; font-size:11px">
					<?php if((int)$Task->task_hour > 0): ?>
					Task Hour: <?php echo $Task->task_hour;  endif; ?>
					</span>
					</div>
					
					<div class="tb-comment-text">
					<p><?php echo nl2br($Task->task_content); ?></p>
					</div>
					
					</div>
					</div>
					<div class="line"></div>
					<div class="clear"></div>
				</div>
				 <?php endforeach; ?>
				<?php  else: ?>
					<p id="noTaskContent">No Message</p>
				<?php endif; ?>
			</ul>  
        </div>
        <div class="clear"></div>
</div>	
<script>
	jQuery(document).ready(function()
	{
		//jQuery("#text_datetime").kendoDateTimePicker({value:new Date(),format: "MMM d hh:mm tt"});
		jQuery("#text_datetime").kendoDateTimePicker({value:new Date(),format: "yyyy-MM-dd HH:mm"});
		jQuery(".attachment").colorbox({iframe:true, width:"40%", height:"60%",title:"Attach File"});
		jQuery(".completetask").colorbox({iframe:true, width:"60%", height:"95%",title:"Complete Task", scrolling:false});
		jQuery("#taskdescription").colorbox({iframe:true, width:"60%", height:"70%",title:"Add Task Description"});	
		jQuery("#users_assigned").kendoComboBox(); 
		jQuery(".assigntask").colorbox({iframe:true, width:"60%", height:"80%",title:"Assign Task",scrolling:false}); 
	});
</script>