<?php

/**
 * @file
 * template.php
 */
 
/**
 * Implements hook_theme
 *    Registers carousel theme function
 */
function shanti_sarvaka_theme() {
  $items = array(
    'carousel' => array(
      'render element' => 'element',
    ),
  );
  return $items;
}

/**
 * PREPROCESS FUNCTIONS
 */
 
/*
 * Implements hook_preprocess
 * Add theme_path to all templates
 */
function shanti_sarvaka_preprocess(&$variables) {
  global $base_url, $base_path;
  $base = $base_url . $base_path . drupal_get_path('theme', 'shanti_sarvaka') . '/';
  $variables['base_color'] = theme_get_setting('shanti_sarvaka_base_color');
  $variables['breadcrumb'] = menu_get_active_breadcrumb();
  $variables['breadcrumb'][] = ($variables['is_front'])? 'Home' : drupal_get_title();
  $variables['default_title'] = theme_get_setting('shanti_sarvaka_default_title');
  $variables['home_url'] = url(variable_get('site_frontpage', 'node'));
  $variables['icon_class'] = theme_get_setting('shanti_sarvaka_icon_class');
  $variables['site_slogan'] = (theme_get_setting('toggle_slogan') ? filter_xss_admin(variable_get('site_slogan', '')) : '');
  $variables['theme_path'] =$base; 
  $variables['shanti_site'] = theme_get_setting('shanti_sarvaka_shanti_site');
  // Add to Header variables for favicons and MS settings
  $elements = array(
    'favicon-main' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon.ico', 
        'rel' => 'shortcut icon',
      ),
    ),
    'favicon-16-32-64' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon.ico', 
        'rel' => 'icon',
        'size' => '16x16 32x32 64x64',
      ),
    ),
    'favicon-196' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-196.png', 
        'rel' => 'icon',
        'size' => '196x196',
        'type' => 'image/png',
      ),
    ),
    'favicon-160' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-160.png', 
        'rel' => 'icon',
        'size' => '160x160',
        'type' => 'image/png',
      ),
    ),
    'favicon-96' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-96.png', 
        'rel' => 'icon',
        'size' => '96x96',
        'type' => 'image/png',
      ),
    ),
    'favicon-64' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-64.png', 
        'rel' => 'icon',
        'size' => '64x64',
        'type' => 'image/png',
      ),
    ),
    'favicon-32' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-32.png', 
        'rel' => 'icon',
        'size' => '32x32',
        'type' => 'image/png',
      ),
    ),
    'favicon-16' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-16.png', 
        'rel' => 'icon',
        'size' => '16x16',
        'type' => 'image/png',
      ),
    ),
    'favicon-152' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-152.png', 
        'rel' => 'apple-touch-icon',
        'size' => '152x152',
      ),
    ),
    'favicon-144' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-144.png', 
        'rel' => 'apple-touch-icon',
        'size' => '144x144',
      ),
    ),
    'favicon-120' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-120.png', 
        'rel' => 'apple-touch-icon',
        'size' => '120x120',
      ),
    ),
    'favicon-114' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-114.png', 
        'rel' => 'apple-touch-icon',
        'size' => '114x114',
      ),
    ),
    'favicon-76' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-76.png', 
        'rel' => 'apple-touch-icon',
        'size' => '76x76',
      ),
    ),
    'favicon-72' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-72.png', 
        'rel' => 'apple-touch-icon',
        'size' => '72x72',
        'type' => 'image/png',
      ),
    ),
    'favicon-57' => array(
      '#tag' => 'link', 
      '#attributes' => array( 
        'href' => $base . 'images/favicons/favicon-57.png', 
        'rel' => 'apple-touch-icon',
      ),
    ),
    'ms-tile-color' => array(
      '#tag' => 'meta', 
      '#attributes' => array( 
        'name' => 'msapplication-TileColor', 
        'content' => '#FFFFFF',
      ),
    ),
    'ms-tile-image' => array(
      '#tag' => 'meta', 
      '#attributes' => array( 
        'name' => 'msapplication-TileImage', 
        'content' => $base . 'images/favicons/favicon-144.png',
      ),
    ),
    'ms-config' => array(
      '#tag' => 'meta', 
      '#attributes' => array( 
        'name' => 'msapplication-config', 
        'content' => $base . 'images/favicons/browserconfig.xml',
      ),
    ),
  );
  foreach($elements as $n => $el) {
    drupal_add_html_head($el, $n);
  }
}

