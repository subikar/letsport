<?php 
error_reporting(0); 
  class Ticket extends Master 
  {
		function __construct()
	   	{		        
			parent::__construct();			  
	   	}
		function display()
	   	{
			global $template; 
			$template->includejs('templates/itcslive/js/ticket.js');
			$this->getTickets();
			$template->display('header');
			$template->display('ticket/ticket');
			$template->display('footer');
	  	 } 
		
		function getTickets()
		{
			global $db, $template, $Config;
			$start = IRequest::getInt('start',0);
			$Limit = ($Config->limit)?$Config->limit:20;
						
			$Query = "select count(*) from #__ticket "; 
			$db->setQuery($Query);
			$TestCount = $db->getOne();
			$template->SetPagination($TestCount);
			 
			$Query = "select *  from #__ticket order by id desc";
			$db->setQuery($Query,$start,$Limit);
			$Tickets = $db->loadObjectList();
			$template->assignRef('tickets',$Tickets);
		}
		
		function RemoveTicket()
		{
			global  $db,$mainframe;
			$ticket_id = IRequest::getVar('ticket_id');
			
			$SQL = "UPDATE #__formdata SET ticket_id=0 WHERE ticket_id=".$db->quote($ticket_id);
			$db->setQuery($SQL);
			
			$SQL = "SELECT owner_id from #__ticket WHERE id=".$db->quote($ticket_id);
			$db->setQuery($SQL);
			$owner_id = $db->getOne();
			if((int)$owner_id > 0)
			{
				$sql= "DELETE FROM #__user_telecaller_relation WHERE customer_id=".$db->quote($owner_id);
				$db->setQuery($sql);
			}
			
			$SQL = "DELETE from #__ticket WHERE id=".$db->quote($ticket_id);
			$db->setQuery($SQL);
			
			if((int)$ticket_id > 0)
			{
				$SQL1 = "DELETE from #__404 WHERE type='ticket' AND type_id=".$db->quote($ticket_id);
				$db->setQuery($SQL1);
			}			
		}
		function RemoveMultiple()
		{
			global  $db,$mainframe;
				$post=IRequest::get("POST");
				$idInArray=array_values($post["to_select"]);
				$ids=implode(",", $idInArray);
				
			$SQL = "UPDATE #__formdata SET ticket_id=0 WHERE ticket_id IN(".$ids.")";
			$db->setQuery($SQL);
			
			foreach($idInArray as $ticket_id):
				$SQL = "SELECT owner_id from #__ticket WHERE id=".$db->quote($ticket_id);
				$db->setQuery($SQL);
				$owner_id = $db->getOne();
				if((int)$owner_id > 0)
				{
					$sql= "DELETE FROM #__user_telecaller_relation WHERE customer_id=".$db->quote($owner_id);
					$db->setQuery($sql);
				}
				$SQL1 = "DELETE from #__404 WHERE type='ticket' AND type_id=".$db->quote($ticket_id);
				$db->setQuery($SQL1);
			endforeach;
			
			$SQL = "DELETE from #__ticket WHERE id IN(".$ids.")";
			$db->setQuery($SQL);
			$mainframe->redirect('index.php?view=ticket');			
		}
   }
?>