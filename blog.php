<?php
  defined ('ITCS') or die ("Go away.");
	
  global $template; 
  
  $Model = includeclass('blog');
  
  // $Model->WorkingonDB();
   //exit;
  
  	
  
  $blog_id = IRequest::getInt('id',0);
  if($blog_id > 0)
    {
          $SingleBlog = $Model->GetBlogContentByID($blog_id);
		  $template->assignRef('Title',$SingleBlog->title);
		  $template->assignRef('Content',$SingleBlog);
		  $template->display('header');
		  $template->display('blog/single');
		  $template->display('footer');
	}
  else
    {	
		  $Content = $Model->GetBlogContents();
		  $template->assignRef('Title','We Speak');
		  $template->assignRef('Content',$Content);
		  $template->display('header');
		  $template->display('blog/index');
		  $template->display('footer');
     }
?>