function shanti_sarvaka_preprocess_html(&$variables) {
	//dpm($variables, 'in html preproc');
}

function shanti_sarvaka_preprocess_page(&$variables) {
  //dpm($variables, 'page vars');
  // Figure out bootstrap column classes
  $variables['bsclass_sb1'] = ($variables['page']['sidebar_first']) ? 'col-sm-3' : '';
  $variables['bsclass_sb2'] = ($variables['page']['sidebar_second']) ? 'col-sm-3' : '';
  $variables['bsclass_main'] = 'col-sm-6';
  if(!$variables['bsclass_sb1'] && !$variables['bsclass_sb2']) {
    $variables['bsclass_main'] = 'col-xs-12'; 
  } elseif (!$variables['bsclass_sb1'] || !$variables['bsclass_sb2']) {
    $variables['bsclass_main'] = 'col-sm-9'; 
  }
	// Add has_tabs var
	$variables['has_tabs'] = (!empty($variables['tabs']['#primary'])) ? TRUE : FALSE;
	
  // Add usermenu to main menu
  $um = menu_tree_all_data('user-menu');
  $variables['user_menu_links']  = shanti_sarvaka_create_user_menu($um);
  
  // Set Loginout_link
  $variables['loginout_link'] = l(t('Logout'), 'user/logout');
  if(!$variables['logged_in']) {
    if(module_exists('shib_auth')) {
      $variables['loginout_link'] = l(t('Login'), shib_auth_generate_login_url());
    } else {
      $variables['loginout_link'] = l(t('Login'), 'user');
    }
  }
  // If explore menu module installed set variables for its markup
  if(module_exists('explore_menu')) {
    $variables['explore_menu_link'] = variable_get('explore_link_text', EXPLORE_LINK_TEXT);
    $variables['explore_menu'] = menu_tree('shanti-explore-menu');
  }
  // Preload and render the language switcher to include in header (in page template)
  if(module_exists('locale')) {
    $data = module_invoke('locale', 'block_view', 'language');
    $block = block_load('locale', 'language');
    shanti_sarvaka_block_view_locale_language_alter($data, $block);
    $variables['language_switcher'] = '<li class="dropdown lang highlight" id="block-locale-language">  
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>' . $variables['language']->native . 
        '</span><i class="icon shanticon-arrowselect"></i></a>' . $data['content'] . '</li>';
  }
  
  /**
   * Add Custom CSS with Theme Setting for Site's Default/Base Color. These include:
   * 
   *        .basebg =  Set the background to theme's color
   *        .basecolor = Set Font color to theme's color
   *        ul.ss-full-tabs>li.active>a:after = Sets the color of the triangle under ss-full-tabs (bootstrap tabs)
   *        i.thumbtype = Sets the color for the the thumbnail type icon in the upper right corner of gallery thumbnails (deprecated)
   * 
   */
  drupal_add_css('.basebg { background-color: ' . $variables['base_color'] . '!important; } ' .
                 '.basecolor { color: ' . $variables['base_color'] . '!important; }  ' . 
                 ' ul.ss-full-tabs>li.active>a:after {
                    border-color: rgba(' . hex2rgb($variables['base_color']) . ', 0) !important;
                    border-top-color: ' . $variables['base_color'] . ' !important;
                    border-width: 15px !important;
                    margin-left: -15px !important; 
                  }  i.thumbtype { background-color: rgba(' . hex2rgb($variables['base_color']) . ', 0.8) !important; }', array(
                      'type' => 'inline',
                      'preprocess' => FALSE,
                    ));
}

function shanti_sarvaka_preprocess_node(&$variables) {
  //dpm($variables, 'in node preprocess');
  $variables['date'] = Date('j M Y', $variables['node']->created);
}

