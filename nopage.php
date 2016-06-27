<?php defined ('ITCS') or die ("Go away.");
  $template->assignRef('Title','Page Not Found');
  $template->display('header');
  $template->display('nopage/index');
  $template->display('footer');
 ?> 