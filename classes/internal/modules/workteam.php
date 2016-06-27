<?php 
  class Workteam{
        function __construct()
		  {
		      $this->getWorkteam();
		  }
		  function getWorkteam()
		  {
		  	global $template,$db;
			$Query="SELECT name,avatar,thumb,designation FROM #__users WHERE (usertype='employee' OR usertype='telecaller' OR usertype='fieldexecutive' ) AND status=1 AND uid NOT IN(158)";
		  	$db->setQuery($Query);
			  $usersInArray = $db->loadObjectList();
			  foreach($usersInArray as $user):
			  if($user->avatar=="" || $user->avatar==NULL)
			  { 
				  $user->avatar="templates/itcslive/images/portfolio/customer_review.png"; 
			  }
			  else
			  {
			  	 $user->avatar=$user->thumb;
			  }
			  endforeach;
			  $template->assignRef('usersInArray',$usersInArray);
			 $template->display('modules/workteam/index',0);
		  }
  }
?>
