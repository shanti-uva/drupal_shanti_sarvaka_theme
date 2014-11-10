(function ($) {
  /**
   *  Settings for the theme
   */
  Drupal.behaviors.shanti_sarvaka = {
    attach: function (context, settings) {
      // Initialize settings.
      settings.shanti_sarvaka = $.extend({
        kmapsUrl: "http://subjects.kmaps.virginia.edu",
        mmsUrl: "http://mms.thlib.org",
        placesUrl: "http://places.kmaps.virginia.edu",
        ftListSelector: "ul.facetapi-mb-solr-facet-tree, ul.fancy-tree", // should change "mb-solr" to "fancy" for universality
        fancytrees: [],
        flyoutWidth: 310,
        topLinkOffset: 420,
        topLinkDuration: 500,
      }, settings.shanti_sarvaka || {});
    }
  };

  /**
   * Back to Top Link functionality
   */
  Drupal.behaviors.shanti_sarvaka_toplink = {
    attach: function (context, settings) {
      var offset = settings.shanti_sarvaka.topLinkOffset;
      var duration = settings.shanti_sarvaka.topLinkDuration;
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
  };

  /**
   * ICheck init
   */
  Drupal.behaviors.shanti_sarvaka_icheck = {
    attach: function (context, settings) {
      $("input[type='checkbox'], input[type='radio']").each(function () {
        var self = $(this),
        label = self.next('label');
        if(label.length == 1) {
          self = $(this).detach();
          label.prepend(self);
        }
        if(typeof(self.icheck) != "undefined") {
          self.icheck({
            checkboxClass: "icheckbox_minimal-red",
            radioClass: "iradio_minimal-red",
            insert: "<div class='icheck_line-icon'></div>"
          });
        }
      });
    }
  };

  /**
   * Select Picker
   */
  Drupal.behaviors.shanti_sarvaka_select = {
    attach: function (context, settings) {
      $(".selectpicker:not(#search-flyout .selectpicker)").selectpicker({
        dropupAuto: false
      }); // initiates jq-bootstrap-select
    }
  };

  /**
   * Multi Level Push Menu
   */
  Drupal.behaviors.shanti_sarvaka_mlpmenu = {
    attach: function (context, settings) {
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
  };

  /**
   * Responsive Menus with MbExtruder
   */
  Drupal.behaviors.shanti_sarvaka_respmenu = {
    attach: function (context, settings) {
      $("#menu-main").buildMbExtruder({
        positionFixed: false,
        position: "right",
        width: 280,
        hidePanelsOnClose:false,
        accordionPanels:false,
        onExtOpen:function(){ $(".menu-main").metisMenu({ toggle: false });  },
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
          if($("#search-flyout.extruder").hasClass("isOpened")){
            $("#search-flyout").closeMbExtruder();
            $(".shanti-searchtoggle").removeClass("show-topmenu");
          } else {
            $("#menu-main").closeMbExtruder();
            $("#menu-collections").closeMbExtruder();
            $("#search-flyout").openMbExtruder();
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
            $("#search-flyout").closeMbExtruder();
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
            $("#search-flyout").closeMbExtruder();

            $(".menu-exploretoggle").addClass("show-topmenu");
            $(".menu-maintoggle,.shanti-searchtoggle").removeClass("show-topmenu");

            // $(".menu-collections").find("ul").append("<li class='bottom-trim'></li>");
            return false;
          }
      });
    }
  };

  /**
   * Fancy Tree Init
   *
   * Initialize Fancy tree in fly out
   *
   *     API call examples:
   *       Get a node: var node = $.ui.fancytree.getNode(el);
   *      Activate a node: node.setActive(true); // Performs activate action too
   *      Show a node: node.makeVisible(); // Opens tree to node and scrolls to it without performing action
   **/
  Drupal.behaviors.shanti_sarvaka_fancytree = {
    attach: function (context, settings) {
      // Facet Tree in Search Flyout
      var divs = $(Drupal.settings.shanti_sarvaka.ftListSelector).parent();

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
        Drupal.settings.shanti_sarvaka.fancytrees.push($(tree).fancytree('getTree'));
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
  };

  /**
   * Popovers Init
   */
  Drupal.behaviors.shanti_sarvaka_popovers = {
    attach: function (context, settings) {
      $.fn.popover.Constructor.DEFAULTS.trigger = 'hover';
      $.fn.popover.Constructor.DEFAULTS.placement = 'right';
      $.fn.popover.Constructor.DEFAULTS.html = true;
      $.fn.popover.Constructor.DEFAULTS.delay = { "show": 100, "hide": 60000 };
      $.fn.popover.Constructor.DEFAULTS.template = '<div class="popover related-resources-popover" role="tooltip"><div class="arrow"></div><h5 class="popover-title"></h5><div class="popover-content"></div></div>';

      $('span.popover-link').each(function() {
        var content = $(this).next('div.popover').html();
        var title = $(this).next('div.popover').attr('data-title');
        $(this).popover({'title': title, 'content': content});
      });
      $('div.popover').remove(); // remove hidden popover content once they have all been initialized
      $('span.popover-link').on('show.bs.popover', function(){ $('div.popover').hide();}); // When popover is shown, hide all others
       // Hide popovers if anything but a popover is clicked
       $('body').click(function(e) {
          var target = $(e.target);
          if(target.parents('div.popover').length == 0 && !target.hasClass('popover')) {
            $('div.popover').hide();
          }
       });
    }
  };

  /**
   * Miscellaneous Init
   */
  Drupal.behaviors.shanti_sarvaka_miscinit = {
    attach: function (context, settings) {
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

      // NOTE: mark commented this out since other css is need to set custom color on these tabs, like the pointer arrow - 11/5/2014
      // Add class and event handler to bootstrap tabs for formatting
      // $('ul.ss-full-tabs li.active a[data-toggle="tab"]').addClass('basebg');
      // $('ul.ss-full-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
      //   var el = e.target;
      //   $(el).parents('ul.ss-full-tabs').find('.basebg').each(function() {
      //     $(this).removeClass('basebg');
      //   });
      //   $(el).addClass('basebg');
      // });

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

      // Collapse/Expand All Buttons For Bootstrap Collapsible Divs
      // Assumes Buttons are in a child div that is a sibling of the collapsible divs.
      $('div.expcoll-btns button').click(function() {
        var divs = $(this).parent().parent().find('div.collapse');
        if($(this).hasClass('expand')) {
          $(divs).addClass('in');
        } else {
          $(divs).removeClass('in');
        }
      });

      // call Check Width
      checkWidth();

      // Carousel Init and controls
      $('.carousel').carousel({
        interval: 6000,
      });
      $('.carousel .control-box-2 .carousel-pause').click(function () {
          var carousel = $(this).parents('.carousel');
          if($(this).hasClass('paused')) {
            carousel.carousel('next');
            carousel.carousel('cycle');
          } else {
            carousel.carousel('pause');
          }
          $(this).toggleClass('paused');
          $(this).find('i').toggleClass('glyphicon-pause glyphicon-play');
      });
    }
  };

  /**
   * Gallery: Initialize a gallery of images
   */
  Drupal.behaviors.shanti_sarvaka_galleryinit = {
    attach: function (context, settings) {
      $('.shanti-gallery').imagesLoaded(function() {
          // Prepare layout options.
          var options = {
            itemWidth: 160, // Optional min width of a grid item
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $('.shanti-gallery'), // Optional, used for some extra CSS styling
            offset: 15, // Optional, the distance between grid items
            outerOffset: 10, // Optional the distance from grid to parent
            flexibleWidth: '30%' // Optional, the maximum width of a grid item
          };

          // Get a reference to your grid items.
          var handler = $('.shanti-gallery li');

          var $window = $(window);
          $window.resize(function() {
            var windowWidth = $window.width(),
                newOptions = { flexibleWidth: '30%' };

            // Breakpoint
            if (windowWidth < 1024) {
              newOptions.flexibleWidth = '100%';
            }

            handler.wookmark(newOptions);
          });

          // Call the layout function.
          handler.wookmark(options);
      });
    }
  };

  /**
   * Accordion Init: only called on document load
   */
  Drupal.behaviors.shanti_sarvaka_accordion = {
    attach: function (context, settings) {

      if(context == window.document) {

        /* Select only accordions not in vertical tabs */
  			var accorddivs = $('.panel-group').not($('.vertical-tabs-panes .panel-group'));
        var $active = accorddivs.find('.panel-collapse.in').prev().addClass('active');

        $active.find('a').prepend('<i class="glyphicon glyphicon-minus"></i>');

        accorddivs.find('.panel-heading').once('expgylph').not($active).find('a').prepend('<i class="glyphicon glyphicon-plus"></i>');

        accorddivs.on('show.bs.collapse', function (e) {
  					var accorddivs = $('.panel-group').not($('.vertical-tabs-panes .panel-group'));
            accorddivs.find('.panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
            $(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
        });

        accorddivs.on('hide.bs.collapse', function (e) {
            $(this).find('.panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
        });

        /* toggle icon on accordions */
        $('.btn-toggle-accordion').click(function () {

          $(this).toggleClass('expand');

          if($('.btn-toggle-accordion').hasClass('expand')) {

              $(this).text('Expand All');
              $('.panel-collapse').collapse('hide');
              $('.panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
            } else {
              $(this).text('Collapse All');
              $('.panel-collapse').collapse('show');
              $('.panel-heading').addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
          }
        });

        // Open first accordion if none opened
        if($(".collapsible.in").length == 0) {
          $(".collapsible").eq(0).find('h6.panel-title a').once("openfirst").click();

        }
        // Shiva site gets doubly glypicons. So need to be removed
        $(".glyphicon-plus + .glyphicon-plus, .glyphicon-minus + .glyphicon-minus").remove();
      }
    }
  };

  /**
   * Other: All of below if from Mark's separate Jquery() functions
   */
  Drupal.behaviors.shanti_sarvaka_otherinit = {
    attach: function (context, settings) {
      $('.shanti-field-group-audience > div').find('a:eq(1)').addClass('icon-link');

      $('.shanti-field-title a').hover( function() {
            $(this).closest('.shanti-thumbnail').addClass('title-hover');
            },
              function () {
            $(this).closest('.shanti-thumbnail').removeClass('title-hover');
            }
       );

      // $('table.sticky-header').css('width','100%');

      // if($('.node-video').length ){
      //       $('.shanti-gallery').imagesLoaded();
      // });
      //-------

      // hide responsive column for resources
      $('[data-toggle=offcanvas]').click(function () {
        $('.row-offcanvas').toggleClass('active');
      });

      // IE10 viewport hack for Surface/desktop Windows 8 bug http://getbootstrap.com/getting-started/#support-ie10-width
      (function () {
        'use strict';
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
          var msViewportStyle = document.createElement('style');
          msViewportStyle.appendChild(
            document.createTextNode(
              '@-ms-viewport{width:auto!important}'
            )
          );
          document.querySelector('head').appendChild(msViewportStyle);
        }
      })();
      //----

      /*
      $('.ss-full-tabs > .rel-video').on('click', function () {
        $.imagesLoaded();
      });*/
      //----

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
    }
  };

  // *** Common Functions for Shanti Sarvaka ***
  /** Function to check width of Extruder and resize content accordingly */
  checkWidth = function() {
  var panelWidth = $(".text").width();
    if( panelWidth > 275 ) {
        $(".extruder-content").css("width","100%");
      } else
    if( panelWidth <= 275 ) {
        $(".extruder-content").css("width","100% !important");
      }
  };


  // *** SEARCH *** adapt search panel height to viewport
  searchTabHeight = function() {
    var height = $(window).height();
    var srchtab = (height) - 80;
    var viewheight = (height) -  211;
    // var advHeight = $(".advanced-view").show().height();
    var comboHeight = (viewheight) - 126;

    srchtab = parseInt(srchtab) + 'px';
    $("#search-flyout").find(".text").css('height',srchtab);

    viewheight = parseInt(viewheight) + 'px';
    comboHeight = parseInt(comboHeight) + 'px';
    $(".view-wrap").css('height', viewheight);
    $(".view-wrap.short-wrap").css('height', comboHeight);
  } ;

  doAjaxSearch = function(qstr, type) {
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
  };


  /**
   * Format numbers with ssfmtnum class
   */
  Drupal.behaviors.shanti_sarvaka_format_numbers = {
    attach: function (context, settings) {
      $('.ssfmtnum').each(function() {
      	if($(this).text().indexOf(',') == -1) {
      		var txt = $(this).text(),
      				len = txt.length,
      				i = len - 1,
      				fmtnum = '';
      		while(i >= 0) {
		        fmtnum = txt.charAt(i) + fmtnum;
		        if ((len - i) % 3 === 0 && i > 0) {
		        	fmtnum = "," + fmtnum;
		        }
		        --i;
			    }
			    $(this).text(fmtnum);
      	}
      });
    }
  };

}(jQuery));


