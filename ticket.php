<?php defined ('ITCS') or die ("Go away.");
	global $template,$Config,$my,$mainframe;
	
	$task=IRequest::getVar('task');
	//$template->includejs($Config->site."classes/external/editor/editor.js");
	$template->includejs($Config->site."templates/itcslive/js/ticket.js");
	$template->includecss("templates/itcslive/css/ticket.css");
	switch($task)
	{
			case "dashboard":
				if((int)$my->uid == 0)
				{
					$mainframe->redirect($Config->site);
				}
				$template->assignRef('Title','Welcome to Ticket Dashboard');
				$template->display('header');
	            $Model = includeclass('dashboard');
				$template->display('ticket/index');
				$template->display('footer');
			break;
			case "breaktime":
				$template->assignRef('Title','Welcome to break time');
				$template->display('tmplpopup/header');
	            $Model = includeclass('user');
				$template->display('ticket/breaktime');
				$template->display('tmplpopup/footer');
			break;
			case "makeattendance":
				$template->assignRef('Title','Welcome to Attendance');
				$template->display('tmplpopup/header');
	            $Model = includeclass('user');
				$template->display('ticket/makeattendance');
				$template->display('tmplpopup/footer');
			break;
			case "edituser":
				$template->assignRef('Title','Welcome to My Tickets');
				$template->display('tmplpopup/header');
	            $Model = includeclass('user');
				$template->display('ticket/edituser');
				$template->display('tmplpopup/footer');
			break;
			case "changepassword":
				$template->assignRef('Title','Welcome to My Tickets');
				$template->display('tmplpopup/header');
	            $Model = includeclass('user');
				$template->display('ticket/changepassword');
				$template->display('tmplpopup/footer');
			break;
		    case "mytickets":
				if((int)$my->uid == 0)
				{
					$mainframe->redirect($Config->site);
				} 
                $Model = includeclass('myticket');	
				$template->assignRef('Title','Welcome to My Tickets');
				$template->display('header');
				$template->display('ticket/myticket');
				$template->display('footer');
			break;
			case "addticket":
				$template->assignRef('Title','Welcome to Add Ticket');
				$template->display('tmplpopup/header');
				$Model = includeclass('myticket');
				$template->display('ticket/addticket');
				$template->display('tmplpopup/footer');
			break;
			case "modifyticket":
				$template->assignRef('Title','Welcome to My Projects');
				$template->display('tmplpopup/header');
				$Model = includeclass('myticket');
				$template->display('ticket/modifyticket');
				$template->display('tmplpopup/footer');
			break;
			case "multiupload":
				$template->assignRef('Title','Welcome to Multiuplode');
				$template->display('tmplpopup/header');
				$Model = includeclass('myticket');
				$template->display('ticket/multiupload');
				$template->display('tmplpopup/footer');
			break;
			 case "mycontacts":
			 	if((int)$my->uid == 0)
				{
					$mainframe->redirect($Config->site);
				} 
				$template->assignRef('Title','Welcome to My Contacts');
				$template->display('header');
	    	    $Model = includeclass('mycontact');
				$template->display('ticket/mycontacts');
				$template->display('footer');
			break;
			case "addtruck":
				$template->assignRef('Title','Add Truck');
				$template->display('tmplpopup/header');
				$Model = includeclass('dashboard');
				$template->display('ticket/addtruck');
				$template->display('tmplpopup/footer');
			break;
			case "appointment":
				$template->assignRef('Title','Welcome to Appointment');
				$template->display('header');
	    	    $Model = includeclass('appointment');
				$template->display('ticket/myappointment');
				$template->display('footer');
			break;
			
			default:
				$template->assignRef('Title','Welcome to Ticket');
				$template->display('header');
				$Model = includeclass('ticket');
				$Tickets = $Model->getTicket();
	  			$template->assignRef('Tickets',$Tickets);
				$template->display('ticket/ticket');
				$template->display('footer');
			break;
	}
	 
?>
