(function ($) { // jQuery wrapper function
	
	Drupal.behaviors.shanti_sarvaka_mb_trim_desc =  {
	  attach: function (context, settings) {
			if($('.field-name-field-pbcore-description .field-item').length > 1) { 
				var items = $('.field-name-field-pbcore-description > .field-items > .field-item');
				if(items.length > 1) { 
					items.first().nextAll().hide();
					items.last().after('<p id="pb-core-desc-readmore"><a href="#" class="show-more-toggle">' + Drupal.t('Show More') + '</a></p>');
					if(!$(".avdesc").hasClass("show-more-height")) { $(".avdesc").addClass("show-more-height"); }
					$(".show-more-toggle").click(function (e) {
						var items = $('.field-name-field-pbcore-description > .field-items > .field-item');
						items.first().nextAll('.field-item').slideToggle();
				     if($(".avdesc").hasClass("show-more-height")) {
				         $(this).text(Drupal.t('Show Less'));
				     } else {
				         $(this).text(Drupal.t('Show More'));
				     }
				     $(".avdesc").toggleClass("show-more-height");
						 e.preventDefault();
					});
				}
			}
		}
	};
	
	// Various Markup changes for styling MB in sarvaka theme
	Drupal.behaviors.shanti_sarvaka_mb_markup_tweaks = {
		attach: function (context, settings) {
			if(context == window.document) { 
				$('#edit-group-audience .form-item-group-audience-und').wrapInner('<div class="collection-details-audience"></div>');
				$('.collection-details-audience').before($('.collection-details-audience > label').detach());
				$('#edit-group-audience .form-item-group-audience-und > label, #edit-field-subcollection > label').prepend('<span class="icon shanticon-create"></span> ');
				$('#edit-field-characteristic > label').prepend('<span class="icon shanticon-subjects"></span> ');
				$('#edit-field-pbcore-coverage-spatial > label').prepend('<span class="icon shanticon-places"></span> ');
			}
	  }
	};
	
} (jQuery)); // End of JQuery Wrapper