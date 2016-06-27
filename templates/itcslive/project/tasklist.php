<?php $accessForUser=array("customer","telecaller","Admin"); ?>

<div class="article-body">

<?php if($taskList[0]->project_name != ""): ?><h5 class="title_1"> <?php echo $taskList[0]->project_name;  ?> </h5> <?php endif;?>  

   <div class="padDiv row6 marginright" id="tasklist">

   <!-----------------------------------------On Going Task---------------------------------------------------->

      <div class="boiteHeader">

         

         <h5 class="bulet1">Tasks</h5>

		 

		 <ol>		

		  <?php if(in_array($my->usertype,$accessForUser)): ?>

            <li> <a title="Add Task" onclick='jQuery.colorbox({href: "<?php echo $Config->site."addtask?project_id=".$project_id; ?>", iframe:true, width:"60%", height:"75%", scrolling:false, open:true, overlayClose:true, title:"Add Task"});' href="javascript:void(0);" class="icon"> <span class="fa add"></span> Add Task </a></li>

			<?php endif; ?>

         </ol>

		 		 	

      </div>

	 

     <?php if((int)$project_id > 0): ?>

	 <div class="assign"> 

	 <ul>

	 	<?php if((int)$taskList[0]->id > 0): ?>

	 	<li class="nofloat">

			Deadline : <?php echo (strtotime($taskList[0]->deadline) > 0) ? date("d-m-Y", strtotime($taskList[0]->deadline)): "00-00-0000"; ?>

	<?php if((strtolower($my->usertype)=='admin' || strtolower($my->usertype)=='telecaller') && $taskList[0]->project_status==0): ?>

			<a href="<?php echo $Config->site.'editDeadline?project_id='.$project_id; ?>" class="editDeadline assign_1"><i class="fa fa-pencil"></i></a>

	<?php endif; ?>

		</li>

		<?php endif; ?>

<?php if((strtolower($my->usertype)=='admin' || strtolower($my->usertype)=='telecaller') && $taskList[0]->project_status==0): ?> 

	 	<li>

	 		<i class="fa fa-arrows_1"></i> 

			<a href="<?php echo $Config->site.'completeproject?project_id='.$project_id; ?>" class="completeproject assign_1">Complete Project</a>&nbsp;

		</li>

		<li>

	 		<i class="fa fa-arrows_1"></i> 

			<a href="<?php echo $Config->site.'assignproject?project_id='.$project_id; ?>" class="assignproject assign_1">Assign Project</a>&nbsp;

		</li>

		<?php endif; ?>

	</ul>

	</div><?php endif; ?>

	  

	  <br clear="all" />

      <div class="boiteContent">

	  <h3 class="task_ongoing"><b>On Going Tasks</b></h3>

	  

         <div class="defaultBoxLine"> 

            <ul class="no_margin">

			<?php if(count($OngoingTaskList) > 0): ?>

               <?php foreach($OngoingTaskList as $task): ?>

               <li><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i>

			   <span><a href="#project/<?php echo $task->project_id; ?>/task/<?php  echo $task->id;  ?>" class="tip" tooltip="Last Modified By: <?php echo $task->modifier_name; ?>  

Last Modified : <?php echo $task->updated_before; ?> ago 

<?php if($task->task_completion!="0000-00-00 00:00:00"):?>Complete On : <?php echo date("d-m-Y h:i A", strtotime($task->task_completion)); ?>(<?php echo isset($task->over_do) ? 'Task overdue: '.$task->over_do.' ' : 'On Time'; ?>)<?php else: ?>Completion date and time not given<?php endif; ?>" ><?php echo $task->task_name; ?><?php echo isset($task->over_do) ? '<small>(<span style="color:#8e0000;">Task over due: '.$task->over_do.'</span>)<small>' : ''; ?>

			   

			   <div class="tooltip_view" style="display:none;">

               <span><small>Last Modified By: <?php echo $task->modifier_name; ?></small></span><br />

               <span><small>Last Modified : <?php echo $task->updated_before; ?> ago </small></span><br />

               <?php if($task->task_completion!="0000-00-00 00:00:00"):?>

               <span><small>Complete On : <?php echo date("d-m-Y h:i A", strtotime($task->task_completion)); ?>

               (<?php echo isset($task->over_do) ? '<span style="color:#8e0000;">Task overdue: '.$task->over_do.'</span>' : 'On Time'; ?>)

               </small>

               </span>

               <?php else: ?>

               <span><small>Completion date and time not given</small></span>

               <?php endif; ?>

               </div>

			   

			   </a></span><br />



			   <div id="tooltip" style="display:none;">

               <span><small>Last Modified By: <?php echo $task->modifier_name; ?></small></span><br />

               <span><small>Last Modified : <?php echo $task->updated_before; ?> ago </small></span><br />

               <?php if($task->task_completion!="0000-00-00 00:00:00"):?>

               <span><small>Complete On : <?php echo date("d-m-Y h:i A", strtotime($task->task_completion)); ?>

               (<?php echo isset($task->over_do) ? '<span class="task_over">Task overdue: '.$task->over_do.'</span>' : 'On Time'; ?>)

               </small>

               </span>

               <?php else: ?>

               <span><small>Completion date and time not given</small></span> 

               <?php endif; ?>

               </div>

			   </li>

               <input type="hidden" name="task_id" id="task_id" value="<?php  echo $task->id;  ?>" />

               <?php endforeach; ?>

			   <?php else: ?>

			   <li>No Ongoing Task Found</li>

			   <?php endif; ?>

            </ul>

         </div>

         <div class="clear"></div>

      </div>

  

   <!-----------------------------------------On Going Task End---------------------------------------------------->

   <!-----------------------------------------Completed Task---------------------------------------------------->

  		

      <div class="boiteContent">

	  <h3 class="task_ongoing"><b>Completed Tasks</b><a style="text-align:right;" href="javascript:void(0);" onclick="jQuery('#all_completed_task').toggle('slow');"><i class="fa fa-arrow-circle-o-down"></i></a></h3>

         <div class="defaultBoxLine">

            <ul class="no_margin" id="all_completed_task" style="display:none;">

			<?php if(count($CompletedTaskList) > 0): ?>

               <?php foreach($CompletedTaskList as $task): ?>

                <li> <span><a href="#project/<?php echo $task->project_id; ?>/task/<?php  echo $task->id;  ?>"><?php echo $task->task_name; ?></a></span><br />

			   <span><small>Last Modified By: <?php echo $task->modifier_name; ?></small></span><br />

			   <span><small>Last Modified : <?php echo $task->updated_before; ?> ago </small></span><br />

			   </li>

               <input type="hidden" name="task_id" id="task_id" value="<?php  echo $task->id;  ?>" />

               <?php endforeach; ?>

			   <?php else: ?>

			   No Completed Task Found

			   <?php endif; ?>

            </ul>

         </div>

         <div class="clear"></div>

      </div>

	  <!-----------------------------------------Completed Task End---------------------------------------------------->

   </div>

   <div id="taskcontent"> </div>

   <div class="clear"></div>

  </div>

<script>

jQuery(document).ready(function()

{

	jQuery(".assignproject").colorbox({iframe:true, width:"60%", height:"80%",title:"Assign Project",scrolling:false});

	jQuery(".completeproject").colorbox({iframe:true, width:"40%", height:"40%",title:"Complete Project",scrolling:false}); 

	jQuery(".editDeadline").colorbox({iframe:true, width:"40%", height:"40%",title:"Edit Deadline",scrolling:false}); 

});

</script>