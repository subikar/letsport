<?php defined ('ITCS') or die ("Go away."); 
global $Config;
$key = 0;
?>
  <div class="container">
  <h3 class="bot-1 ptm">Testimonials</h3>
<div class="col-md-8 col-md-offset-2">
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
				<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
				  <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
				    <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner">
				 
		  <?php if(count($this->testimonialsInArray)>0): ?>
   			<?php foreach($this->testimonialsInArray as $testimonial): 
			  if($key == 0){ ?>
				  <div class="active item">
				  	<?php $key++;} else{?>
				  	<div class="item">
				  		<?php } 
				if(isset($testimonial->gallery))
					{ $imageFile=$testimonial->gallery; 
					  //print_r($imageFile);exit;
					} 
				else 
					{
						 $imageFile= "templates/itcslive/images/portfolio/customer_review.png";
				   		  //print_r($imageFile);exit;
				    }
			?>
			
			 <blockquote><?php echo $testimonial->testimonial_content; ?> </blockquote>
			   <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"><img src="<?php echo $Config->site.$imageFile; ?>" alt="alt" width="98" height="95" /></div>
				  <blockquote><strong><a class="col hov" href="#"><?php //echo $testimonial->client_name; ?></a></strong> <span class="dis-block"><?php //echo $testimonial->client_address; ?></span> </blockquote>
			   </div>
			
			<?php endforeach; ?>
   		<?php else: ?>
		<li style="width:295px; height:350px;">
		<div class="block-2">" "</div>
		   <div class="block-3"><img class="fleft img_bdr right-2" src="templates/itcslive/images/portfolio/customer_review.png" alt="alt" width="98" height="95" />
			  <div class="extra-wrap"><strong><a class="col hov" href="#">Charles Gallie</a></strong> <span class="dis-block">Washinton DC USA, Founder SoberFolk.Org</span> </div>
		   </div>
		  </li> 
		<?php endif; ?>
          </ul>
        </div>
        </div>
        </div>
			</div>							
		</div>	
		</div>
