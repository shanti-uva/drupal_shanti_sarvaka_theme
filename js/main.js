/** 
 * Taken from Kmaps Aardvark Site
 * Adapted to Shanti Sarvaka Mediabase by Than Grove (beginning 2014-05-22)
 **/
var ShantiSettings = {
     baseUrl: "http://dev-subjects.kmaps.virginia.edu",
     mmsUrl: "http://dev-mms.thlib.org",
     placesUrl: "http://dev-places.kmaps.virginia.edu",
     ftListSelector: "ul.facetapi-mb-solr-facet-tree" // should change "mb-solr" to "fancy" for universality
}

/**
 * Extend Fancy Tree
 * 	Adds clearFacetFilter function
 */

;(function($, undefined) {

// Consider to use [strict mode](http://ejohn.org/blog/ecmascript-5-strict-mode-json-and-more/)
"use strict";
	
	$.ui.fancytree._FancytreeClass.prototype.clearFacetFilter = function(){
		var tree = this,
			treeOptions = tree.options;
			if (tree.activeNode) {
	        tree.activeNode.setActive(false);
	    }
	    tree.clearFilter();
	    tree.rootNode.visit(function (node) {
	        node.setExpanded(false);
	    });
	    // "unwrap" the <mark>ed text
	    tree.$div.eq(0).find('span.fancytree-title mark').each(
	        function () {
	          var parent = $(this).parent()
	        	var children = parent.children('.facet-count, .element-invisible').remove();
	          parent.text(parent.text());
	          parent.append(children);
	        }
	    );
	};
// End of namespace closure
} (jQuery));

// Initialization of UI components on page on load
jQuery(function($) {
  createTopLink();
  iCheckInit();
  langButtonsInit();
	mbExtruderInit();
	fancytreeInit();
  miscInit();
  checkWidth();
});

// *** CONTENT *** top link
function createTopLink() {
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
  });
}

// Initialize iCheck form graphics
function iCheckInit() {
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

}

/* Initialize Language Buttons */
function langButtonsInit() {
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
}

/* Initialize Extruder search fly-out */
function mbExtruderInit() {
	// Initialize Search Flyout
  $("#gen-search").buildMbExtruder({
      positionFixed: false,
      position: "right",
      width: 310,
      top: 0
  });
  
  // Make it resizeable
  $("div.extruder-content > div.text").resizable({ handles: "w",
      resize: function (event, ui) {
          $('span.fancytree-title').trunk8({ tooltip:false });
      }
   });
      
  // Bind event listener
  $(".extruder-content").resize(checkWidth);
  
  if (!$(".extruder.right").hasClass("isOpened")) {
        $(".flap").prepend("<span style='font-size:20px; position:absolute; left:19px; top:13px; z-index:10;'><i class='icon km-search'></i></span>");
        $(".flap").addClass("on-flap");
  }

  // --- set class on dropdown menu for icon
  $(".extruder.right .flap").hover( 
  	 function () {
      	$(this).addClass('on-hover');
      },
      function () {
      	$(this).removeClass('on-hover');
      }
  );
  
}

/** Function to check width of Extruder and resize content accordingly */
function checkWidth() {
var panelWidth = $(".text").width();
  if( panelWidth > 275 ) {
      $(".extruder-content").css("width","100%");
    } else
  if( panelWidth <= 275 ) {
      $(".extruder-content").css("width","100% !important");
    }
}

/** 
 * 
 * Initialize Fancy tree in fly out 
 * 
 * 		API call examples: 
 * 			Get a node: var node = $.ui.fancytree.getNode(el);
 *      Activate a node: node.setActive(true); // Performs activate action too
 *      Show a node: node.makeVisible(); // Opens tree to node and scrolls to it without performing action
 **/

