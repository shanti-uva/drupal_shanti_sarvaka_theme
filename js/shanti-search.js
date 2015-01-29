(function ($) {
/*
 *  Functions for the Search Flyout
 */

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
	    $("div.extruder-content > div.text").resizable({
	      handles: "w",
	      resize: function (event, ui) {
	        $('span.fancytree-title').trunk8({ tooltip:false });
	      }
	    });

	    // Bind event listener
	    $(".extruder-content").resize(Drupal.ShantiSarvaka.checkWidth);

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


// --- kms, KMAPS MAIN SEARCH INPUT ---
//  Drupal.behaviors.sarvakaSearchReset = {
//    attach: function (context, settings) {
//    	if(context == document) {
//				var kms = $("#searchform"); // the main search input
//			  $(kms).data("holder",$(kms).attr("placeholder"));
//
//			  // --- features inputs - focusin / focusout
//			  $(kms).focusin(function(){
//			      $(kms).attr("placeholder","");
//			      $("button.searchreset").show("fast");
//			  });
//			  $(kms).focusout(function(){
//			      $(kms).attr("placeholder",$(kms).data("holder"));
//			      $("button.searchreset").hide();
//
//			    var str = "Enter Search...";
//			    var txt = $(kms).val();
//
//			    if (str.indexOf(txt) > -1) {
//			      $("button.searchreset").hide();
//			    return true;
//			    } else {
//			      $("button.searchreset").show(100);
//			    return false;
//			    }
//			  });
//			  // --- close and clear all
//			  $("button.searchreset").click(function(){
//			    $(kms).attr("placeholder",$(kms).data("holder"));
//			    $("button.searchreset").hide();
//			    $(".alert").hide();
//			        searchUtil.clearSearch();
//			        $('#tree').fancytree("getTree").clearFilter();
//			  });
//	    }
//    }
//  };



})(jQuery);