function shanti_sarvaka_preprocess_region(&$variables) {
  switch ($variables['region']) {
    case 'sidebar_second':
      //dpm($variables, '2nd side vars');
      
      break;
      
    case 'search_flyout':
      $elements = $variables['elements'];
      // Separate out search block "element" from others to display it in a different part of the flyout region template
      $variables['other_elements'] = array();
      foreach($elements as $n => $el) {
        if($n == 'search_form') {
          $variables['search_form'] = $variables['elements']['search_form'];
        } else if (substr($n, 0, 1) != '#') { // Elements without a # in the name are blocks added to the region
          array_push($variables['other_elements'], $variables['elements'][$n]);
        }
      }
      unset($variables['elements']['search_form']);
      break;
  }
}

function shanti_sarvaka_preprocess_block(&$variables) {
  $block = $variables['block'];
  // Header blocks
  // If needed, for site custom blocks added to header, can customize icon, bootstrap class, and wrapping markup
  // If we want to allow certain blocks to be "dropped" into the header and not just hard-coded like explore, language chooser, and options
  // Otherwise delete
  if(isset($block->region) && $block->region == 'header') {
    $variables['bs_class'] = '';
    $variables['follow_markup'] = '';
    $variables['icon_class'] = 'shanticon-menu';
    $variables['prev_markup'] = '';
  }
}

/**
 * Implements hook_form_alter: to alter search block
 */
function shanti_sarvaka_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
//  	dpm($form,'form in alter of theme');
  	$form['actions']['submit']['#attributes'] = array("class" => array("btn", "btn-default"));
		$form['actions']['submit']['#value'] = 'search-icon';
		/*$form['fieldset'] = array(
			'#type' => 'fieldset',
			'#collapsible' => FALSE,
		);
		$form['fieldset']['searchgroup'] = array(
			'#type' => 'markup',
			'#prefix' => '<div class="">',
			'#suffix' => '</div>',
		);
		$form['fieldset']['searchgroup']['search_block_form'] = $form['search_block_form'];
		unset($form['search_block_form']);
		$form['fieldset']['searchgroup']['search_block_form']['#prefix'] = '<div class="input-group">';
		$form['fieldset']['searchgroup']['search_block_form']['#suffix'] = '</div>';*/
	}
}
/**
* Changes the search form to use the "search" input element of HTML5.
*
function shanti_sarvaka_preprocess_search_block_form(&$variables) {
  //dpm($variables, 'vars in preprocess search block');
	dpm($variables, 'vars in search block form');
}*/

/*
function shanti_sarvaka_preprocess_search_results(&$variables) {
  dpm($variables, 'vars34');
}*/

function shanti_sarvaka_preprocess_search_result(&$variables) {
  global $base_path;
  $nid = '';
  if(isset($variables['result']['node'])) {
    $nid = $variables['result']['node']->entity_id;
    $coll = get_collection_ancestor_node($nid);
    if($coll) {
        $coll->url = $base_path . drupal_get_path_alias('node/' . $coll->nid);
    }
    $variables['coll'] = $coll;
  } else if (isset($variables['result']['fields']['is_eid'])) {
    // TODO: Must add thumbnail and collection variables for TCU hits in transcripts
    $nid = $variables['result']['fields']['is_eid'];
    $variables['result']['thumb_url'] ='';
    $variables['coll'] = FALSE;
  } else {
    // Any other options?
    //dpm($variables);
  }
}

/**
 * Implements theme_preprocess_image_style
 */
function shanti_sarvaka_preprocess_image_style(&$vars) {
  $vars['attributes']['class'][] = 'img-responsive'; // can be 'img-rounded', 'img-circle', or 'img-thumbnail'
}

/**
 * Modify buttons so they have Bootstrap style .btn classess with BEM syntax for variations
 *
 */