function fancytreeInit() {
	
  // Facet Tree in Search Flyout
  var divs = $(ShantiSettings.ftListSelector).parent();
  
  divs.each(function() {
  	// Find the container div for the fancy tree
  	var facettype = $(this).children('ul').attr('id').split('-').pop();
  	$(this).attr('id', facettype + '-facet-content-div');
  	
  	// Initiate the Fancy Tree
  	var tree = $(this).fancytree({
	  	activeVisible: true, // Make sure, active nodes are visible (expanded).
	    aria: false, // Enable WAI-ARIA support.
	    autoActivate: true, // Automatically activate a node when it is focused (using keys).
	    autoCollapse: false, // Automatically collapse all siblings, when a node is expanded.
	    autoScroll: true, // Automatically scroll nodes into visible area.
	    activate: function(event, data) {
	    	var node = data.node;
	    	//console.info(node.data);
	    	loadFacetSearch(node.data);
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
	    idPrefix: "ftid", // Used to generate node id´s like <span id='fancytree-id-<key>'>.
	    icons: true, // Display node icons.
	    keyboard: true, // Support keyboard navigation.
	    keyPathSeparator: "/", // Used by node.getKeyPath() and tree.loadKeyPath().
	    minExpandLevel: 1, // 1: root node is not collapsible
	    selectMode: 2, // 1:single, 2:multi, 3:multi-hier
	    tabbable: true, // Whole tree behaves as one single control
	    titlesTabbable: false, // Node titles can receive keyboard focus
	  });
  });
  
  // Set facet link title attributes on mouseover
  $('ul.fancytree-container').on('mouseover', 'span.fancytree-title', function() {
  	if($(this).find('span.element-invisible').length == 1) {
  		var title = $(this).find('span.element-invisible').text();
  		$(this).attr('title', title);
  		$(this).find('span.element-invisible').remove();
  	}
  });
  
  // Initiate Facet Label Search Toggles
  $('div.block-facetapi').on('click', 'button.toggle-facet-label-search', function(e) {
  	if($(this).prev('input').is(':hidden')) {
  		$(this).prev('input').slideDown({duration: 400, queue: false}).animate({ width: '50%', queue: false });
  		e.preventDefault();
  	} else {
  		$(this).prev('input').animate({ width: '0%', queue: false }).slideUp({duration: 400, queue: false});
  		e.preventDefault();
  	}
  });
	
	// When text is entered into the facet label filter box perform a filter
  $('div.block-facetapi').on('keyup', 'input.facet-label-search', function (e) {
  	var sval = $(this).val();
	  var tree = $(this).parents('div.block-facetapi').find('div.content').fancytree('getTree');
	  // If sval is a number search for facet by id
  	if(!isNaN(sval)) {
  		tree.applyFilter(function (node) {
  			if(node.data.fid == sval) {
  				return true;
  			}
  			return false;
  		})
  	// Search for string if over 2 chars long
  	} else if(sval.length > 2) {
  		$('span.fancytree-title mark').each(
          function () {
          	var parent = $(this).parent()
          	var children = parent.children('.facet-count, .element-invisible').remove();
            parent.text(parent.text());
            parent.append(children);
          }
      );
  		tree.applyFilter(sval);
  		$('span.fancytree-title').highlight(sval, { element: 'mark' });
  	// if sval is empty clear filter
  	} else if(sval.length == 0) {
  		tree.clearFacetFilter();
  	}
  });
  
  // Activate the remove facet links
  var ret = $('div.block-facetapi').on('click', 'i.icon.km-cancel', function() {
  	console.log('clicked');
  	var tree = $(this).parents('ul.ui-fancytree').parents('div.content').fancytree('getTree');
  	var nodeId = $(this).parents('li').eq(0).attr('id').replace('ftid','');
  	var node = tree.getNodeByKey(nodeId);
  	tree.clearFilter();
  	node.setSelected(false);
  	loadFacetSearch({ 'fname' : node.data.fname, 'fid': 'clear'});
  	$(this).remove();
  	//console.log(tree, nodeId, node.data);
  });
}

function miscInit() {
	// *** GLOBAL ** conditional IE message
  // show-hide the IE message for older browsers
  // this could be improved with conditional for - lte IE7 - so it does not self-hide
  $(".progressive").delay( 2000 ).slideDown( 400 ).delay( 5000 ).slideUp( 400 );
}

function loadFacetSearch(fdata) {
	// fdata structure: {href: "/homepage?f[0]=im_field_subcollection%3A5", fname: "im_field_subcollection", fid: 5} 
	var fname = fdata.fname;
	var fid = fdata.fid
	var dataurl = '/services/facet/' + fname + '/' + fid;
	$.ajax({
		url: dataurl,
		beforeSend: function() {
			$('article.main-content section.content-section').html('<p><i class="fa fa-spinner fa-spin"></i> Loading ...</p>');
		}
	}).done(function(json) {
		$('article.main-content section.content-section').html(json.html);
		if(fid != 'clear') {
			var facets = new Array();
			for (var fn in json.facets) {
				var facet =json.facets[fn];
				facets[facet.fid] = facet.count;
			}
			var ulclass = 'ul.facetapi-facet-' + fdata.fname.replace(/\_/g,'-');
			var tree = $(ulclass).parent('div.content').fancytree('getTree');
			tree.applyFilter(function(node) {
				if(node.data.fid in facets) {
					var ctel = $(node.li).find('.facet-count').eq(0);
					if(ctel) {
						ctel.html(facets[node.data.fid] + "<!--" + ctel.text() + "-->");
						if(node.data.fid == fid) {
							ctel.parent().after(' <i class="icon km-cancel" title="Remove this facet"></i>');
						}
					}
					return true;
				}
				return false;
			});
		}
		console.info({'ulclass': ulclass, 'tree':tree, 'fdata':fdata, 'data':json});
	});
}

