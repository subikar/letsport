<div class="article-body">
   <div class="padDiv row10">
      <div class="boiteHeader">
         <h5><i class="fa fa-archive"></i>Archived Company and Projects</h5>
         <div class="line"></div>
      </div>
      <?php foreach($companyList as $Company): ?>
      <div class="boiteContent">
         <div class="company_title"><strong><?php echo $Company->company_name; ?></strong>
		 <span><a onclick="Project.removeFromArchive('company','<?php echo $Company->id; ?>');" href="javascript:void(0);"><i class="fa fa-check-square-o"></i></a></span></div>
         <div class="defaultBoxLine">
            <ul>
               <?php foreach($Company->projectList as $project): ?>
               <li>
			   <span><?php echo $project->project_name; ?></span><span><a onclick="Project.removeFromArchive('project','<?php echo $project->id; ?>');" href="javascript:void(0);"><i class="fa fa-check-square-o"></i></a></span><br />
			   <span>Create Date: <?php echo date("j F Y h:i A",strtotime($project->create_date)); ?></span>
			   </li>
               <?php endforeach; ?>
            </ul>
         </div>
      </div>
      <div class="clear"></div>
      <?php endforeach; ?>
   </div>
   <div class="clear"></div>
</div>
</div>
</div>
