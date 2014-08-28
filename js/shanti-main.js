(function ($) {
	/** 
	 * Taken from Kmaps Aardvark Site
	 * Adapted to Shanti Sarvaka Mediabase by Than Grove (beginning 2014-05-22)
	 **/
	var ShantiSettings = {
	     kmapsUrl: "http://subjects.kmaps.virginia.edu",
	     mmsUrl: "http://mms.thlib.org",
	     placesUrl: "http://places.kmaps.virginia.edu",
	     ftListSelector: "ul.facetapi-mb-solr-facet-tree, ul.fancy-tree", // should change "mb-solr" to "fancy" for universality
	     fancytrees: [],
	     flyoutWidth: 310,
	};
	
	/**
	 * Extend Fancy Tree
	 * 	Adds clearFacetFilter function
	 */
	
	;(function($, undefined) {
	
	// Consider to use [strict mode](http://ejohn.org/blog/ecmascript-5-strict-mode-json-and-more/)
	"use strict";
		
		$.ui.fancytree._FancytreeClass.prototype.clearFacetFilter = function() {
			var tree = this,
				treeOptions = tree.options;
			// "unwrap" the <mark>ed text
	    tree.$div.eq(0).find('span.fancytree-title mark').each(
	        function () {
	          var parent = $(this).parent();
	        	var children = parent.children().remove(); // took out children selector: '.facet-count, .element-invisible'
	          parent.text(parent.text());
	          parent.append(children);
	        }
	    );
			if (tree.activeNode) {
	        tree.activeNode.setActive(false);
	    }
	    tree.clearFilter();
	    tree.rootNode.visit(function (node) {
	    	  $(node.li).find('span.facet-count').text(node.data.count);
	        //node.setExpanded(false);
	    });
		};
	// End of namespace closure
	} (jQuery));
	
	// Behaviors for the theme
	Drupal.behaviors.shantiSarvaka = {
	  attach: function (context, settings) {
			//var h = $('div.region-sidebar-second').height();
	  }
	};

	// Initialization of UI components on page on load
	jQuery(function($) {
		createTopLink();
		iCheckInit();
		menuInit();
		responsiveMenusInit();
		mbExtruderInit();
		searchInit();
		//setSearchTabHeight();
		fancytreeInit();
		miscInit();
		checkWidth();
		carouselInit();
	});
	
	// *** CONTENT *** top link
	function createTopLink() {
	  var offset = 420;
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
	
	// Initialize the top bar menus
	function menuInit() {
		// Rearrange the button divs so that they are in the order blocks are added with a float-right css
		var buttons = $('div.navbar-buttons ul.navbar-right').detach();
		buttons.each(function() {
			$('div.navbar-buttons').prepend($(this));
		});
		// Initialize the multilevel main menu
		$( '#menu' ).multilevelpushmenu({
			menuWidth: 250,
			menuHeight: '32em', // this height is determined by tallest menu, Preferences
			mode: 'cover',
			direction: 'rtl',
			backItemIcon: 'fa fa-angle-left',
			groupIcon: 'fa fa-angle-right',
			collapsed: false,
			preventItemClick: false,
	  });

	  // --- align the text
	  $('#menu ul>li, #menu h2').css('text-align','left');
	  $('#menu ul>li.levelHolderClass.rtl').css('text-align','right');
	
	
	  // --- close the menu on outside click except button
	  $('.menu-toggle').click( function(event){
	      event.stopPropagation();
	      $('#menu').toggle(50);
	      $('.menu-toggle').toggleClass('show-topmenu');
	      $('.collections').slideUp(200);
	      $('.menu-exploretoggle').removeClass('show-topmenu');
	   });
	
		// --- close the menu on outside click except button
	  $('.menu-exploretoggle').click( function(event){
	      event.stopPropagation();
	      $('.collections').slideUp(200);
	  });
	    
	  $(document).click( function(){
	      $('.menu-toggle').removeClass('show-topmenu');
	      $('#menu').hide(100);
	  });  
	        
	  /* Initialize Language Buttons */
	  // Language Chooser Functionality with ICheck
	  $('body').on('ifChecked', 'input.optionlang', function() {
			var newLang = $(this).val().replace('lang:','');
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
	
	// Initialize the responsive menus with mbExtruder
	function responsiveMenusInit() {
			
	  $("#menu-main").buildMbExtruder({
	      positionFixed: false,
	      position: "right",
	      width: 280,      
	      hidePanelsOnClose:false,
	      accordionPanels:false,
	      onExtOpen:function(){ $(".menu-main").metisMenu({ toggle: false });  },
	      onExtContentLoad:function(){ 
	      /*
	      	$("input[type='radio']").each(function () {
						var self = $(this),
	          label = self.next(),
	          label_text = label.text();
						label.remove();
						self.iCheck({
		          // checkboxClass: "icheckbox_minimal-red",
		          radioClass: "iradio_minimal-red",
		          insert: "<div class='icheck_line-icon'></div>" + label_text
						});
					});*/
	      	
	      },
	      onExtClose:function(){},
	      top: 0
	  }); 
	  $("#menu-collections").buildMbExtruder({
	      positionFixed: false,
	      position: "right",
	      width:280, // width is set in two places, here and the css
	      hidePanelsOnClose:false,
	      accordionPanels:false,
	      onExtOpen:function(){ $(".menu-main").metisMenu({ toggle: false }); },
	      onExtContentLoad:function(){  },
	      onExtClose:function(){},
	      top: 0
	  });	
		// this is for the responsive button
	  $(".shanti-searchtoggle").click(function () {   
	      if($("#kmaps-search.extruder").hasClass("isOpened")){   
	        $("#kmaps-search").closeMbExtruder();
	        $(".shanti-searchtoggle").removeClass("show-topmenu");        
	      } else {      
	        $("#menu-main").closeMbExtruder();
	        $("#menu-collections").closeMbExtruder();
	        $("#kmaps-search").openMbExtruder();
	        $(".shanti-searchtoggle").addClass("show-topmenu");
	        $(".menu-maintoggle,.menu-exploretoggle").removeClass("show-topmenu");
	        // $("#menu-main").load("./menus-ajax.html");        
	        // $(".menu-collections-wrap .accordion-toggle").addClass("collapsed");
	        // $(".menu-collections-wrap .panel-collapse").removeClass("in").css('height','0');
	        return false;
	      }
	  });   
	  $('body').on('click','.menu-maintoggle',function(){   
	      if($("#menu-main.extruder").hasClass("isOpened")){    
	        $("#menu-main").closeMbExtruder();
	        $(".menu-maintoggle").removeClass("show-topmenu");     
	      } else {     
	        $("#menu-main").openMbExtruder();
	        $("#kmaps-search").closeMbExtruder();
	        $("#menu-collections").closeMbExtruder();
	        $(".menu-commons, .menu-preferences, .menu-collections").css('display','block');
	        
	        $(".menu-commons").addClass("active");
	        
	        $(".menu-collections").removeClass("active");
	        $(".menu-collections > ul").removeClass("in");
	        
	        // $("#menu-main").load("/menus-ajax.html #menu-accordion");
	        $(".menu-maintoggle").addClass("show-topmenu");
	        $(".menu-exploretoggle, .shanti-searchtoggle").removeClass("show-topmenu");
	        return false;
	      }
	  });
	  $(".menu-exploretoggle").click(function () {   
	      if($("#menu-collections.extruder").hasClass("isOpened")){   
	        
	        $("#menu-collections").closeMbExtruder();
	        $(".menu-exploretoggle").removeClass("show-topmenu");
	        // $(".bottom-trim").remove();                
	      } else {        
	        $(".menu-commons, .menu-preferences").css('display','none');
	        $(".menu-collections").css('display','block');
	        
	        $(".menu-collections").addClass("active");
	        $(".menu-collections > ul").addClass("in");
	        
	        $("#menu-collections").openMbExtruder();
	        $("#menu-main").closeMbExtruder();        
	        $("#kmaps-search").closeMbExtruder();
	        
	        $(".menu-exploretoggle").addClass("show-topmenu");  
	        $(".menu-maintoggle,.shanti-searchtoggle").removeClass("show-topmenu");    
	        
	        // $(".menu-collections").find("ul").append("<li class='bottom-trim'></li>");  
	        return false;
	      }
	  });   
	   
		// --- ajax call for collections list
		// $( "#kmaps-collections").load( "/sites/all/themes/shanti_theme/js/menus/menu-ajax.php .menu-collections > ul");  	
		//	   $('body').on('click','.explore>a, .closecollections',function(){
		//	       $(".collections").slideToggle(200);      
		//	   });
	    
	}
	// Initialize iCheck form graphics
	function iCheckInit() {
		
	  $("input[type='checkbox'], input[type='radio']").each(function () {
	      var self = $(this),
	          label = self.next('label');
	   		if(label.length == 1) {
	     		self = $(this).detach();
	     		label.prepend(self);
	     	}
	      self.icheck({
	          checkboxClass: "icheckbox_minimal-red",
	          radioClass: "iradio_minimal-red",
	          insert: "<div class='icheck_line-icon'></div>"
	      });
	  });
	  $(".selectpicker").selectpicker({
		  dropupAuto: false
	  }); // initiates jq-bootstrap-select
	
	}
	
	
	
	/* Initialize Extruder search fly-out */
	function mbExtruderInit() {
		var mywidth = ShantiSettings.flyoutWidth;
	  $(".input-section, .view-section, .view-section .nav-tabs>li>a").css("display","block"); // show hidden containers after loading to prevent content flash
		
		// Initialize Search Flyout
	  $("#gen-search").buildMbExtruder({
	      positionFixed: false,
	      position: "right",
	      closeOnExternalClick:false,
	      closeOnClick:false,
	      width: mywidth, // width is set in two places, here and the css
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
	        $(".flap").click( function() {
	          $(".extruder .text").css("width","100%");
	        });
	          // styles inline for now, forces
	        $(".flap").prepend("<span style='font-size:21px; position:absolute; left:17px; top:12px; z-index:10;'><i class='icon shanticon-search'></i></span>");
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
		    	$('i.icon.shanticon-cancel').remove(); // remove existing cancel icons
		    	loadFacetSearch(node.data);
		    	searchTabHeight();
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
	  	ShantiSettings.fancytrees.push($(tree).fancytree('getTree'));
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
	  		});
	  	// Search for string if over 2 chars long
	  	} else if(sval.length > 2) {
	  		$('span.fancytree-title mark').each(
	          function () {
	          	var parent = $(this).parent();
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
	  $('div.block-facetapi').on('click', 'i.icon.shanticon-cancel', function() {
	  	//console.log('clicked');
	  	var tree = $(this).parents('ul.ui-fancytree').parents('div.content').fancytree('getTree');
	  	var nodeId = $(this).parents('li').eq(0).attr('id').replace('ftid','');
	  	var node = tree.getNodeByKey(nodeId);
	  	tree.clearFacetFilter();
	  	//node.setActive(true);
	  	node.setExpanded(true);
	  	node.setSelected(false);
	  	//$(node.span).removeClass('fancytree-active fancytree-focused fancytree-selected');
	  	$('article.main-content section.content-section').html($('#original-content').html());
	  	$('#original-content').remove();
	  	$(this).remove();
	  	//console.log(tree, nodeId, node.data);
	  });
	}
	 
	function miscInit() {
		// *** GLOBAL ** conditional IE message
	  // show-hide the IE message for older browsers
	  // this could be improved with conditional for - lte IE7 - so it does not self-hide
	  $(".progressive").delay( 2000 ).slideDown( 400 ).delay( 5000 ).slideUp( 400 );
	  $('div#sidebar-second').height($('div#sidebar-second').parent().height()); // set the sidebar heigth
	  // Change collapsible div icon from +/- depending on state
	  $('div.panel-collapse').on('hide.bs.collapse', function () {
		  $(this).prev('div.panel-heading').find('.ss-fieldset-toggle').text('+');
		  $(this).prev('div.panel-heading').find('.ss-fieldset-toggle').removeClass('open');
		});
		$('div.panel-collapse').on('show.bs.collapse', function () {
		  $(this).prev('div.panel-heading').find('.ss-fieldset-toggle').text('-');
		  $(this).prev('div.panel-heading').find('.ss-fieldset-toggle').addClass('open');
		});
		
		// Add class and event handler to bootstrap tabs for formatting
		$('ul.ss-full-tabs li.active a[data-toggle="tab"]').addClass('basebg');
		$('ul.ss-full-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
			var el = e.target;
			$(el).parents('ul.ss-full-tabs').find('.basebg').each(function() {
				$(this).removeClass('basebg');
			});
			$(el).addClass('basebg');
		});
		// Turn dev menu in admin footer into select
		if($('#admin-footer #block-menu-devel ul.menu').length > 0) { 
			var devmenu = $('#admin-footer #block-menu-devel ul.menu').clone();
			$('#admin-footer #block-menu-devel ul.menu').replaceWith('<select class="devmenu"></select>');
			var sel = $('#block-menu-devel select.devmenu');
			sel.append('<option>Choose an option...</option>');
			$.each(devmenu.children('li'), function() {
				var opt = $('<option>' + $(this).text() + '</option>').attr('value', $(this).find('a').attr('href'));
				sel.append(opt);
			});
			sel.change(function() { window.location.pathname = $(this).val(); });
		}
		// Adjust height of blocks in admin footer
		$('#admin-footer div.block').each(function() {
			$(this).height($(this).parent().height());
		});
	}
	
	function loadFacetSearch(fdata) {
		// fdata structure: {href: "/homepage?f[0]=im_field_subcollection%3A5", fname: "im_field_subcollection", fid: 5} 
		var fname = fdata.fname;
		var fid = fdata.fid;
		var dataurl = '/services/facet/' + fname + '/' + fid;
		$.ajax({
			url: dataurl,
			beforeSend: function() {
				if($('article.main-content #original-content').length == 0) {
					$('article.main-content').append('<div id="original-content" style="display:none; width: 0px; height: 0px;"></div>');
					$('#original-content').html($('article.main-content section.content-section').html());
				}
				$('article.main-content section.content-section').html('<div class="loader"><i class="fa fa-spinner fa-spin"></i> Loading ...</div>');
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
							//node.data.originalcount = ctel.text(); // a data field that store original count for facet
							ctel.html(facets[node.data.fid]);
							if(node.data.fid == fid) {
								ctel.parent().after(' <i class="icon shanticon-cancel" title="Remove this facet"></i>');
							}
						}
						return true;
					}
					return false;
				});
				
				var title = $('section.content-section div.content h3:first-child').detach();
				$('h1.page-title span').text(title.text());
			}
			//console.info({'ulclass': ulclass, 'tree':tree, 'fdata':fdata, 'data':json});
		});
	}
	
	// *** SEARCH *** Initialization
	function searchInit() {
		// Handle Search form Submit
		$('#gen-search form button#searchbutton').click(function() { $(this).parents('form').eq(0).submit(); });
		$('#gen-search form').on('submit', function(event) {
			// TODO: Implement Ajax searching
			// In order to implement Ajax searching need to use hash to create unique bookmarks. Check out Jquery BBQ (though tis old).
			// See doAjaxSearch function below => partial implementation
			//doAjaxSearch($(this).find('input[type=text]').val(), $(this).find('input[name=srchscope]').val());
			event.preventDefault();
			window.location.pathname = '/search/' + $(this).find('input[name=srchscope]').val() + '/' + $(this).find('input[type=text]').val();
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
	
	}

// *** SEARCH *** adapt search panel height to viewport
  function searchTabHeight() {
    var height = $(window).height();
    var srchtab = (height) - 80;
    var viewheight = (height) -  211;
		// var advHeight = $(".advanced-view").show().height();
    var comboHeight = (viewheight) - 126;
    
    srchtab = parseInt(srchtab) + 'px';
    $("#gen-search").find(".text").css('height',srchtab);
    
    viewheight = parseInt(viewheight) + 'px';
    comboHeight = parseInt(comboHeight) + 'px';
    $(".view-wrap").css('height', viewheight);
		$(".view-wrap.short-wrap").css('height', comboHeight);            
  } 
	 	
	function doAjaxSearch(qstr, type) {
		var surl = '/services/ajaxsearch';
		$.ajax({
			url: surl,
			data: {'query': qstr, 'type': type},
			dataType: 'json',
			beforeSend: function() {
				if($('article.main-content #original-content').length == 0) {
					$('article.main-content').append('<div id="original-content" style="display:none; width: 0px; height: 0px;"></div>');
					$('#original-content').html($('article.main-content section.content-section').html());
				}
				$('article.main-content section.content-section').html('<div class="loader"><i class="fa fa-spinner fa-spin"></i> Loading ...</div>');
			},
			success: function(json) {
				$('article.main-content section.content-section').html(json.html);
			}
		});
	}
	
	function carouselInit() {
		// Carousel Auto-Cycle
    $('.carousel').carousel({
      interval: 8000,
    });
	}
	
}(jQuery));



jQuery(function ($) {
  if($('ul.tabs.primary').length ) {
    $('.main-content').addClass('has-tabs');
  }


//	$('.shanti-thumbnail-link').hover( function() {
//	      $(this).prev('.shanti-thumbnail').addClass('active-link');
//	      },
//	        function () {
//	      $(this).prev('.shanti-thumbnail').removeClass('active-link');
//	      }
//	 );


	// *** CONTENT *** hide responsive column for resources
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active');
  });
  
  //$('.advanced-view').css('display','block');
  
  // $('fieldset.container-inline').removeClass('container-inline');
  
  $('.shanti-thumbnail').unwrap();
  $('.shanti-thumbnail').find('a:eq(1)').addClass('icon-link');
});



/* testing toggle on accordions */
jQuery(function ($) {
    var $active = $('.panel-group .panel-collapse.in').prev().addClass('active');
    
    $active.find('a').prepend('<i class="glyphicon glyphicon-minus"></i>');
    
    $('.panel-group .panel-heading').not($active).find('a').prepend('<i class="glyphicon glyphicon-plus"></i>');
    
    $('.panel-group').on('show.bs.collapse', function (e) {
        $('.panel-group .panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
        $(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
    });
    
    $('.panel-group').on('hide.bs.collapse', function (e) {
        $(this).find('.panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
    });
});
 
 
 
 


jQuery(function ($) {
	var myElement = document.getElementById('.carousel.slide');
	if(myElement) {
		// create a simple instance
		// by default, it only adds horizontal recognizers
		var mc = new Hammer(myElement);
		
		// let the pan gesture support all directions.
		// this will block the vertical scrolling on a touch-device while on the element
		mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
		
		// listen to events...
		mc.on("panleft panright panup pandown tap press", function(ev) {
		    myElement.textContent = ev.type +" gesture detected.";
		});
	} 
});

