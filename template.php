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
    'info_popover' => array(
			'variables' => array(
				'label' => '',
				'desc' => '',
				'tree' => array(),
				'links' => '',
			),
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
  //$variables['base_color'] = theme_get_setting('shanti_sarvaka_base_color');
}

function shanti_sarvaka_preprocess_html(&$variables) {
	global $base_url, $base_path;
	//dpm($variables, 'vars in html');
	$site_class = theme_get_setting('shanti_sarvaka_site_body_tag');
	$variables['classes_array'][] =  $site_class;
	$base = $base_url;
    $variables['modernizer'] = '<script type="text/javascript" src="' . $base . '/sites/all/themes/shanti_sarvaka/js/inc/other/modernizr-2.6.2.min.js?njzbwq"></script>';
	// Add Meta Tags
	$metas = array(
		'ie_edge' => array(
			'#type' => 'html_tag',
			'#tag' => 'meta',
			'#attributes' => array(
				'http-equiv' => 'X-UA-Compatible',
				'content' => 'IE=edge',
			),
			'#weight' => -999, // meta content type UTF-8 is weight: -1000. This puts the tag just after that
		),
		'viewport' => array(
			'#type' => 'html_tag',
			'#tag' => 'meta',
			'#name' => 'viewport',
			'#attributes' => array(
				'name' => 'viewport',
				'content' => 'width=device-width, initial-scale=1',
			),
			'#weight' => -998,
		),
	);

	foreach($metas as $key => $details) {
		drupal_add_html_head($details, $key);
	}

  drupal_add_library('system', 'ui');

	_shanti_sarvaka_add_metatags(); // Adds favicon meta tags (Did say: NOT needed automatically picked up by device, but was this me? ndg, 2015-07-15)
	// Adding Bootstrap CDN Resoures
	drupal_add_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', array('type' => 'external', 'group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -100));
	drupal_add_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css', array('type' => 'external', 'group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -99));
	drupal_add_js('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('type' => 'external', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -100));
	//$path = drupal_get_path('theme','shanti_sarvaka') . '/js/inc/other/modernizr-2.6.2.min.js';
	//drupal_add_js($path);
	//drupal_add_js(drupal_get_path('theme','shanti_sarvaka') . '/js/inc/other/modernizr-2.6.2.min.js',  array('type' => 'file', 'scope' => 'header', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -99));
}

