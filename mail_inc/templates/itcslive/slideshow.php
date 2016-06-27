<?php defined ('ITCS') or die ("Go away.");?>
<link rel="stylesheet" href="<?php echo $this->site; ?>templates/itcslive/css/camera.css">
<script src="<?php echo $this->site; ?>templates/itcslive/js/camera.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
		   jQuery('#camera_wrap').camera({
			loader: false,
			pagination: false,
			thumbnails: false,
			height: '48.61407249466951%',
			caption: true,
			navigation: true,
			fx: 'mosaic'
		  }); 
        $().UItoTop({ easingType: 'easeOutQuart' });
});		
</script>
<div class="container_12">
        <div class="grid_12">
          <div class="slider_wrapper">           
              <div id="camera_wrap">
                    <div data-src="<?php echo $this->site; ?>templates/itcslive/images/slide.jpg">
                      <div class="banner caption fadeIn">  <div class="banner-inner">
                          <span>Graphic Design</span></span>
                          <em>Website and graphic design that we deliver are affordable and customizable. We take different business verticals into account while providing clients with development and designing services.</em>
                           <a href="<?php echo $this->site; ?>web-design-package"><span></span>More</a>
                        </div>  
                        </div>
                    </div>
                    <div data-src="<?php echo $this->site; ?>templates/itcslive/images/slide-1.jpg"> 
                      <div class="banner caption fadeIn"><div class="banner-inner">
                          <span>Web Development!</span>
                          <em>We fulfill the business objectives of our clients by providing them with user-friendly platforms based online or otherwise. These platforms allow them to transact business at a much smoother pace.</em>
                           <a href="<?php echo $this->site; ?>php-programming-services"><span></span>More</a>
                        </div>
                        </div>
                    </div>
                   <div data-src="<?php echo $this->site; ?>templates/itcslive/images/slide-2.jpg"> 
                      <div class="banner caption fadeIn"><div class="banner-inner">
                          <span>Open Source</span>
                          <em>We provide our customers with numerous applications based on the web in order to fulfill their financial and other needs. These applications help them enjoy a few simple and fast utility services.</em>
                           <a href="<?php echo $this->site; ?>php-programming-services"><span></span>More</a>
                        </div>
                        </div>
                    </div>					
                   <div data-src="<?php echo $this->site; ?>templates/itcslive/images/slide-3.jpg"> 
                      <div class="banner caption fadeIn"><div class="banner-inner">
                          <span>Social Media</span>
                          <em>As social media experts, we're keeping with the latest technologies and trends. You won't need to worry, since we take care of mash-ups, memes, microblogging and hashtags.</em>
                           <a href="<?php echo $this->site; ?>seo"><span></span>More</a>
                        </div>
                        </div>
                    </div>					
            </div></div>
      </div>
</div>