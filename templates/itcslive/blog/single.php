<?php defined ('ITCS') or die ("Go away."); 
global $Config;
$Blog=$this->Content["blog"];
$Comments=$this->Content["comments"];
?>
<link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/form.css">
<div class="wrapper">
   <div class="grid_8">
      <h3 class="bot-1"><a class="col-1 hov" href="<?php echo $Config->site.$Blog->seo; ?>" title="Permalink to <?php echo $Blog->title; ?>" rel="bookmark"><?php echo $Blog->title; ?></a></h3>
	  <div class="bot">
         <div class="extra-wrap">
            <div class="entry-content">
 				<?php echo $Blog->content; ?>
                <div class="entry-meta"> 
					<strong>Posted on</strong> <?php echo date('M d, Y',strtotime($Blog->created)); ?> <strong>by</strong>  
					<span class="author vcard"><?php echo $Blog->name;  ?></span> 
				</div>
			   <div class="entry-meta">
			   <span class="cat-links"> Category: <?php echo $Blog->category_name; ?></span> 
			   <span class="sep"> | </span> 
			   <span class="comments-link">
			   <a href="<?php echo $Config->site.$Blog->seo; ?>#comment" title="Comment on <?php echo $Blog->title; ?>.."><b><?php echo count($Comments); ?></b> Reply</a>
			    </div>
            </div>
         </div>
      </div>
	  <div class="allcomments">
	  <?php foreach($Comments as $comment): ?>
	  <div id="comment_box_9">
				 <div class="tb-comment-header">
					<div class="user_avatar"> <span class="tb-avatars-initials undefined"><i class="fa fa-fw fa-user"></i></span><?php echo $comment->name; ?></div>
				 </div>
				 <div> <span class="tb-comment-meta-info"><?php echo $comment->created; ?></span></div>
				 <div class="tb-comment-text"><?php echo $comment->comment; ?></div>
		   <div class="clear"></div>
		</div>
	  <?php endforeach; ?>
	  </div>
	  <div class="comment_section" id="comment">
	  <h3>Leave a Comment</h3>
	  <fieldset> 
			<form action="" method="post"  name="blogpostForm" id="blogpostForm" class="form" >
		    <input type="hidden" name="view" value="blog" />
			<input type="hidden" name="task" value="createComment" />
			<input type="hidden" name="type" value="Blog" />
			<input type="hidden" name="type_id" value="<?php echo $Blog->id; ?>" />
			
            <label class="name">
            <input type="text" name="name"  placeholder="Enter Name" />
            <br class="clear">
            <span class="error_tag" id="error_name" ></span>
			</label>
			
            <label class="email">
             <input type="text" name="email"  placeholder="Enter Email" />
            <br class="clear">
            <span class="error_tag" id="error_email" ></span></label>
			
            <label class="phone">
            <input type="text" name="phone"  placeholder="Enter Phone" />
            <br class="clear">
            <span style="display: none;" class="error error-empty">*This is not a valid phone number.</span>
			</label>
			
            <label class="message">
            <textarea name="comment" placeholder="Write Comment"></textarea>
            <br class="clear">
			   <span class="error_tag" id="error_message" ></span>
			</label>
			
            <label class="captcha">				  
			<input id="captcha_code" name="captcha_code" type="text" placeholder="Type Text ->" />
				  <span class="captchaimage">
                  <img src="<?php echo $Config->site ?>classes/external/captcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
				  <a href='javascript: Blogpost.refreshCaptcha();'><span class="fa fa-refresh"></span></a>
				  </span>
				  <br clear="all" />
			      <span id="captcha_error"></span>
			</label>
            <div class="clear"></div>
			<div class="btns">
			<a class="button-1" data-type="reset" onclick="document.getElementById('blogpostForm').reset();" href="javascript:void(0);"><span></span>Clear</a>
			<div class="none"></div>
			<a onclick="Blogpost.validatePost('blogpostForm');" class="button-1" data-type="submit" href="javascript:void(0);"><span></span>Send</a>
            <div class="clear"></div>
            </div>
			</form>
			</fieldset>
	</div>  
   </div>
   <div class="grid_4">
     <?php /*?> <div>
         <?php includemodule("contact"); ?>
      </div><?php */?>
      <div>
         <?php includemodule("latestblog"); ?>
      </div>
      <div>
         <?php includemodule("comments"); ?>
      </div>
   </div>
</div>
<script type="text/javascript">
var Blogpost=new function()
{
	this.validatePost=function(input_id)
	{
		var input=document.getElementById(input_id);
		var phoneno = /^\d{10}$/;  
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		jQuery(".error_tag").hide();
		
		if(input.name.value=="")
		{
			input.name.focus();
			jQuery("#error_name").html("Name Can't Left Blank!").show();
			return false;
		}
		else if(input.email.value=="" || !regex.test(input.email.value))
		{
			input.email.focus();
			jQuery("#error_email").html("Email Invalid!").show();
			return false;
		}
		else if(input.comment.value=="" || input.comment.value==" ")
		{
			input.comment.focus();
			jQuery("#error_message").html("<small>Comment Can't Left Blank!</small>").show();
			return false;
		}
		else if(input.comment.value.length < 5)
		{
			input.comment.focus();
			jQuery("#error_message").html("<small>The comment is too short!</small>").show();
			return false;		
		}
		else
		{
			jQuery("#captcha_error").html("");
			var formURL="blog?view=blog&task=varifyCaptcha";
			jQuery.post(formURL,{ captcha:input.captcha_code.value},
			function(data){
				var result=JSON.parse(data);
				if(parseInt(result["status"])==1)
				{
					input.submit();
				}
				else
				{
					jQuery("#captcha_error").html(result["message"]);
					Ticket.refreshCaptcha();
				}
			});
		}
	}
	this.refreshCaptcha=function(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
}
</script>
