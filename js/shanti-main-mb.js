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
			items.last().after('<p id="pb-core-desc-readmore"><a href="#" class="show-more">Show More</a><a href="#" style="display:none;" class="show-less">Show Less</a></p>');
			$("#pb-core-desc-readmore a").click(function(e) {
				var items = $('.field-name-field-pbcore-description > .field-items > .field-item');
				items.first().nextAll('.field-item').slideToggle();
				$("#pb-core-desc-readmore a").toggle();
				e.preventDefault();
			});
		}
	}
} (jQuery)); // End of JQuery Wrapper