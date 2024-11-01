jQuery(document).ready(function(){
  jQuery(".owl-carousel").owlCarousel({
  	loop : true,
  	center:true,
  	nav:true,
  	navText:[ '<span class="left-nav">&lt;</span>', '&gt;' ],
  	autoplay:true,
  	autoplayHoverPause:true,
  	autoplayTimeout:2000,
  });  
});