function shanti_sarvaka_preprocess_page(&$variables) {
	//dpm($variables, 'vars in preprocess page');
  global $base_url, $base_path, $base_theme_info;
  $base = $base_path . drupal_get_path('theme', 'shanti_sarvaka') . '/'; // took out $base_url .  from beginning as not necessary, ndg (2019-09-22)
  $variables['breadcrumb'] = menu_get_active_breadcrumb();
  $variables['breadcrumb'][] = (!empty($variables['is_front']))? 'Home' : drupal_get_title();
  $variables['default_title'] = theme_get_setting('shanti_sarvaka_default_title');
  $variables['home_url'] = url(variable_get('site_frontpage', ''));
  $variables['icon_class'] = theme_get_setting('shanti_sarvaka_icon_class');
  $variables['theme_path'] = $base;
	$variables['base_theme'] = (empty($base_theme_info)) ? FALSE : $base_theme_info[0]->name;
	$variables['base_theme_path'] = (empty($base_theme_info)) ? FALSE : $base_path . 'sites/all/themes/' . $base_theme_info[0]->name . '/';
  $variables['shanti_site'] = theme_get_setting('shanti_sarvaka_shanti_site');
	$variables['use_admin_site_title'] = theme_get_setting('shanti_sarvaka_use_admin_site_title');
	$variables['prefix_default_title'] = theme_get_setting('shanti_sarvaka_prefix_default_title');
  // Figure out bootstrap column classes. Define class variables
  $variables['bsclass_main'] = $variables['bsclass_sb1'] = $variables['bsclass_sb2'] = '';
	// if both side columns exist
	if($variables['page']['sidebar_first'] && $variables['page']['sidebar_second']) {
  	$variables['bsclass_main'] = 'col-xs-12 col-md-8';
  	$variables['bsclass_sb1'] = $variables['bsclass_sb2'] = 'col-xs-12 col-md-3';
	// If first side column exists
	} else if ($variables['page']['sidebar_first']) {
  	$variables['bsclass_main'] = 'col-xs-12 col-md-9';
  	$variables['bsclass_sb1'] = 'col-xs-12 col-md-3';
		$variables['bsclass_sb2'] = '';
	// If second side column exists
	} else if ($variables['page']['sidebar_second']) {
  	$variables['bsclass_main'] = 'col-xs-12 col-md-9';
  	$variables['bsclass_sb1'] = '';
		$variables['bsclass_sb2'] = 'col-xs-12 col-md-3';
	}
	// If no side columns keep default all classes blank

	// Add has_tabs var
	$variables['has_tabs'] = (!empty($variables['tabs']['#primary'])) ? TRUE : FALSE;

	// Add menu blocks in banner to secondary tabs
	if(empty($variables['tabs']['#secondary'])) { $variables['tabs']['#secondary'] = array(); }
	$variables['tabs']['#secondary'] = array_merge($variables['tabs']['#secondary'], shanti_sarvaka_banner_tabs($variables['page']['banner']));

	// Set banner_class variable depending on whether there are tabs or not
	$variables['banner_class'] = (empty($variables['tabs']['#primary']) && empty($variables['tabs']['#secondary'])) ? '': ' has-tabs';
	//$variables['banner_class'] = ''; // uncomment this line to disable the has-tabs class on the banner

  //unset($variables['page']['banner']['menu_menu-color-bar-menu']);

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
  /*if(module_exists('explore_menu')) {
    $variables['explore_menu_link'] = variable_get('explore_link_text', EXPLORE_LINK_TEXT);
    $variables['explore_menu'] = menu_tree('shanti-explore-menu');
  }*/
  // Preload and render the language switcher to include in header (in page template)
  if(module_exists('locale')) {
    $data = module_invoke('locale', 'block_view', 'language');
    $block = block_load('locale', 'language');
    shanti_sarvaka_block_view_locale_language_alter($data, $block);
    $variables['language_switcher'] = '<li class="dropdown lang highlight" id="block-locale-language">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>' . $variables['language']->native .
        '</span><span class="icon shanticon-arrowselect"></span></a>' . $data['content'] . '</li>';
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
   /* Now should be set in childe theme css
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
	  */
}

function shanti_sarvaka_preprocess_node(&$variables) {
  //dpm($variables, 'in node preprocess');
  $variables['date'] = Date('j M Y', $variables['node']->created);
}

/** Unnecessary
function shanti_sarvaka_preprocess_region(&$variables) {
  switch ($variables['region']) {
    case 'sidebar_second':
      //dpm($variables, '2nd side vars');
      break;
    case 'search_flyout':
      break;
  }
}
*/

function shanti_sarvaka_preprocess_block(&$variables) {
  $block = $variables['block'];
	//dpm($variables, 'blcok vars');
	if(isset($block->region)) {
		$region = $block->region;
		// Header blocks
	  // If needed, for site custom blocks added to header, can customize icon, bootstrap class, and wrapping markup
	  // If we want to allow certain blocks to be "dropped" into the header and not just hard-coded like explore, language chooser, and options
	  // Otherwise delete
	  if($region == 'header') {
	    $variables['bs_class'] = '';
	    $variables['follow_markup'] = '';
	    $variables['icon_class'] = 'shanticon-menu';
	    $variables['prev_markup'] = '';
	  }
	}
	// Add enabled languages for language chooser block ($language == current lang; $languages = array of all enabled langs)
	if($variables['block_html_id'] == 'block-locale-language') {
		global $language;
		$variables['language'] = $language;
		$variables['languages'] = array();
		foreach(language_list() as $abbr => $lang) {
			if($lang->enabled == 1) {
				$variables['languages'][] = $lang;
			}
		}
	}
}


/**
 * Converts block menus in banner to secondary tab links
 */
function shanti_sarvaka_banner_tabs(&$banner) {
	$links = array();
	$menus = array();
	$current_path = current_path();
	// find menu blocks in banner and conver to secondary tab links
	foreach($banner as $itemnm => $item) {
		if($itemnm == 'system_navigation' || substr($itemnm, 0, 5) == 'menu_') {
			$menus[] = $itemnm;
			foreach($item as $n => $link) {
				if(is_numeric($n)) {
					$is_active = ($link['#original_link']['router_path'] == $current_path || ($link['#href'] == "<front>" && drupal_is_front_page())) ? TRUE : FALSE;
					//dpm($link, 'link');
					$linkout = array(
						'#theme' => 'menu_local_task',
						'#link' => array(
							'path' => $link['#original_link']['router_path'],
							'title' => $link['#title'],
							'href' => $link['#href'],
							'localized_options' => array(),
						),
						'#active' => $is_active,
					);
					$links[] = $linkout;
				}
			}
		}
	}
	// unset menu blocks in banner so they do display as regular blocks
	foreach($menus as $n => $menunm) {
		unset($banner[$menunm]);
	}
	return $links;
}

/**
 * Implements hook_html_head_alter
 */
function shanti_sarvaka_html_head_alter(&$head_elements) {
	//dpm($head_elements, 'head elements');
	$head_elements['system_meta_content_type']['#attributes'] = array('charset' => 'UTF-8') ; // recommended for HTML5
}

/**
 * Implements theme_html_tag for following reasons:
 * 		 1. remove closing slash from meta tags
 */
function shanti_sarvaka_html_tag($variables) {
	$element = $variables['element'];
	// remove closing / from meta tags.
	if($element['#tag'] == 'meta') {
		$html = theme_html_tag($variables);
		$html = str_replace('/>', '>', $html);
		return $html;
	} else {
		return theme_html_tag($variables);
	}
}

/**
 * Implements hook_form_alter: to alter search block
 */
function shanti_sarvaka_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
		$form['#prefix'] = '<section class="input-section" style="display:none;"> ';
		$form['#suffix'] = '</section>';
		$form['#attributes']['class'][] = 'form';
  	$form['actions']['submit']['#attributes'] = array("class" => array("btn", "btn-default"));
		$form['actions']['submit']['#value'] = ''; // This replaced by the icon code in shanti_sarvaka_button function
		$form['actions']['submit']['#icon'] = 'glyphicon-chevron-right';
	}
	if(in_array($form_id, array('video_node_form','audio_node_form'))) {
		$form['#groups']['group_media']->weight = -10;
		$form['group_audience']['#weight'] = -5;
		//dpm($form, 'a/v edit form');
	}
}


