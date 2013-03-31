// JavaScript Document
var playlist = new Array();
$(document).ready(function(e) {
    $('.index-new-products .frame').cycle({ 
		fx:    'scrollHorz', 
		timeout:5000,
		pause:  5000,
		next:   '.index-new-products .next', 
		prev:   '.index-new-products .prev'
		});
		
		$('.banner .gallery').cycle({
			fx:'fade',
			pager:'.pager',
			timeout:10000,
			pagerAnchorBuilder: function(index, element) {				
							return $(".pager A:eq("+(index)+")");
			},
			before:function(currSlideElement, nextSlideElement, options, forwardFlag) { 
				currIndex = $('.banner .gallery .media').index($(currSlideElement)); 
				nextIndex = $('.banner .gallery .media').index($(nextSlideElement));
				$('.banner .title:eq('+currIndex+')').animate({'opacity':'0','left':'-1000px'},500,'easeOutQuad',function(){
					$('.banner .title:eq('+nextIndex+')').animate({'opacity':'1','left':'00px'},1000,'easeOutQuad');
				});
				
				if($(currSlideElement).attr('data-type')=='video'){
					var currVideoIndex = $('.banner .gallery .media[data-type="video"]').index($(currSlideElement));
					try{
						playlist[currVideoIndex].pauseVideo();
					}catch(e){}
				}
				
				if($(nextSlideElement).attr('data-type')=='video'){
					var nextVideoIndex = $('.banner .gallery .media[data-type="video"]').index($(nextSlideElement));
					//playlist[nextVideoIndex].playVideo();
				}
			}			
		});
		
		
		
		if($(".gallery .media").length==1){
			$('.banner .title:eq(0)').animate({'opacity':'1','left':'00px'},1000,'easeOutQuad');
		}
		
		$('.banner').mouseenter(function(){$('.banner .gallery').cycle('pause');}).mouseleave(function(){$('.banner .gallery').cycle('resume');});
});

var tag = document.createElement('script');
tag.src = "//www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	
function onYouTubeIframeAPIReady() {
   $('.banner .gallery .media[data-type="video"]').each(function(index, element) {
	var player = new YT.Player($(element).children('div').prop('id'), {
		  height: '360',
		  width: '640',
		  videoId: $(element).children('div').prop('id'),
		  playerVars:{
			  'controls':0,
			  'showinfo':0,
			  'theme':'light'
		  }
		});
		playlist.push(player);			
	});
} 