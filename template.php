<?php

/**
 * @file
 * template.php
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
}

function shanti_sarvaka_preprocess_page(&$variables) {
  // Preload and render the language switcher to include in header (in page template)
  $data = module_invoke('locale', 'block_view', 'language');
  $block = block_load('locale', 'language');
  shanti_sarvaka_block_view_locale_language_alter($data, $block);
  if(module_exists('explore_menu')) {
    $variables['explore_menu_link'] = variable_get('explore_link_text', EXPLORE_LINK_TEXT);
  }
  if(module_exists('locale')) {
    $variables['language_switcher'] = '<li class="dropdown lang highlight" id="block-locale-language">  
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>' . $variables['language']->native . 
        '</span><i class="icon shanticon-arrowselect"></i></a>' . $data['content'] . '</li>';
  }
}


function shanti_sarvaka_preprocess_region(&$variables) {
  if($variables['region'] == 'header') {
    //dpm($variables, 'header variables 2');
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

/**
 * Takes a Drupal lang code (which is not ISO) and returns name of the language in that language. Custom function for Shanti
 */
 /* Can just user $language->native
function shanti_lang_code_to_name($code) {
  $langnames = array(
    'en' => 'English',
    'bo' => 'བོད་ཡིག',
    'dz' => 'རྫོང་ཁ།',
    'zh-hans' => '汉语',
    'fr' => 'Français',
  );  
  return (isset($langnames[$code])) ? $langnames[$code] : FALSE;
}
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