function shanti_sarvaka_preprocess_button(&$vars) {
	$element = &$vars['element'];
	//if($vars['element']['#value'] == "Search") {  dpm($vars, 'vars in preprocess button'); }
	if(!isset($element['#attributes']['class']) || (is_array($element['#attributes']['class']) && !in_array('btn', $element['#attributes']['class']))) {
	  $element['#attributes']['class'][] = 'btn';
	  $element['#attributes']['class'][] = 'btn-primary';
	  $element['#attributes']['class'][] = 'btn-lg';
	}
	if(!empty($element['#button_type'])) {
  	$element['#attributes']['class'][] = 'form-' . $element['#button_type'];
	}
  //$element['#attributes']['type'] = 'submit'; // Why am I making all buttons submit?
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
}
  
/**
 * THEMING FUNCTIONS
 */
 
 /**
  * Implements THEME_item_list to theme the facet links within a facetapi block
  */
function shanti_sarvaka_item_list($variables) {
  // if it's a normal list return normal html
  if(gettype($variables['items'][0]) == 'string' && strpos($variables['items'][0], 'facetapi-link') == -1) {
   return theme_item_list($variables);
  }
  
  // Otherwise return list with out <div class="list-items">
  //dpm($variables, 'variables in facet list');
  $items = $variables['items'];
  $title = $variables['title'];
  $type = $variables['type'];
  $attributes = $variables['attributes'];
  // Only output the list container and title, if there are any list items.
  // Check to see whether the block title exists before adding a header.
  // Empty headers are not semantic and present accessibility challenges.
  $output = '';
  if (isset($title) && $title !== '') {
    $output .= '<h3>' . $title . '</h3>';
  }

  if (!empty($items)) {
    $output .= "<$type" . drupal_attributes($attributes) . '>';
    $num_items = count($items);
    $i = 0;
    foreach ($items as $item) {
      $attributes = array();
      $children = array();
      $data = '';
      $i++;
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        // Render nested list.
        $data .= shanti_sarvaka_item_list(array('items' => $children, 'title' => 'mb-solr-facet-tree', 'type' => $type, 'attributes' => $attributes));
      }
      if ($i == 1) {
        $attributes['class'][] = 'first';
      }
      if ($i == $num_items) {
        $attributes['class'][] = 'last';
      }
      $output .= '<li' . drupal_attributes($attributes) . '>' . $data . "</li>\n";
    }
    $output .= "</$type>";
  }
  $output .= '';
  return $output;
}

/**
 * Implements theme_block_view_locale_language_alter
 */
function shanti_sarvaka_block_view_locale_language_alter(&$data, $block) {
  //dpm(array($data, $block));
  global $language;  // Currently chosen language
  $currentCode = $language->language; // ISO 2 letter code
  $currentName = $language->native; 
  $languages = language_list(); // List of all enabled languages
  $markup = '<ul class="dropdown-menu">';
  $n = 0;
  foreach($languages as $lang) {
    $n++;
    $checked = ($lang->language == $currentCode) ? 'checked="checked"' : '';
    $markup .= '<li class="form-group"><label class="radio-inline" for="optionlang' . $n . '">
                    <input type="radio" name="radios" id="optionlang' . $n . '" class="optionlang" value="lang:' . $lang->prefix . '" ' . $checked . ' />' .
                   $lang->native  . '</label></li>'; //
  }
  $markup .= '</ul>';
  $data['content'] = $markup;
}

/** Explore Menu Theme Functions works with Shanti Explore Menu Module**/
function shanti_sarvaka_menu_tree__shanti_explore_menu($variables) {
  if(module_exists('explore_menu')) {
    $html = '<section class="' 
              . variable_get('explore_section_class', EXPLORE_SECTION_CLASS) . '"><nav class="row" role="navigation"> ' 
              . '<div class="' . variable_get('explore_div_class', EXPLORE_DIV_CLASS) . '"> <h4>' 
              . variable_get('explore_div_title', EXPLORE_DIV_TITLE) . '</h4>' 
              . '<div class="shanti-collections"><ul>'
              . $variables['tree'] . '</ul></div></div><button class="close"> <i class="icon shanticon-cancel"></i> </button></nav></section>';
    return $html;
  }
}

/** Themes Links for Shanti Explore Menu calls module to get icon class */
function shanti_sarvaka_menu_link__shanti_explore_menu($variables) {
  $href = $variables['element']['#href'];
  $title = $variables['element']['#title'];
  $class = explore_menu_get_iconclass($title);
  return '<li><a href="' . $href . '"><i class="icon shanticon-' . $class . '"></i>' . $title . '</a></li>';
}