function shanti_sarvaka_preprocess_search_result(&$variables) {
  global $base_path;
  $nid = '';
  if(isset($variables['result']['node']->entity_id)) {
    $nid = $variables['result']['node']->entity_id;
    $coll = (function_exists('get_collection_ancestor_node')) ? get_collection_ancestor_node($nid) : FALSE;
    if($coll) {
        $coll->url = $base_path . drupal_get_path_alias('node/' . $coll->nid);
    }
    $variables['coll'] = $coll;
  } else if (isset($variables['result']['fields']['entity_type']) && $variables['result']['fields']['entity_type'] == 'tcu') {
    // TODO: Must add thumbnail and collection variables for TCU hits in transcripts
    $variables['result']['thumb_url'] ='';
    $variables['coll'] = FALSE;
    $variables['classes_array'][] = 'list-group-item';
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
 * Implements theme_preprocess_fieldset
 * 		Changes class from container-inline to container
 */
function shanti_sarvaka_preprocess_fieldset(&$vars) {
	if(!empty($vars['element']['#attributes']['class'])) {
		foreach($vars['element']['#attributes']['class'] as $n => &$cnm) {
			if($cnm == 'container-inline') {
				$cnm = 'container';
			}
		}
	}
}

/**
 * Implements preprocess field
 */
function shanti_sarvaka_preprocess_field(&$vars) {
	// Add <p> around text_long and replace newline characters with <p> markup
	if($vars['element']['#field_type'] == 'text_long') {
		foreach($vars['items'] as $n => &$item) {
			$emu = &$item['#markup'];
			$emu = '<p>' . $emu . '</p>';
			$emu = preg_replace('/\n/','</p><p>', $emu);
		}
	} elseif ($vars['element']['#field_type'] == 'image') {
		$vars['classes_array'][] = 'img-thumbnail';
		$vars['classes_array'][] = 'pull-left';
	}
}

/**
 * Modify buttons so they have Bootstrap style .btn classess with BEM syntax for variations
 *
 */
function shanti_sarvaka_preprocess_button(&$vars) {
	$btn_types = array('default', 'primary', 'info', 'success', 'warning', 'danger', 'link');
	$element = &$vars['element'];
	if(!isset($element['#attributes']['class']) || !is_array($element['#attributes']['class'])) {
		$element['#attributes']['class'] = array();
	}
  if(!in_array('btn', $element['#attributes']['class'])) {
	  $element['#attributes']['class'][] = 'btn';
	}
	// Check to see if it has any of the button classes already
	$hasBtnClass = FALSE;
	foreach($btn_types as $n => $type) {
		if(in_array('btn-' . $type, $element['#attributes']['class'])) { $hasBtnClass = TRUE; }
	}
	// If not, assign btn-primary to it
  if(!$hasBtnClass) {
	  $element['#attributes']['class'][] = 'btn-primary';
	}
	if(!empty($element['#button_type'])) {
  	$element['#attributes']['class'][] = 'form-' . $element['#button_type'];
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
  if(empty($variables['items'][0]) || (gettype($variables['items'][0]) == 'string' && strpos($variables['items'][0], 'facetapi-link') == -1)) {
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
              . '<div class="' . variable_get('explore_div_class', EXPLORE_DIV_CLASS) . '"> <h4 class="collections-title">'
              . variable_get('explore_div_title', EXPLORE_DIV_TITLE) . '</h4>'
              . '<div class="shanti-collections"><ul>'
              . $variables['tree'] . '</ul></div></div><button class="close"> <span class="icon shanticon-cancel"></span> </button></nav></section>';
    return $html;
  }
}

/** Themes Links for Shanti Explore Menu calls module to get icon class */
function shanti_sarvaka_menu_link__shanti_explore_menu($variables) {
  $href = $variables['element']['#href'];
  $title = $variables['element']['#title'];
  $class = explore_menu_get_iconclass($title);
	if(!empty($variables['element']['#attributes']['disabled'])) {
		return '<li><a href="#" class="disabled"><span class="icon shanticon-' . $class . '"></span>' . $title . '</a></li>';
	}
  $target = (strpos($href, 'wiki.shanti.virginia.edu') > -1) ? ' target="_blank"' : '';
	return '<li><a href="' . $href . '"' . $target . '><span class="icon shanticon-' . $class . '"></span>' . $title . '</a></li>';
}

/**
 * Update user menu tree with properly nested account and log in/out links. Then create markup
 * Called from shanti_sarvaka_preprocess_page
 */
function shanti_sarvaka_create_user_menu($um) {
	global $user;

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
	/*
  foreach($mylinks as $k => $item) {
		unset($um[$k]);
  }*/
  // If not logged in, do login link (logout link can be added to user menu at bottom and will show only when logged in)
  if(user_is_anonymous()) {
		// If show login link theme setting is checked then...
		if(theme_get_setting('shanti_sarvaka_show_login_link')) {
	    // Determine whether login is via password or shibboleth and create login link accordingly
	    $loginlink = 'user';
			$lisuff = '';
	    if(module_exists('shib_auth')) {
	      $loginlink = shib_auth_generate_login_url();
				$lisuff = t('via Netbadge');
	    }

	    // Add login link to bottom of links array
	    $um[] = array(
	      'link' => array(
	        'title' => t('Log in @suffix', array('@suffix' => $lisuff)),
	        'href' => $loginlink,
	      ),
	      'below' => array(),
	    );
		}

  // if logged in show account submenu at top of list
  } else {
  	$uname = '';
		$uname = (module_exists('realname')) ? realname_load($user) : $user->name;

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
        'title' => t('Account'),
        'href' => '#',

      ),
      'below' => array(
          'profile' => array(
            'link' => array(
              'title' => t('Profile'),
              'href' => 'user',
            ),
            'below' => array(),
          ),
          'logout' => array(
            'link' => array(
              'title' => t('Log out @name', array('@name' => $uname)),
              'href' => 'user/logout',
            ),
            'below' => array(),
          ),
        ),
    );
    // Add in any links with "My" in the title under account menu
    /*$myarray = array();
    foreach($mylinks as $n => $link) {
		$myarray[$n] = array(
		   'link' => array(
				'title'	=> $link['link']['title'],
				'href' => $link['link']['href'],
			),
			'below' => array(),
		) ;
    }*/
    //array_splice($acctarray['below'], 1, 0, $myarray);
    array_unshift($um, $acctarray);
		//array_unshift($um, $myarray);
  }
  return shanti_sarvaka_user_menu($um, TRUE);
}

/**
 * Function to create markup for responsive main menu from Drupal's user menu
 */
function shanti_sarvaka_user_menu($links, $toplevel = FALSE) {
	global $user;
	$uname = '';
	if(!user_is_anonymous()) {
		$uname = (module_exists('realname')) ? realname_load($user) : $user->name;
		foreach($links as $key => &$value) {
			if(strpos($key, 'Log out') > -1 && isset($value['link']['title'])) {
				$value['link']['title'] .= " $uname";
			}
		}
	}

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
    $url = url($link['link']['href']);
    if(is_array($link['below']) && count($link['below']) > 0) { $url = '#'; }
    $target = (substr($url, 0, 4) != 'http' || strpos($url, 'Shibboleth.sso') > -1) ? '': ' target="_blank"';
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
 * $variables['element'] = array(
 * 	'title' => 'title above carousel',
 * 	'link'  => 'link in upper right corner above carousel',
 *  'speed' => 'speed in seconds for the delay between slides. This number is multiplied by 1000 to get milliseconds',
 * 	'slides' => array(
 * 		'0' => array (
 * 			nid: Node ID
 *      title: title of node
 *      author: author of node
 *      date: date node created
 *      path: path linking to node
 *      summary: description
 *      img: url to a 400 x 300 resized/cropped image for src attribute
 *      itemcount: number of items contained, if a group (opt.)
 * 		),
 * 		etc...
 * 	)
 * );
 *
 *
 */
function shanti_sarvaka_carousel($variables) {
  $el = $variables['element'];
  $html = '<div class="container-fluid carouseldiv">
      <div class="row">
        <div class="col-xs-12">

          <div class="carousel-header show-more" data-ride="carousel"><span>' . $el['title'] . '</span>' . $el['link'] . '</div>

          <div class="carousel carousel-fade slide row" id="collection-carousel" data-speed="' . $el['speed'] . '">
              <div class="carousel-inner">';
  foreach($el['slides'] as $n => $slide) {
    $active = ($n == 0) ? 'active' : '';
		$itemcount = (!empty($slide['itemcount'])) ? ', ' . $slide['itemcount'] : '';
    $html .= '<!-- Slide' . $n . ' -->
      <div class="item ' . $active . '">
        <div class="carousel-main-content col-xs-12 col-sm-7 col-md-8">
          <div><h3 class="carousel-title"><a href="' . $slide['path'] . '"><span class="icon shanticon-stack"></span> ' . $slide['title'] . '</a></h3></div>
          <div class="byline"> ' . $slide['author'] . ', ' . $slide['date'] . $itemcount . '</div>
          <div class="carousel-description">' . $slide['summary'] . '</div>
          <p class="show-more h5"><a href="' . $slide['path'] . '">' . t('View Collection') . ' </a></p>
        </div>
        <div class="carousel-main-image col-xs-12 col-sm-5 col-md-4">
            <a href="' . $slide['path'] . '"><img src="' . $slide['img'] . '" alt=""></a>
        </div>
     </div><!-- /Slide' . $n . ' --> ';
  }
  $html .= '</div>
              <div class="control-box">
                  <a data-slide="prev" href="#collection-carousel" class="carousel-control left"><span class="icon"></span></a>
                  <a data-slide="next" href="#collection-carousel" class="carousel-control right"><span class="icon"></span></a>
              </div><!-- /.control-box -->

              <div class="control-box-2">
                  <button class="btn btn-default btn-sm carousel-pause"><span class="glyphicon glyphicon-pause"></span></button>
              </div><!-- /.control-box-2 -->
            </div><!-- /#collection-carousel -->
        </div><!-- /.span12 -->
        </div><!-- /.row -->
        </div><!-- /.container -->';
  return $html;
}

/**
 * Provides markup for the info popups from icons etc.
 * 	Variables:
 * 		- label 	(string) 	: Label shown and header of popover
 * 		- desc 		(string) 	: Description of item
 * 		- tree 		(array) 	: Ancestor tree of preformatted links: <a href="..">name</a>
 * 		- links 	(array) 	: Series of links to show in footer stripes
 */
function shanti_sarvaka_info_popover($variables) {
	$html = "<span>{$variables['label']}</span><span class=\"popover-link\"><span class=\"popover-link-tip\"></span><span class=\"icon shanticon-menu3\"></span></span>
						<div class=\"popover\" data-title=\"{$variables['label']}\">
							<div class=\"popover-body\">
							<div class=\"desc\">{$variables['desc']}</div>
							<div class=\"parents clearfix\"><p><strong>" . $variables['tree']['label']. "</strong>";

	foreach($variables['tree']['items'] as $n => $link) {
		$html .= "{$link}";
	}
	$html .= "</p></div></div><div class=\"popover-footer\">";
	foreach($variables['links'] as $label => $info) {
		$options = array('attributes' => array());
		if(!empty($info['external'])) { $options['attributes']['target'] = '_blank'; }
		$options['attributes']['class'] = "icon shanticon-{$info['icon']}";
		$html .= "<div class=\"popover-footer-button\">" . l($label, $info['href'], $options) . "</div>";
	}
	$html .= "</div></div>";
	return $html;
}


/**
 * Fieldset Groups: Markup collapsible fieldsets according to Bootstrap
 *     non-collapsible fieldsets get formatted per core
 **/
function shanti_sarvaka_fieldset($variables) {
	//dpm($variables, 'vars in fieldset');
  $element = $variables['element'];
	//dpm($element, 'element in fieldset preprocess');

  // If not collapsible or no title for heading then just format as normal field set
  // Additional settings are for vertical tabs
  if( empty($element['#collapsible']) || empty($element['#title']) ||
  		(isset($element['#group']) && $element['#group'] == 'additional_settings') ) {
    return theme_fieldset($variables);
  }

  // Set icon and status classes
  $openclass = (empty($element['#collapsed'])) ? "" : " in";
  //$icon = (isset($element['#collapsed']) && $element['#collapsed']) ? "+" : "-";
  $iconclass = (empty($element['#collapsed'])) ? "glyphicon-minus" : "glyphicon-plus";

  // Set attribute values
  $id = (isset($element['#id'])) ? $element['#id'] : uniqid('mb');
  if(!isset($element['#attributes']['class']) || !is_array($element['#attributes']['class'])) {
    $element['#attributes']['class'] = array();
  }

	foreach($element['#attributes']['class'] as $n => &$class) {
		if($class == 'container-inline') {
			$class = 'container';
		}
	}

  $element['#attributes']['class'] = array_merge($element['#attributes']['class'], array('field-accordion', 'panel', 'panel-default'));
  $element['#attributes']['id'] = 'accordion' . $id;
  $isin = '';
	if(!$element['#collapsed'] || $key = array_search("in", $element['#attributes']['class'])) {
		$isin = ' in';
	}
  // Create markup
  $output = '<div ' . drupal_attributes($element['#attributes']) . '>
    <div class="panel-heading">
      <h6>
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#av-details" href="#' . $id . '"><span class="glyphicon ' . $iconclass . '"></span>'
            . $element['#title'] .
        '</a>
      </h6>
    </div>
    <div id="' . $id . '" class="panel-collapse collapse">
      <div class="panel-body">';
   $output .= $element['#children'];
    if (isset($element['#value'])) {
      $output .= $element['#value'];
    }
   $output .= '</div></div></div>';
   return $output;
}

/**
 * Field theme functions
 */
function shanti_sarvaka_file_widget($variables) {
  $element = $variables['element'];
  $output = '';
	if(isset($element['remove_button'])) {
		$element['remove_button']['#icon'] = 'glyphicon-trash';
	}
	$filelink = "";
	if(!empty($element['filename'])) {
		// change file name to disabled input
		$element['filename']['#markup'] = '<input class="text-full form-control form-inline" placeholder="File Name" type="text" id="' . $element['#field_name'] . '_value" name="filename_display" disabled value="' .
		$element['#default_value']['filename'] . '" size="60" maxlength="255"> ';
		$filelink = '(<a href="' . file_create_url($element['#default_value']['uri']) . '" target="_blank">View File</a>) ';
	} else if (!empty($element['filefield_sources_list']['#markup'])){
		$markup = explode(' | ', $element['filefield_sources_list']['#markup']);
		if(count($markup) == 2) {
			$element['filefield_sources_list']['#markup'] = "<div class=\"filefield-sources-list\">" . $markup[1] . ' or ';
		}
	}
  // The "form-managed-file" class is required for proper Ajax functionality.
  $output .= '<div class="file-widget form-managed-file clearfix">';
  if ($element['fid']['#value'] != 0) {
    // Add the file size after the file name.
    $element['filename']['#markup'] .= ' <span class="file-size">(' . format_size($element['#file']->filesize) . ')</span> <span class="file-link">(<a href="' . file_create_url($element['#default_value']['uri']) . '" target="_blank">View File</a>)</span> ';
  }
  $output .= drupal_render_children($element);
  $output .= '</div>';
  //dpr(json_encode($element));
  return $output;
}


function shanti_sarvaka_file_managed_file($variables) {
  $element = $variables['element'];
  $attributes = array();
  if (isset($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] = (array) $element['#attributes']['class'];
  }
  $attributes['class'][] = 'form-managed-file';

  // This wrapper is required to apply JS behaviors and CSS styling.
  $output = '';
  $output .= '<div' . drupal_attributes($attributes) . '>';
  $output .= drupal_render_children($element);
  $output .= '</div>';
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
/*function shanti_sarvaka_field__image($variables) {

}*/

/**
 * Theme buttons to use Bootstrap Markup
 */
function shanti_sarvaka_button($variables) {
	//dpm($variables, 'vars in button');
  $element = $variables['element'];
  $text = $element['#value'];
	// Deal with custom #icon field
  $icon = '';
  if(!empty($element['#icon'])) {
  	$iconclass = $element['#icon'];
		if(strpos($iconclass, 'glyphicon') > -1) {
			 $iconclass = 'glyphicon ' . $iconclass;
		} elseif(strpos($iconclass, 'fa-') > -1) {
			 $iconclass = 'fa ' . $iconclass;
		} else {
			$iconclass = 'icon shanticon-' . $iconclass;
		}
  	$icon = "<span class=\"{$iconclass}\"></span> ";
		$element['#attributes']['class'][] = 'btn-icon';
  }
	// Attributes
  if (!empty($element['#attributes']['disabled'])) {
  	$element['#attributes']['class'][] = 'form-button-disabled';
  }
	//dpr($element);
	if((!empty($element['#id']) && strpos($element['#id'], 'remove-button') > -1) || $element['#value'] == 'Remove') {
		$element['#attributes']['class'][] = 'btn-delete';
		$element['#attributes']['class'][] = 'btn-sm';
		$element['#attributes']['class'][] = 'btn-icon';
		$element['#attributes']['title'] = t('Remove this field value');
  	$icon = "<span class=\"icon shanticon-trash\"></span> ";
		$text = "";
	}
	// Add type "submit" to ajax buttons so that they get selected by views ajax.js for processing.
	// See https://www.drupal.org/node/1692198 and https://issues.shanti.virginia.edu/browse/MB-550
	if(in_array('form-submit', $element['#attributes']['class']) && empty($element['#attributes']['type'])) {
		$element['#attributes']['type'] = 'submit';
	}
  element_set_attributes($element, array('id', 'name', 'value'));
  return '<button ' . drupal_attributes($element['#attributes']) . '>' . $icon . '<span>' . $text . '</span></button>';
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

function shanti_sarvaka_checkboxes($variables) {
	//dpm($variables, 'vars in checkboxes');
	$el = $variables['element'];
	if(isset($el['#attributes']['class'][0]) && $el['#attributes']['class'][0] == 'shanti-options') {
		$out = '';
		foreach($el['#options'] as $n => $op) {
			$oplc = str_replace(' ', '-', strtolower($op));
			$field = (isset($el['#parents'][0])) ? $el['#parents'][0] : 'scope';
			$out .= '<label class="checkbox-inline" ><input type="checkbox" id="' . $oplc . $field . '" name="' . $oplc . '-' . $field . '" data-value="' . $oplc . '">' . $op . '</label>';
		}
		return $out;
 	}
	return theme_checkboxes($variables);
}

function shanti_sarvaka_radio($vars) {
	$radio = theme_radio($vars);
	return '<label class="radio-inline" >' . $radio . '</label>';
}

/*
function shanti_sarvaka_radios($variables) {
	//dpm($variables, 'vars in radios');
	$el = $variables['element'];
	dpm($el, 'element');
	if(isset($el['#attributes']['class'][0]) && $el['#attributes']['class'][0] == 'shanti-options') {
		$out = '';
		foreach($el['#options'] as $n => $op) {
			$checked = (isset($el['#default_value']) && $n == $el['#default_value']) ? ' checked="checked"' : '';
			$oplc = str_replace(' ', '-', strtolower($op));
			$field = (isset($el['#parents'][0])) ? $el['#parents'][0] : 'scope';
			$out .= '<label class="radio-inline" ><input type="radio" id="' . $oplc . $field . '" name="' . $field . '"' . $checked . ' data-value="' . $oplc . '">' . $op . '</label>';
		}
		return $out;
 	}
	return theme_checkboxes($variables);
}*/

function shanti_sarvaka_textfield($variables) {
  $element = &$variables['element'];
	// Add place holder attribute with title
  if(!empty($element['#title'])) {
    $element['#attributes']['placeholder'] = t('Enter @title', array('@title' => $element['#title']));
  }
	// Remove unnecessary attributes for search form
	if(!empty($element['#parents']) && $element['#parents'][0] == 'search_block_form') {
		unset($element['#attributes']['title'], $element['#size'], $element['#maxlength']);
	}
  _form_set_class($element, array('form-control'));
	return theme_textfield($variables);
}

/**
 * MISCELLANEOUS HOOKS AND FUNCTIONS
 */
/**
 * Implements HOOK_breadcrumbs
 * Customizes output of breadcrumbs
 */
function shanti_sarvaka_breadcrumb($variables) {
  global $base_url;
  //dpm($variables, 'in shanti sarvaka breadcrumb');

  $breadcrumbs = is_array($variables['breadcrumb']) ? $variables['breadcrumb'] : array();
	if (theme_get_setting('shanti_sarvaka_breadcrumb_prefix') < 3 && strpos($breadcrumbs[0], t('Home')) > -1)  {
		array_shift($breadcrumbs);
	}
  $output = '<ol class="breadcrumb">';
  if(empty($variables['is_front'])) {
    array_unshift($breadcrumbs, '<a href="' . $base_url . '">' . theme_get_setting('shanti_sarvaka_breadcrumb_intro') . '</a>');
  }
	if(count($breadcrumbs) > 1) {
		$breadcrumbs[0] = str_replace('</a>', ':</a>', $breadcrumbs[0]);
	}
	$lidx = count($breadcrumbs) - 1;
	$breadcrumbs[$lidx] = '<a href="#">' . $breadcrumbs[$lidx] . '</a>';
  foreach($breadcrumbs as $crumb) {
  	$icon = ($breadcrumbs[0] == $crumb) ? '' : ' <span class="icon shanticon-arrow3-right"></span>';
    $output .= "<li>$crumb$icon</li>";
  }
  $output .= '</ol>';
  return $output;
}

/**
 * Alter Breadcrumbs to add Collection before item or if not part of collection, then creators name.
 */
function shanti_sarvaka_menu_breadcrumb_alter(&$active_trail, $item) {
	if (theme_get_setting('shanti_sarvaka_breadcrumb_prefix') != 2) {return;}
	$group_exists = TRUE;
	// Adjust breadcrumbs only for nodes
	if ($item['map'][0] == 'node') {
		// If Group module exists check if it has a group
		if (module_exists('og')) {
			$gps = og_get_entity_groups($item['map'][0], $item['map'][1]);
			if (empty($gps)) {
				$group_exists = FALSE;
			} else {
				if (!empty($gps['node']) && is_numeric(key($gps['node']))) {
					$gid = $gps['node'][key($gps['node'])];
					$gnode = node_load($gid);
					$bc = array( array(
						'title' => $gnode->title,
						'href' => "node/$gid",
						'localized_options' => array(),
					));
					array_splice($active_trail, 1, 0, $bc);
				}
			}
		}
		if (isset($item['map'][1]->uid)) {
			$uid = $item['map'][1]->uid;
			$user = user_load($uid);
			$uname = (!empty($user->realname)) ? $user->realname : $user->name;
			$bc = array( array(
				'title' => $uname,
				'href' => "user/{$uid}",
				'localized_options' => array(),
			));
			array_splice($active_trail, 1, 0, $bc);
		}
	}
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
  $html = str_replace('FIRST_HERE','<span class="icon"></span>', $html);
  $html = str_replace('PREVIOUS_HERE','<span class="icon"></span>', $html);
  $html = str_replace('NEXT_HERE','<span class="icon"></span>', $html);
  $html = str_replace('LAST_HERE','<span class="icon"></span>', $html);
  return $html;
}

/**
 * Service links formating
 */
function shanti_sarvaka_service_links_node_format($variables) {
	//dpm($variables, 'vars in service link function');
  $links = $variables['links'];
  $label = $variables['label'];
  $view_mode = $variables['view_mode'];
  $node_type = $variables['node_type'];
	// get Thumbnail image from meta_og_image tag if there
	$headels = drupal_add_html_head();
	$thumbnail = (isset($headels['meta_og_image'])) ? $headels['meta_og_image']['#attributes']['content'] : '';

  $html = '';
  foreach($links as $n => $l) {
  	$type = str_replace('service-links-','',$n);
		$icon = '';
		$text = '';
		switch($type) {
			case "facebook":
				$icon = 'shanticon-facebook';
				$text = t("Facebook");
				if(!empty($thumbnail)) { $l['query']['images[0]'] = $thumbnail; }
				break;
			case "forward":
				$icon = 'shanticon-mail';
				$text = t("Email");
				break;
			case "google-plus":
				$icon = "shanticon-googleplus";
				$text = t("Google+");
				break;
			case "twitter":
				$icon = "shanticon-twitter";
				$text = t("Twitter");
				break;
		}
		$icon = '<span class="icon ' . $icon . '"></span>';
		$l['html'] = TRUE;
    $html .= '<li>' . l($icon . ' ' . $text, $l['href'], $l) . '</li>';
  }
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

function _shanti_sarvaka_add_metatags() {
  global $base_url, $base_path;
  $base = $base_url . $base_path . drupal_get_path('theme', 'shanti_sarvaka') . '/';

	// Add to Header variables for favicons and MS settings
	// See https://wiki.shanti.virginia.edu/display/DELTA/Favicons for specs.
	$els = array(
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '57x57',
			'href' => '/apple-touch-icon-57x57.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '60x60',
			'href' => '/apple-touch-icon-60x60.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '72x72',
			'href' => '/apple-touch-icon-72x72.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '76x76',
			'href' => '/apple-touch-icon-76x76.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '114x114',
			'href' => '/apple-touch-icon-114x114.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '120x120',
			'href' => '/apple-touch-icon-120x120.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '144x144',
			'href' => '/apple-touch-icon-144x144.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '152x152',
			'href' => '/apple-touch-icon-152x152.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'apple-touch-icon',
			'sizes' => '180x180',
			'href' => '/apple-touch-icon-180x180.png',
		),
		array(
			'tag' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'href' => '/favicon-32x32.png',
	    'sizes' => '32x32',
		),
		array(
			'tag' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'href' => '/favicon-194x194.png',
	    'sizes' => '194x194',
		),
		array(
			'tag' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'href' => '/favicon-96x96.png',
	    'sizes' => '96x96',
		),
		array(
			'tag' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'href' => '/android-chrome-192x192.png',
	    'sizes' => '192x192',
		),
		array(
			'tag' => 'link',
			'rel' => 'icon',
			'type' => 'image/png',
			'href' => '/favicon-16x16.png',
	    'sizes' => '16x16',
		),
		array(
			'tag' => 'link',
			'rel' => 'manifest',
			'href' => '/manifest.json',
		),
		array(
			'tag' => 'meta',
			'name' => 'msapplication-TileColor',
			'content' => '#da532c',
		),
		array(
			'tag' => 'meta',
			'name' => 'msapplication-TileImage',
			'content' => '/mstile-144x144.png',
		),
		array(
			'tag' => 'meta',
			'name' => 'theme-color',
			'content' => '#ffffff',
		)
	);

	$ct = 0;
  foreach($els as $n => $el) {
  	$elinfo = array(
			'#tag' => $el['tag'],
			'#weight' => $ct,
			'#attributes' => array(),
		);

		foreach ($el as $anm => $aval) {
			if ($anm == 'tag') { continue; }
			$elinfo['#attributes'][$anm] = $aval;
		}
		$nm = "{$el['tag']}-$ct";
    drupal_add_html_head($elinfo, $nm);
		$ct++;
  }
}
function shanti_sarvaka_preprocess_apachesolr_search_snippets(&$vars) {
        if ($vars['doc']->entity_type == 'tcu') {
                $vars['transcripts_apachesolr_search_snippet']['link']['#text'] = t('Transcript');
        }
}
function shanti_sarvaka_transcripts_ui_transcript_navigation($vars) {
        $out  = "<button type='button' class='btn btn-default btn-icon playpause' title='Play / Pause'><span class='fa fa-play'></span></button>";
        $out .= "<button type='button' class='btn btn-default btn-icon previous' title='Previous line'><span class='icon shanticon-arrow-left'></span></button>";
        $out .= "<button type='button' class='btn btn-default btn-icon sameagain' title='Same line'><span class='icon shanticon-spin3'></span></button>";
        $out .= "<button type='button' class='btn btn-default btn-icon next' title='Next line'><span class='icon shanticon-arrow-right'></span></button>";
        $out .= "<button type='button' class='btn btn-default btn-icon searchtrans' title='Search Transcript'><span class='icon shanticon-magnify'></span></button>";
        return $out;
}
function shanti_sarvaka_transcripts_ui_transcript_search_wrapper($vars) {
    $out = "<span class='icon shanticon-close2'></span>";
    $out .= drupal_render($vars['element']['content']);
    return $out;
}
function shanti_sarvaka_transcripts_apachesolr_link_tcu($vars) {
    $mins = floor ($vars['element']['#time'] / 60);
    $secs = $vars['element']['#time'] % 60;
    $time = sprintf ("%d:%02d", $mins, $secs);
    $classes = 'btn btn-primary';
    $classes .= $vars['element']['#timecoded'] ? ' timed' : ' untimed';
    $out = "<a href='" . $vars['element']['#linkurl'] . "' class='" .$classes. "' role='button'>";
    $out .= "<span class='glyphicon glyphicon-play'></span> ";
    $out .= $time;
    if (isset($vars['element']['#text'])) {
        $out .= " " . $vars['element']['#text'];
    }
    $out .= "</a>";
    return $out;
}
function shanti_sarvaka_transcripts_ui_play_tcu($vars) {
        $mins = floor ($vars['element']['#time'] / 60);
        $secs = $vars['element']['#time'] % 60;
        $time = sprintf ("%d:%02d", $mins, $secs);
        $classes = 'btn btn-default btn-icon play-tcu';
        $classes .= $vars['element']['#timecoded'] ? ' timed' : ' untimed';
        $out = "<button type='button' class='" .$classes. "' title='Play line'><span class='glyphicon glyphicon-play'></span> ";
        $out .= $time;
        if (isset($vars['element']['#text'])) {
                $out .= " " . $vars['element']['#text'];
        }
        $out .= "</button>";
        return $out;
}
function shanti_sarvaka_form_transcripts_ui_search_form_alter(&$form, &$form_state) {
        $form['search']['input']['buttons']['go']['#attributes']['class'][] = 'searchbutton';
        $form['search']['input']['buttons']['go']['#inner'] = "<span class='icon'></span>";
        $form['search']['input']['buttons']['go']['#find'] = 'btn-primary';
        $form['search']['input']['buttons']['go']['#replace'] = 'btn-default';
        $form['search']['input']['buttons']['go']['#post_render'][] = 'shanti_sarvaka_find_replace';

        $form['search']['input']['buttons']['reset']['#inner'] = "<span class='icon'></span>";
        $form['search']['input']['buttons']['reset']['#find'] = 'btn-primary';
        $form['search']['input']['buttons']['reset']['#replace'] = 'searchreset';
        $form['search']['input']['buttons']['reset']['#post_render'][] = 'shanti_sarvaka_find_replace';

        $form['search']['navigate']['buttons']['next']['#attributes']['class'][] = 'nextresult';
        $form['search']['navigate']['buttons']['next']['#inner'] = "<span class='icon'></span>";
        $form['search']['navigate']['buttons']['next']['#find'] = 'btn-primary';
        $form['search']['navigate']['buttons']['next']['#replace'] = 'btn-default';
        $form['search']['navigate']['buttons']['next']['#post_render'][] = 'shanti_sarvaka_find_replace';

        $form['search']['navigate']['buttons']['previous']['#attributes']['class'][] = 'previousresult';
        $form['search']['navigate']['buttons']['previous']['#inner'] = "<span class='icon'></span>";
        $form['search']['navigate']['buttons']['previous']['#find'] = 'btn-primary';
        $form['search']['navigate']['buttons']['previous']['#replace'] = 'btn-default';
        $form['search']['navigate']['buttons']['previous']['#post_render'][] = 'shanti_sarvaka_find_replace';

        $form['search']['form_id'] = $form['form_id'];
        unset($form['form_id']);

        $form['search']['form_build_id'] = $form['form_build_id'];
        unset($form['form_build_id']);

        if (isset($form['form_token'])) {
                $form['search']['form_token'] = $form['form_token'];
                unset($form['form_token']);
        }
}
function shanti_sarvaka_find_replace($markup, $element) {
        return str_replace($element['#find'], $element['#replace'], $markup);
}
