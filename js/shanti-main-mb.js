(function ($) { // jQuery wrapper function
	// Document ready function
	$(function() {
		// Trim Description field
		if($('.field-name-field-pbcore-description .field-item').length > 1) { smmbTrimDescription(); }
	}); // End of Document Ready function
	
	// Function to trim the description field for a node
	function smmbTrimDescription() {
		var items = $('.field-name-field-pbcore-description > .field-items > .field-item');
		if(items.length > 1) { 
			items.first().nextAll().hide();
			items.last().after('<p id="pb-core-desc-readmore"><a href="#" class="show-more-toggle">(Show More)</a></p>');
			if(!$(".avdesc").hasClass("show-more-height")) { $(".avdesc").addClass("show-more-height"); }
			$(".show-more-toggle").click(function (e) {
				var items = $('.field-name-field-pbcore-description > .field-items > .field-item');
				items.first().nextAll('.field-item').slideToggle();
		     if($(".avdesc").hasClass("show-more-height")) {
		         $(this).text("(Show Less)");
		     } else {
		         $(this).text("(Show More)");
		     }
		     $(".avdesc").toggleClass("show-more-height");
				 e.preventDefault();
			});
		}
	}
} (jQuery)); // End of JQuery Wrapper