/** 
 * Update user menu tree with properly nested account and log in/out links. Then create markup
 * Called from shanti_sarvaka_preprocess_page
 */
function shanti_sarvaka_create_user_menu($um) {
  // Filter out existing Account links
  $um = array_filter($um, function($item) use (&$um) {
    $k = array_search($item, $um);
    if($k && preg_match('/(my|user) account/', strtolower($k))) {
      return false;
    } else {
      return true;
    }
  });
  // Filter out any links with "My" in it to put in Account submenu
  $mylinks = array_filter($um, function($item) use (&$um) {
		$k = array_search($item, $um);
		if($k && preg_match('/my\s/', strtolower($k)))  {
			return true;		
		} else {
			return false;		
		}
  });
  foreach($mylinks as $k => $item) {
	unset($um[$k]);  
  }
  
  // If not logged in, do login link (logout link can be added to user menu at bottom and will show only when logged in)
  if(user_is_anonymous()) {
    // Determine whether login is via password or shibboleth and create login link accordingly
    $loginlink = url('user');
    if(module_exists('shib_auth')) {
      $loginlink = shib_auth_generate_login_url();
    }
    // Add login link to bottom of links array
    $um[] = array(
      'link' => array(
        'title' => t('Log in'),
        'href' => $loginlink,
      ),
      'below' => array(),
    );
    
  // if logged in show account submenu at top of list
  } else {
    // Add preferences menu
    if(module_exists('user_prefs')) {
      $pfarray = array(
        'html' => user_prefs_form(),
      );
      array_unshift($um, $pfarray);
    }
    // Add theme custom ones
    $acctarray = array(
      'link' => array(
        'title' => t('My Account'),
        'href' => '#',
        
      ),
      'below' => array(
          'profile' => array(
            'link' => array(
              'title' => t('Profile'),
              'href' => url('user'),
            ),
            'below' => array(),
          ),
          'logout' => array(
            'link' => array(
              'title' => t('Log out'),
              'href' => url('user/logout'),
            ),
            'below' => array(),
          ),
        ),
    );
    // Add in any links with "My" in the title under account menu
    $myarray = array();
    foreach($mylinks as $n => $link) {
		$myarray[$n] = array(
		   'link' => array( 
				'title'	=> $link['link']['title'],
				'href' => $link['link']['href'],	
			),
			'below' => array(),
		) ; 
    }
    array_splice($acctarray['below'], 1, 0, $myarray);
    array_unshift($um, $acctarray);
  }
  return shanti_sarvaka_user_menu($um, TRUE);
}

/**
 * Function to create markup for responsive main menu from Drupal's user menu
 */
function shanti_sarvaka_user_menu($links, $toplevel = FALSE) {
  $html = '<ul>';
  if($toplevel) {
  $html .= '<li><h3><em>Main Menu</em></h3> 
          <a class="link-blocker"></a>
       </li>';
  } 
  foreach($links as $n => $link) {
    if(isset($link['html'])) {
      $html .= $link['html'];
      continue;
    }
    $url = $link['link']['href'];
    if(is_array($link['below']) && count($link['below']) > 0) { $url = '#'; }
    $target = (substr($url, 0, 4) != 'http') ? '': ' target="_blank"';
    $linkhtml = '<li><a href="' . $url . '"' . $target . '>' . $link['link']['title'] . '</a>';
    if(is_array($link['below']) && count($link['below']) > 0) {
    	$linkhtml .= '<h2>' . $link['link']['title'] . '</h2>';
      $linkhtml .= shanti_sarvaka_user_menu($link['below']);
    }
    $linkhtml .= '</li>';
    $html .= $linkhtml;   
  }
  
  $html .= '</ul>';
  return $html;
}

/**
 * Implements hook_carousel, custom theme function for carousels defined above in hook_theme
 * Element array has child called "slides". Each slide has the following variables:
 *    nid
 *    title
 *    author
 *    date
 *    link
 *    path
 *    summary
 *    img
 *    itemcount
 *    
 */
