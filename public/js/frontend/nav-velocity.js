// Thanks https://codepen.io/virgilpana/full/dPKavr

var offCanvasIn = [{
    e: $("#menu-wrapper ul#nav > li"),
    p: 'transition.slideLeftIn',
    o: { delay: 300, stagger: 250, duration: 300 }
}];
var offCanvasOut = [{
    e: $("#menu-wrapper ul#nav > li"),
    p: 'reverse',
    o: { stagger: 250, duration: 300 }
}];


if( 'ontouchstart' in window ){
	var click = 'touchstart'; 
}
else { 
	var click = 'click'; 
}

		
	$('div.burger').on('click', function(event){
		event.preventDefault();
		if( !$(this).hasClass('open') ){ 
			openMenu(); 
			$.Velocity.RunSequence(offCanvasIn);			
		} 
		else { 
		    $.Velocity.RunSequence(offCanvasOut);
			closeMenu(); 
		}
	});	

	
	function openMenu(){	
		$('div.burger').addClass('open');	
		$('div.y').fadeOut(100);
		$('div.screen').addClass('animate');
	
		setTimeout(function(){					
			$('div.x').addClass('rotate30'); 
			$('div.z').addClass('rotate150'); 
			$('.menu').addClass('animate');
	
			setTimeout(function(){				
				$('div.x').addClass('rotate45'); 
				$('div.z').addClass('rotate135');  
			}, 100);
	
		}, 10);	
	}
	
	function closeMenu(){		
		$('div.screen, .menu').removeClass('animate');
		$('div.y').fadeIn(150);
		$('div.burger').removeClass('open');	
		$('div.x').removeClass('rotate45').addClass('rotate30'); 
		$('div.z').removeClass('rotate135').addClass('rotate150');		
		setTimeout(function(){ 			
			$('div.x').removeClass('rotate30'); 
			$('div.z').removeClass('rotate150'); 			
		}, 50);
		setTimeout(function(){				
			$('div.x, div.z').removeClass('collapse');
		}, 70);
	}



