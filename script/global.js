// JavaScript Document
$(document).ready(function(e) {
    $('.header .fire').fadeIn().css({'background-position': '150% top','background-image':'url(css/core/menu-fire'+(Math.floor(Math.random() * (3 - 1 + 1)) + 1)+'.jpg)'}).animate({'background-position': '100% top'},10000,'easeOutQuad');
	
	$('.side-nav a').click(function(e){
		if($(this).parent().children('ul').length>0){
			$(this).parent().children('ul').slideToggle();
			return false;
		}else
			return true;
	});
});