var Settings = {
     baseUrl: "http://dev-subjects.kmaps.virginia.edu",
     mmsUrl: "http://dev-mms.thlib.org",
     placesUrl: "http://dev-places.kmaps.virginia.edu"
}

// Initialization of UI components on page
jQuery(function($) {
	// Initialize Search Flyout
  $("#gen-search").buildMbExtruder({
      positionFixed: false,
      position: "right",
      width: 295,
      top: 0
  });
  
  // Language Chooser Functionality with ICheck
  $('input.optionlang').on('ifChecked', function() {
  	var newLang = $(this).val();
  	var oldLang = Drupal.settings.pathPrefix;
  	var currentPage = window.location.pathname;
  	if(oldLang.length > 0) { 
	  	// remove any current lang in url (format = "zh/")
	  	var currentPage = currentPage.replace(RegExp(oldLang + "?$"), ''); // Take care of home page (no slash at end of line)
	  	currentPage = currentPage.replace(oldLang, ''); // All other pages
	  }
  	// Create New URL with new Lang Prefix
  	var newUrl = (Drupal.settings.basePath + newLang + currentPage).replace(/\/\//g, '/'); 
  	window.location.pathname = newUrl;
  });

  // Facet Tree in Search Flyout
  var divs = $('ul.facetapi-mb-solr-facet-tree').parent();
  
  divs.each(function() {
  	var facettype = $(this).children('ul').attr('id').split('-').pop();
  	$(this).attr('id', facettype + '-facet-content-div');
  	//return;
  	$(this).fancytree({
	  	activeVisible: true, // Make sure, active nodes are visible (expanded).
	    aria: false, // Enable WAI-ARIA support.
	    autoActivate: true, // Automatically activate a node when it is focused (using keys).
	    autoCollapse: false, // Automatically collapse all siblings, when a node is expanded.
	    autoScroll: true, // Automatically scroll nodes into visible area.
	    activate: function(event, data) {
	    	var node = data.node;
	    	//window.location.pathname = node.data.href;
	    	console.info(node.data);
	    	return false;
	    },
	    clickFolderMode: 3, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
	    checkbox: false, // Show checkboxes.
	    debugLevel: 1, // 0:quiet, 1:normal, 2:debug
	    disabled: false, // Disable control
  		extensions: ["glyph", "filter"],
      filter: { mode: 'hide' },
	    generateIds: true, // Generate id attributes like <span id='fancytree-id-KEY'>
      glyph: {
          map: {
              doc: "",
              docOpen: "",
              error: "glyphicon glyphicon-warning-sign",
              expanderClosed: "glyphicon glyphicon-plus-sign",
              expanderOpen: "glyphicon glyphicon-minus-sign",
              folder: "",
              folderOpen: "",
          }
      },
	    idPrefix: "fancytree-id-", // Used to generate node id´s like <span id='fancytree-id-<key>'>.
	    icons: true, // Display node icons.
	    keyboard: true, // Support keyboard navigation.
	    keyPathSeparator: "/", // Used by node.getKeyPath() and tree.loadKeyPath().
	    minExpandLevel: 1, // 1: root node is not collapsible
	    selectMode: 2, // 1:single, 2:multi, 3:multi-hier
	    tabbable: true, // Whole tree behaves as one single control
	    titlesTabbable: false, // Node titles can receive keyboard focus
	  });
   //$('ul.ui-fancytree-source, a.facetapi-limit-link').hide();
  });
});



// *** SEARCH *** corrections for widths
jQuery(function($) {

  $("#gen-search div.text").resizable({ handles: "w",
          resize: function (event, ui) {
              $('.title-field').trunk8({ tooltip:false });
          }
      }); // --- initiate jquery resize

  function checkWidth() {
  var panelWidth = $(".text").width();

    if( panelWidth > 275 ) {
        $(".extruder-content").css("width","100%");
      } else
    if( panelWidth <= 275 ) {
        $(".extruder-content").css("width","100% !important");
      }
  }

  // Execute on load
  checkWidth();
  // Bind event listener
  $(".extruder-content").resize(checkWidth);

});


// *** SEARCH *** toggle button
jQuery(function($) {
  if (!$(".extruder.right").hasClass("isOpened")) {
        $(".flap").prepend("<span style='font-size:20px; position:absolute; left:19px; top:13px; z-index:10;'><i class='icon km-search'></i></span>");
        $(".flap").addClass("on-flap");
  }

  // --- set class on dropdown menu for icon
  $(".extruder.right .flap").hover( function() {
      $(this).addClass('on-hover');
      },
        function () {
      $(this).removeClass('on-hover');
      }
  );
});


// *** SEARCH *** Select-Form & iCheck form graphics
jQuery(function ($) {
  $("input[type='checkbox'], input[type='radio']").each(function () {
      var self = $(this),
          label = self.next(),
          label_text = label.text();

      label.remove();
      self.iCheck({
          checkboxClass: "icheckbox_minimal-red",
          radioClass: "iradio_minimal-red",
          insert: "<div class='icheck_line-icon'></div>" + label_text
      });
  });

  $(".selectpicker").selectpicker(); // initiates jq-bootstrap-select

});


// *** CONTENT *** top link
jQuery(function ($) {
  var offset = 220;
  var duration = 500;
  jQuery(window).scroll(function() {
      if (jQuery(this).scrollTop() > offset) {
          jQuery('.back-to-top').fadeIn(duration);
      } else {
          jQuery('.back-to-top').fadeOut(duration);
      }
  });

  jQuery('.back-to-top').click(function(event) {
      event.preventDefault();
      jQuery('html, body').animate({scrollTop: 0}, duration);
      return false;
  })
});



// *** GLOBAL ** conditional IE message
jQuery(function ($) { 
  // show-hide the IE message for older browsers
  // this could be improved with conditional for - lte IE7 - so it does not self-hide
  $(".progressive").delay( 2000 ).slideDown( 400 ).delay( 5000 ).slideUp( 400 );
});

/* Additions by Gerard Ketuma */
/* Reorganization and Additions by Than Grove (2014-05-20)*/






