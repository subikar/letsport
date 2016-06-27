<?php defined ('ITCS') or die ("Go away.");
?>
<img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/BANNER1-638x160.png" alt>
<style>


div#captioned-gallery { width: 100%; overflow: hidden; }

figure { margin: 0; }

figure.slider {

position: relative; width: 500%;

font-size: 0; animation: 40s slidy infinite; 

}

figure.slider figure { 

width: 20%; height: auto;

display: inline-block;

position: inherit; 

}



figure.slider img { width: 100%; height: auto; }

figure.slider figure figcaption {

position: absolute; bottom: 0;

background: rgba(0,0,0,0.3);

color: #fff; width: 100%;

font-size: 2rem; padding: .6rem;

}


@media screen and (max-width: 500px) { 

figure.slider figure figcaption { font-size: 1.2rem; }

}



figure.slider figure figcaption {

position: absolute; bottom: -3.5rem;

background: rgba(0,0,0,0.3);

color: #fff; width: 100%;

font-size: 2rem; padding: .6rem;

transition: .5s bottom; 

}

figure.slider figure:hover figcaption { bottom: 0; }

figure.slider figure:hover + figure figcaption { bottom: 0; }
</style>
<div id="captioned-gallery" style="display:none;">

<figure class="slider">

<figure>

<img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/BANNER1-638x160.png" alt>

<figcaption>Hobbiton, New Zealand</figcaption>

</figure>

<figure>

<img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/img2.png" alt>

<figcaption>Wanaka, New Zealand</figcaption>

</figure>

<figure>

<img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/BANNER1-638x160.png" alt>

<figcaption>Utah, United States</figcaption>

</figure>

<figure>

<img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/BANNER1-638x160.png" alt>

<figcaption>Bryce Canyon, Utah, United States</figcaption>

</figure>

<figure>

<img src="http://dev.itcslive.com/custom/itcslive/templates/itcslive/css/images/banners/BANNER1-638x160.png" alt>

<figcaption>Hobbiton, New Zealand</figcaption>

</figure>

</figure>

</div>