function shanti_sarvaka_carousel($variables) {
  $el = $variables['element'];
  $html = '<div class="container-fluid carouseldiv">
      <div class="row">
        <div class="col-md-12">
      
          <div class="header">
              <p><span class="title">' . $el['title'] . '</span>
              <span class="link show-more">' . $el['link'] . '</span></p>
          </div>
              
          <div class="carousel slide row" id="collection-carousel">
              <div class="carousel-inner">';
  foreach($el['slides'] as $n => $slide) {
    $active = ($n == 0) ? 'active' : '';
    $html .= '<!-- Slide' . $n . ' --> 
      <div class="item ' . $active . '">
        <div class="caption col-md-7">
          <div class="title"><h3><a href="' . $slide['path'] . '"><i class="icon shanticon-stack"></i> ' . $slide['title'] . '</a></h3></div>   
          <div class="byline"> ' . $slide['author'] . ', ' . $slide['date'] . ', ' . $slide['itemcount'] . '</div>               
          <div class="description">' . $slide['summary'] . '</div>
          <div class="link show-more"><a class="" href="' . $slide['path'] . '">' . t('View Collection') . ' </a></div>
        </div>                 
        <div class="bannerImage col-md-5">
            <a href="' . $slide['path'] . '"><img src="' . $slide['img'] . '" alt=""></a>
        </div>                
     </div><!-- /Slide' . $n . ' --> ';
  }
  $html .= '</div>
              <div class="control-box">                            
                  <a data-slide="prev" href="#collection-carousel" class="carousel-control left basebg"><i class="icon"></i></a>
                  <a data-slide="next" href="#collection-carousel" class="carousel-control right basebg"><i class="icon"></i></a>
              </div><!-- /.control-box -->   
            </div><!-- /#collection-carousel -->
        </div><!-- /.span12 -->          
        </div><!-- /.row --> 
        </div><!-- /.container -->';
  return $html;
}

/** 
 * Fieldset Groups: Markup collapsible fieldsets according to Bootstrap 
 *     non-collapsible fieldsets get formatted per core 
 **/
function shanti_sarvaka_fieldset($variables) {
  $element = $variables['element'];
 /* if(strpos($element['#title'], 'Access') > -1)  {
    dpm($element);
  }*/
  // If not collapsible or no title for heading then just format as normal field set
  if( empty($element['#collapsible']) || empty($element['#title']) ) {
    return theme_fieldset($variables);
  }
  
  // Set icon and status classes 
  $openclass = (isset($element['#collapsed']) && $element['#collapsed']) ? "" : " in";
  $icon = (isset($element['#collapsed']) && $element['#collapsed']) ? "+" : "-";
  $iconclass = (isset($element['#collapsed']) && $element['#collapsed']) ? "" : " open";
  
  // Set attribute values
  $id = (isset($element['#id'])) ? $element['#id'] : uniqid('mb');
  if(!isset($element['#attributes']['class']) || !is_array($element['#attributes']['class'])) {
    $element['#attributes']['class'] = array();
  }
  $element['#attributes']['class'] = array_merge($element['#attributes']['class'], array('field-accordion', 'panel-group'));
  $element['#attributes']['id'] = 'accordion' . $id;
  
  // Create markup
  $output = '<div ' . drupal_attributes($element['#attributes']) . '> 
  <div class="panel panel-default">
    <div class="panel-heading">
      <h6 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#' . $id . '">'        	
           . $element['#title'] .
        '</a>
      </h6>
    </div>
    <div id="' . $id . '" class="panel-collapse collapse' . $openclass . '">
      <div class="panel-body">';
   $output .= $element['#children'];
    if (isset($element['#value'])) {
      $output .= $element['#value'];
    }
   $output .= '</div></div></div></div>';
   return $output;
}

/**
 * Theme Form for Search block form
 */
 /*
function shanti_sarvaka_form($variables) {
	$element = $variables['element'];
	if($element['#form_id'] == 'search_block_form') {
		dpm($variables, 'vars in form');
		$variables['theme_hook_suggestions'][] = 'search-block';
	}
	return theme_form($variables);
}
*/
/**
 * Theme buttons to use Bootstrap Markup
 */

