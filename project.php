<?php defined ('ITCS') or die ("Go away.");
	global $template,$Config,$my,$mainframe;
	if((int)$my->uid == 0)
	{
		$mainframe->redirect($Config->site);
	}
	$task=IRequest::getVar('task');
	$template->includejs("classes/external/editor/editor.js");
	$template->includecss("templates/itcslive/css/project.css");
	$template->includejs("templates/itcslive/js/project.js");
	switch($task)
	{
		case "addcompany":
			$template->assignRef('Title','Welcome to Add Company');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/addcompany');
			$template->display('tmplpopup/footer');
		break;
		case "addproject":
			$template->assignRef('Title','Welcome to Add Project');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/addproject');
			$template->display('tmplpopup/footer');
		break;
		case "assignproject":
			$template->assignRef('Title','Welcome to Assign Project');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/assignproject');
			$template->display('tmplpopup/footer');
		break;
		case "editDeadline":
			$template->assignRef('Title','Welcome to Edit Deadline');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/editDeadline');
			$template->display('tmplpopup/footer');
		break;
		case "completeproject":
			$template->assignRef('Title','Welcome to Complete Project');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/completeproject');
			$template->display('tmplpopup/footer');
		break;
		case "assigntask":
			$template->assignRef('Title','Welcome to Assign Task');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/assigntask');
			$template->display('tmplpopup/footer');
		break;
		case "addtask":
			$template->assignRef('Title','Welcome to Add Task');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/addtask');
			$template->display('tmplpopup/footer');
		break;
		case "completetask":
			$template->assignRef('Title','Welcome to Complete Task');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/completetask');
			$template->display('tmplpopup/footer');
		break;
		case "addtaskdescription":
			$template->assignRef('Title','Welcome to Task Description');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/addtaskdescription');
			$template->display('tmplpopup/footer');
		break;
		case "employeepayslip":
			$template->assignRef('Title','Welcome to Employee Pay Slip');
			$template->display('tmplpopup/header');
			$Model = includeclass('project');
			$template->display('project/employeepayslip');
			$template->display('tmplpopup/footer');
		break;
		default:
			$template->assignRef('Title','Welcome to Project Dashboard');
			$template->display('header');
			$Model = includeclass('project');
			$template->display('project/index');
			$template->display('footer');
		break;
	}
?> 