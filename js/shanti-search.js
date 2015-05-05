(function ($) {
/*
 *  Functions for the Search Flyout
 */

/* open advanced search options by default */
Drupal.behaviors.sarvakaOpenAdvancedViewDefault = {
  attach: function (context, settings) {
    // $(".advanced-view").addClass("show-options");  // set display:block; on search options	
  }	
};

/*
 * MbExtruder Init
 */

Drupal.behaviors.sarvakaMbextruder = {
  attach: function (context, settings) {
  	if(context == document) {
	    var mywidth = Drupal.settings.shanti_sarvaka.flyoutWidth;
	    $(".input-section, .view-section, .view-section .nav-tabs>li>a").css("display","block"); // show hidden containers after loading to prevent content flash
			// Remove extruder div content so as to preserve AJAX events
			var mbContent = $("#search-flyout .region.region-search-flyout").detach();
	    // Initialize Search Flyout
	    $("#search-flyout").buildMbExtruder({
	      positionFixed: false,
	      position: "right",
	      closeOnExternalClick:false,
	      closeOnClick:false,
	      width: mywidth, // width is set in two places, here and the css
	      top: 0
	    });
	    // Add back in extruder content
	    $('#search-flyout .text').append(mbContent);
	    // Make it resizeable
	    try { 
		    if($("div.extruder-content > div.text").length > 0) {
			    $("div.extruder-content > div.text").resizable({
			      handles: "w",
			      resize: function (event, ui) {
			      	$('#search-flyout .extruder-content').css('width','');
			        //$('span.fancytree-title').trunk8({ tooltip:false });
			      }
			    });
				}
		    // Bind event listener
		    $(".extruder-content").resize(Drupal.ShantiSarvaka.checkWidth);
		   } catch (e) { console.error('Resizeable not a function error caught! shanti-search.js line 31');}

	    if (!$(".extruder.right").hasClass("isOpened")) {
	      $(".flap").click( function() {
	        $(".extruder .text").css("width","100%");
	      });
	      // styles inline for now, forces
	      $(".flap").prepend("<span><span class='icon shanticon-search'></span></span>");
	      $(".flap").addClass("on-flap");
	    }

	    // --- set class on dropdown menu for icon
	    $('.shanti-field-title a').hover( function() {
	      $(this).addClass('on-hover');
	    },
	    function () {
	      $(this).removeClass('on-hover');
	    });

	    // --- set class on dropdown menu for icon
	    $(".extruder.right .flap").hover(
	      function () {
	        $(this).addClass('on-hover');
	      },
	      function () {
	        $(this).removeClass('on-hover');
	    });
	    // Show Flyout tab hidden on load
	    $('#search-flyout').show();
	    // Inizialize bootstrap elements inside flyout region
	    $('#search-flyout .selectpicker').selectpicker({
	      dropupAuto: false,
	    }); // initiates jq-bootstrap-select
    }
  }
};

  /**
   * Search Init
   */

  Drupal.behaviors.sarvakaSearchInit = {
    attach: function (context, settings) {
    	if(context == document) {
	       // --- autoadjust the height of search panel, call function TEMP placed in bottom of equalheights js
	      Drupal.ShantiSarvaka.searchTabHeight();
	      $(window).bind('load orientationchange resize', Drupal.ShantiSarvaka.searchTabHeight );
	    }
    }
  };


})(jQuery);