function shanti_sarvaka_button($variables) {
  $element = $variables['element'];
  $text = $element['#value'];
  $icon = '';
	if($text == 'search-icon') {
		$text = ''; 
		$icon = '<i class="icon"></i>';
	} else {
		$text = '<span>' . $text . '</span>';
	}
  if(strpos(strtolower($text), 'video') > 0) {
    $icon = '<i class="icon shanticon-video"></i> ';
  } else if(strpos(strtolower($text), 'audio') > 0) {
    $icon = '<i class="icon shanticon-audio"></i> ';
  } else if(strpos(strtolower($text), 'collection') > 0) {
    $icon = '<i class="icon shanticon-texts"></i> ';
  } 
  element_set_attributes($element, array('id', 'name', 'value'));

  return '<button' . drupal_attributes($element['#attributes']) . ' >' . $icon . $text . '</button>';
}

function shanti_sarvaka_submit($variables) {
	dpm($variables, 'vars in submit button');
}

function shanti_sarvaka_password($variables) {
  //dpm($variables, 'vars in password');
  $element = $variables['element'];
  $element['#attributes']['type'] = 'password';
  if(!empty($element['#title'])) {
    $element['#attributes']['placeholder'] = t('Enter @title', array('@title' => $element['#title']));
  }
  element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
  _form_set_class($element, array('form-control'));

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

function shanti_sarvaka_select($variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'form-control';
  $element['#attributes']['class'][] = 'form-select';
  $element['#attributes']['class'][] = 'ss-select';
  $element['#attributes']['class'][] = 'selectpicker';
  element_set_attributes($element, array('id', 'name', 'size'));

  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}

function shanti_sarvaka_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  if(!empty($element['#title'])) {
    $element['#attributes']['placeholder'] = t('Enter @title', array('@title' => $element['#title']));
  }
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
  _form_set_class($element, array('form-control', 'form-text'));

  $extra = '';
  if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }

  $output = '<input' . drupal_attributes($element['#attributes']) . ' />';

  return $output . $extra;
}

/**
 * MISCELLANEOUS HOOKS AND FUNCTIONS
 */
/**
 * Implements HOOK_breadcrumbs
 * Customizes output of breadcrumbs
 */
function shanti_sarvaka_get_breadcrumbs($variables) {
  global $base_url;
  
  $breadcrumbs = is_array($variables['breadcrumb']) ? $variables['breadcrumb'] : array();
  $output = '<ol class="breadcrumb">';
  if(!$variables['is_front']) {
    $breadcrumbs[0] = '<a href="' . $base_url . '">' . theme_get_setting('shanti_sarvaka_breadcrumb_intro') . '</a>';
  } 
  foreach($breadcrumbs as $crumb) {
    $output .= '<li>' . $crumb . '</li>';
  }
    
  $output .= '</ol>';
  return $output;
}

/** Theme Facet Counts for JS **/
function shanti_sarvaka_facetapi_count($variables) {
  return '<span class="facet-count">' . (int) $variables['count'] . '</span>';
}

/**
 * Implements theme_pagerer_mini to replace text links with icons
 * 
 */
function shanti_sarvaka_pagerer_mini($variables) {
  $variables['tags']['first'] = "FIRST_HERE";
  $variables['tags']['previous'] = "PREVIOUS_HERE";
  $variables['tags']['next'] = "NEXT_HERE";
  $variables['tags']['last'] = "LAST_HERE";
  $html = _pagerer_theme_handler('pagerer_mini', $variables);
  $html = str_replace('FIRST_HERE','<i class="icon"></i>', $html);
  $html = str_replace('PREVIOUS_HERE','<i class="icon"></i>', $html);
  $html = str_replace('NEXT_HERE','<i class="icon"></i>', $html);
  $html = str_replace('LAST_HERE','<i class="icon"></i>', $html);
  return $html;
}

/** Miscellaneous functions **/

function hex2rgb($hex) {
  // From http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
