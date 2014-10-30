(function ($) {
/*
 *  Functions for the Search Flyout
 */

/*
 * MbExtruder Init
 */
Drupal.behaviors.sarvakaMbextruder = {
  attach: function (context, settings) {
    var mywidth = Drupal.settings.shanti_sarvaka.flyoutWidth;
    $(".input-section, .view-section, .view-section .nav-tabs>li>a").css("display","block"); // show hidden containers after loading to prevent content flash
      
    // Initialize Search Flyout
    $("#search-flyout").buildMbExtruder({
      positionFixed: false,
      position: "right",
      closeOnExternalClick:false,
      closeOnClick:false,
      width: mywidth, // width is set in two places, here and the css
      top: 0
    });
            
    // Make it resizeable
    $("div.extruder-content > div.text").resizable({
      handles: "w",
      resize: function (event, ui) {
        $('span.fancytree-title').trunk8({ tooltip:false });
      }
    });
          
    // Bind event listener
    $(".extruder-content").resize(checkWidth);
     
    if (!$(".extruder.right").hasClass("isOpened")) {
      $(".flap").click( function() {
        $(".extruder .text").css("width","100%");
      });
      // styles inline for now, forces
      $(".flap").prepend("<span><i class='icon shanticon-search'></i></span>");
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
};

  /**
   * Search Init
   */
  Drupal.behaviors.sarvakaSearchInit = {
    attach: function (context, settings) {
      // Handle Search form Submit
      $('#search-flyout form button#searchbutton:not(form#csc-views-advanced-search-form)').click(function() { $(this).parents('form').eq(0).submit(); });
      $('#search-flyout form:not(form#csc-views-advanced-search-form)').on('submit', function(event) {
        // TODO: Implement Ajax searching
        // In order to implement Ajax searching need to use hash to create unique bookmarks. Check out Jquery BBQ (though tis old).
        // See doAjaxSearch function below => partial implementation
        //doAjaxSearch($(this).find('input[type=text]').val(), $(this).find('input[name=srchscope]').val());
        // event.preventDefault();
        // `window.location.pathname = '/search/' + $(this).find('input[name=srchscope]').val() + '/' + $(this).find('input[type=text]').val();
      });
      
       // --- autoadjust the height of search panel, call function TEMP placed in bottom of equalheights js
      searchTabHeight();
      $(window).bind('load orientationchange resize', searchTabHeight );
      
      // --- advanced search toggle icons, open/close, view change height
      $(".advanced-link").click(function () {
          $(this).toggleClass("show-advanced",'fast');
          $(".advanced-view").slideToggle('fast');
          $(".advanced-view").toggleClass("show-options");
          $(".view-wrap").toggleClass("short-wrap"); // ----- toggle class for managing view-section height      
          searchTabHeight();
      });
      $('#edit-advanced-search-api-views-fulltext-autocomplete').removeClass('autocomplete-processed');
      $('#edit-advanced-search-api-views-fulltext').keyup(function() {
        Drupal.behaviors.autocomplete.attach(document);
      });
    }
  };
})(jQuery);
