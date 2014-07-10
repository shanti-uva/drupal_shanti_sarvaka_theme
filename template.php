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
  global $base_url;
  $variables['base_color'] = theme_get_setting('shanti_sarvaka_base_color');
  $variables['breadcrumb'] = menu_get_active_breadcrumb();
  $variables['breadcrumb'][] = ($variables['is_front'])? 'Home' : drupal_get_title();
  $variables['default_title'] = theme_get_setting('shanti_sarvaka_default_title');
  $variables['home_url'] = url(variable_get('site_frontpage', 'node'));
  $variables['icon_class'] = theme_get_setting('shanti_sarvaka_icon_class');
  $variables['site_slogan'] = (theme_get_setting('toggle_slogan') ? filter_xss_admin(variable_get('site_slogan', '')) : '');
  $variables['theme_path'] = $base_url . '/' . drupal_get_path('theme', 'shanti_sarvaka'); 
  $variables['shanti_site'] = theme_get_setting('shanti_sarvaka_shanti_site');
}

function shanti_sarvaka_preprocess_page(&$variables) {
  // Figure out bootstrap column classes
  //dpm($variables, 'page vars');
  $variables['bsclass_sb1'] = ($variables['page']['sidebar_first']) ? 'col-sm-3' : '';
  $variables['bsclass_sb2'] = ($variables['page']['sidebar_second']) ? 'col-sm-3' : '';
  $variables['bsclass_main'] = 'col-sm-6';
  if(!$variables['bsclass_sb1'] && !$variables['bsclass_sb2']) {
    $variables['bsclass_main'] = 'col-xs-12'; 
  } elseif (!$variables['bsclass_sb1'] || !$variables['bsclass_sb2']) {
    $variables['bsclass_main'] = 'col-sm-9'; 
  }
  // Preload and render the language switcher to include in header (in page template)
  $data = module_invoke('locale', 'block_view', 'language');
  $block = block_load('locale', 'language');
  shanti_sarvaka_block_view_locale_language_alter($data, $block);
  if(module_exists('explore_menu')) {
    $variables['explore_menu_link'] = variable_get('explore_link_text', EXPLORE_LINK_TEXT);
    $variables['explore_menu'] = menu_tree('shanti-explore-menu');
  }
  if(module_exists('locale')) {
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
   *        i.thumbtype = Sets the color for the the thumbnail type icon in the upper right corner of gallery thumbnails
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
* Changes the search form to use the "search" input element of HTML5.
*/
function shanti_sarvaka_preprocess_search_block_form(&$variables) {
  //dpm($variables, 'vars in preprocess search block');
}

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
  $vars['attributes']['class'][] = 'btn-primary'; // can be 'img-rounded', 'img-circle', or 'img-thumbnail'
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
              . $variables['tree'] . '</ul></div></div><span class="closecollection"> <i class="icon shanticon-close"></i> </span></nav></section>';
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
        <div class="col-md-11">
      
          <div class="header row">
              <p class="title col-md-9">' . $el['title'] . '</p>
              <p class="link">' . $el['link'] . '</p>
          </div>
              
          <div class="carousel slide row" id="collection-carousel">
              <div class="carousel-inner">';
  foreach($el['slides'] as $n => $slide) {
    $active = ($n == 0) ? 'active' : '';
    $html .= '<!-- Slide' . $n . ' --> 
      <div class="item ' . $active . '">
        <div class="caption col-md-7">
          <div class="title"><h3><a href="' . $slide['path'] . '"><i class="shanticon shanticon-stack"></i> ' . $slide['title'] . '</a></h3></div>   
          <div class="byline"> ' . $slide['author'] . ', ' . $slide['date'] . ', ' . $slide['itemcount'] . '</div>               
          <div class="description">' . $slide['summary'] . '</div>
          <div class="link"><a class="" href="' . $slide['path'] . '">' . t('View Collection') . ' <i class="glyphicon glyphicon-plus"></i></a></div>
        </div>                 
        <div class="bannerImage col-md-5">
            <a href="' . $slide['path'] . '"><img src="' . $slide['img'] . '" alt=""></a>
        </div>                
     </div><!-- /Slide' . $n . ' --> ';
  }
  $html .= '</div>
              <div class="control-box">                            
                  <a data-slide="prev" href="#collection-carousel" class="carousel-control left basebg">‹</a>
                  <a data-slide="next" href="#collection-carousel" class="carousel-control right basebg">›</a>
              </div><!-- /.control-box -->   
            </div><!-- /#collection-carousel -->
        </div><!-- /.span12 -->          
        </div><!-- /.row --> 
        </div><!-- /.container -->';
  return $html;
}

/** Fieldset Groups **/
function shanti_sarvaka_fieldset($variables) {
  $element = $variables['element'];
  $title = (isset($element['#title'])) ? $element['#title'] : t('Field Group');
  if(!isset($element['#title'])) {
    return '<div class="panel panel-default"><div class="panel-body">' . $element['#children'] . '</div></div>';
  }
  $openclass = (isset($element['#collapsed']) && $element['#collapsed']) ? "" : " in";
  $icon = (isset($element['#collapsed']) && $element['#collapsed']) ? "+" : "-";
  $iconclass = (isset($element['#collapsed']) && $element['#collapsed']) ? "" : " open";
  $id = (isset($element['#id'])) ? $element['#id'] : uniqid('mb');
  $out = '<div class="field-accordion panel-group" id="accordion' . $id . '">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <span class="ss-fieldset-toggle' . $iconclass . '">' . $icon . '</span>
        <a data-toggle="collapse" data-parent="#accordion" href="#' . $id . '">'
           . $title .
        '</a>
      </h4>
    </div>
    <div id="' . $id . '" class="panel-collapse collapse' . $openclass . '">
      <div class="panel-body">';
   $out .= $element['#children'];
   $out .= '</div></div></div></div>';
   return $out;
}

/**
 * Theme buttons to use Bootstrap Markup
 */
 $bdone = 0;
function shanti_sarvaka_button($variables) {
  global $bdone;
  if($bdone == 0) {
    //dpm($variables, 'button');
    $bdone = 1;
  }
  $element = $variables['element'];
  $text = $element['#value'];
  unset($element['#value']);
  $icon = '';
  if(strpos(strtolower($text), 'video') > 0) {
    $icon = '<i class="shanticon shanticon-video"></i> ';
  } else if(strpos(strtolower($text), 'audio') > 0) {
    $icon = '<i class="shanticon shanticon-audio"></i> ';
  } else if(strpos(strtolower($text), 'collection') > 0) {
    $icon = '<i class="shanticon shanticon-texts"></i> ';
  } 
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));
  $element['#attributes']['class'][] = 'btn';
  $element['#attributes']['class'][] = 'btn-primary';
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }

  return '<button' . drupal_attributes($element['#attributes']) . ' >' . $icon . '<span>' . $text . '</span></button>';
}

function shanti_sarvaka_select($variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'form-control';
  $element['#attributes']['class'][] = 'form-select';
  $element['#attributes']['class'][] = 'ss-select';
  element_set_attributes($element, array('id', 'name', 'size'));

  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}

function shanti_sarvaka_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  $element['#attributes']['class'][] = 'form-control';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
  _form_set_class($element, array('form-text'));

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
