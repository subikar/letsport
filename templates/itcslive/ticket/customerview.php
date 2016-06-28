<div role="main" id="projects">
      <div class="article-body" id="company_details" >
         <div class="padDiv row10">
            <div class="boiteHeader">
			 <ol>
                  <li> <a onclick='jQuery.colorbox({href: "<?php echo $Config->site."addtask"; ?>", iframe:true, width:"620px", height:"600px", scrolling:false, open:true, overlayClose:true});' href="javascript:void(0);" class="icon"> <span class="fa add"></span> Add </a></li>
               </ol>
				<h5><span class="fa fa-tasks"></span><a href="#" class="titleLink">Tasks</a></h5>
            </div>
            <div class="line"></div>
            <div class="boiteContent">
               <div class="defaultBoxLine">
			   <?php foreach($this->taskList as $task): ?>
			   		<div><?php echo $task->task_name; ?></div>
					<div><?php echo $task->project_name; ?></div>
					<div><?php echo date("j F Y h:i A",strtotime($task->create_date)); ?></div>
			   <?php endforeach; ?>
               </div>
               <div class="clear"></div>
            </div>
         </div>
		 <div class="clear"></div>
      </div>
   </div>