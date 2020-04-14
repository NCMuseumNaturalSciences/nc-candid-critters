			var modalHeader = $('.modal-header');
			var modalHeading = $('.modal-header h1');
			var modalImg = $('.modal-header img');
			var modalContentBody = $('.modal-body');
			var paleoModalContentBody = $('.paleo-modal-body');
			var modalContent = $('.modal-content-wrapper');

	
/*	$('a.circle-link').on('click', function(event){
		if(modalType = "large") {
			var modalsequence = [{
				e: modalHeader,
				p: { height: 300, padding: 20 },
				o: { delay: 100, duration: 300 }
				}, {
				e: modalImg, 
				p: { opacity: 1 },
				o: { duration: 300 }
				}, {			
				e: modalHeading,
				p: { opacity: 1 },
				o: { duration: 300 }
				}, {
				e: modalContentBody,
				p: { height: 460, padding: 30 },
				o: { delay: 100, duration: 300 }
				}, { 
				e: modalContent, 
				p: { opacity: 1 },
				o: { duration: 300 }
				}];
		}
		else {
			var modalsequence = [{
				e: modalHeader,
				p: { height: 300, padding: 20 },
				o: { delay: 100, duration: 300 }
				}, {
				e: modalImg, 
				p: { opacity: 1 },
				o: { duration: 300 }
				}, {			
				e: modalHeading,
				p: { opacity: 1 },
				o: { duration: 300 }
				}, {
				e: modalContentBody,
				p: { height: 180, padding: 30 },
				o: { delay: 100, duration: 300 }
				}, { 
				e: modalContent, 
				p: { opacity: 1 },
				o: { duration: 300 }
				}];
		};
		$.Velocity.RunSequence(modalsequence);
	});
	*/
	
	$(".modal").each(function(index) {
		$(this).on('show.bs.modal', function(e) {
			var modalType = $(this).data("modal-type");
			console.log(modalType);
			if(modalType == "large") {
				console.log("large");
				var modalsequence_lg = [{
					e: modalHeader,
					p: { height: 300, padding: 20 },
					o: { delay: 100, duration: 300 }
					}, {
					e: modalImg, 
					p: { opacity: 1 },
					o: { duration: 300 }
					}, {			
					e: modalHeading,
					p: { opacity: 1 },
					o: { duration: 300 }
					}, {
					e: modalContentBody,
					p: { height: 480, padding: 30 },
					o: { delay: 100, duration: 300 }
					}, { 
					e: paleoModalContentBody,
					p: { height: 320, padding: 15 },
					o: { delay: 100, duration: 300 }
					}, { 
					e: modalContent, 
					p: { opacity: 1 },
					o: { duration: 300 }
					}];
					$.Velocity.RunSequence(modalsequence_lg);
			};
			if(modalType == "small") {
				console.log("small");
				var modalsequence_sm = [{
					e: modalHeader,
					p: { height: 300, padding: 20 },
					o: { delay: 100, duration: 300 }
					}, {
					e: modalImg, 
					p: { opacity: 1 },
					o: { duration: 300 }
					}, {			
					e: modalHeading,
					p: { opacity: 1 },
					o: { duration: 300 }
					}, {
					e: modalContentBody,
					p: { height: 180, padding: 30 },
					o: { delay: 100, duration: 300 }
					}, { 
					e: paleoModalContentBody,
					p: { height: 320, padding: 15 },
					o: { delay: 100, duration: 300 }
					}, { 
					e: modalContent, 
					p: { opacity: 1 },
					o: { duration: 300 }
					}];
					$.Velocity.RunSequence(modalsequence_sm);
			}
			
		});
	});
				
	$(".modal").each(function(index) {
		$(this).on('hide.bs.modal', function(e) {
		var modalrevsequence = [{
			e: modalContent, 
			p: 'reverse',
			o: { duration: 1 }
			}, {
			e: modalContentBody,
			p: 'reverse',
			o: { duration: 1 }
			}, { 
			e: modalHeading,
			p: 'reverse',
			o: { duration: 1 }
			}, {
			e: modalImg, 
			p: 'reverse',
			o: { duration: 1 }
			}, {	
			e: modalHeader,
			p: 'reverse',
			o: { duration: 1 }
			}];
		$.Velocity.RunSequence(modalrevsequence);		
		});
	});
        

