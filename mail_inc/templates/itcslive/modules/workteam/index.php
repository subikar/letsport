<?php defined ('ITCS') or die ("Go away."); 
global $Config;
?>
 	<script src="<?php echo $Config->site; ?>templates/itcslive/js/templatejs/jquery.carouFredSel-6.1.0-packed.js"></script>
     <script  src="<?php echo $Config->site; ?>templates/itcslive/js/templatejs/jquery.touchSwipe.min.js"></script> 
     <script>
	 $(window).load (
			function(){$('#carousel1').carouFredSel({auto: false, prev: '#prev',next: '#next', width: 220, items: {
			  visible : {min: 1,
			   max: 4
		},
		height: 'auto',
		 width: 220,
		}, responsive: true, 
		scroll: 1, 
		mousewheel: false,
		swipe: {onMouse: true, onTouch: true}});
    } ); 
  </script>
<div class="wrapper">
    <div class="grid_12">
        <div class="div-main">
           <h3 class="bot-1">Work Team</h3>
             <div class="carousel-box">
        <a id="prev"></a>
        <a id="next"></a>
        <div class="carousel">
          <ul id="carousel1">
			<li>
			   <img src="<?php echo $Config->site; ?>templates/itcslive/images/president.jpg" alt="" class="img_bdr">
			   <strong><a href="#" class="col hov">Jai Prakash Burman</a></strong>
			   <span>President</span>
			</li>
			<li>
			   <img src="<?php echo $Config->site; ?>templates/itcslive/images/subikar.jpg" alt="" class="img_bdr">
			   <strong><a href="#" class="col hov">Subikar Burman</a></strong>
			   <span>CEO</span>
			</li>
			<li>
			   <img src="<?php echo $Config->site; ?>templates/itcslive/images/pradip.jpg" alt="" class="img_bdr">
			   <strong><a href="#" class="col hov">Pradip Burman</a></strong>
			   <span>Managing Director</span>
			</li>
			<li>
			   <img src="<?php echo $Config->site; ?>templates/itcslive/images/gp.jpg" alt="" class="img_bdr">
			   <strong><a href="#" class="col hov">Gyan Prakash Burman</a></strong>
			   <span>HR Manager</span>
			</li>
			<?php foreach($this->usersInArray as $workteam): ?>
			<li>
			   <img src="<?php echo $Config->site.$workteam->avatar; ?>" alt="" class="img_bdr">
			   <strong><a href="#" class="col hov"><?php echo $workteam->name; ?></a></strong>
			   <span><?php echo $workteam->designation; ?></span>
			</li>
			<?php endforeach; ?>
          </ul>
        </div>
        </div>     
        </div>
    </div></div>