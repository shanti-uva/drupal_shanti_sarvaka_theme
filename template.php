<?php

/**
 * @file
 * template.php
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
 

/*
 * implements hook_preprocess
 * Add theme_path to all templates
 */
function shanti_sarvaka_preprocess(&$variables) {
  global $base_url;
  $variables['theme_path'] = $base_url . '/' . drupal_get_path('theme', 'shanti_sarvaka'); 
  $variables['default_title'] = theme_get_setting('shanti_sarvaka_default_title');
  $variables['base_color'] = theme_get_setting('shanti_sarvaka_base_color');
  $variables['icon_code'] = theme_get_setting('shanti_sarvaka_icon_code');
  $variables['breadcrumb'] = menu_get_active_breadcrumb();
  $variables['breadcrumb'][] = ($variables['is_front'])? 'Home' : drupal_get_title();
}

function shanti_sarvaka_preprocess_region(&$variables) {
  if($variables['region'] == 'header') {
   //dpm($variables, 'header variables');
  }
  $variables['site_slogan'] = (theme_get_setting('toggle_slogan') ? filter_xss_admin(variable_get('site_slogan', '')) : '');
  $variables['home_url'] = url(variable_get('site_frontpage', 'node'));
}


function shanti_sarvaka_preprocess_block(&$variables) {
  $block = $variables['block'];
  if(isset($block->region) && $block->region == 'header') {
    // TODO: Is there a way to get the content of each block to be written (hidden) elsewhere on the page?
    if($block->title == "Explore Collections") {
      //dpm($block, 'block in preprocess for explore collections block');
    }
  }
}

function shanti_sarvaka_block_view_locale_language_alter(&$data, $block) {
  global $language;  // Currently chosen language
  $currentCode = $language->language; // ISO 2 letter code
  $currentName = shanti_lang_code_to_name($currentCode); 
  $languages = language_list(); // List of all enabled languages
  $markup = '<div class="nav navbar-nav dropdown dropdown-menu-right lang highlight">' . 
            '<a href="" class="dropdown-toggle" data-toggle="dropdown">' .
              $currentName . '<i class="icon km-arrowselect"></i></a><ul class="dropdown-menu dropdown-features" role="menu">';
  $n = 0;
  foreach($languages as $lang) {
    $n++;
    $checked = ($lang->language == $currentCode) ? 'checked="checked"' : '';
    $markup .= '<li class="form-group"><label class="radio-inline" for="optionlang' . $n . '">
                  <input type="radio" name="radios" class="optionlang" id="optionlang' . $n . '" value="' . $lang->prefix . '" ' . $checked . '/>' .
                  shanti_lang_code_to_name($lang->language) . '</label></li>';
  }
  $markup .= '</ul></div>';
  $data['content'] = $markup;
}

/**
 * Takes a Drupal lang code (which is not ISO) and returns name of the language in that language. Custom function for Shanti
 */
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

function shanti_sarvaka_block_facetapi($variables) {
  dpm($variables, 'in facet block function');
}
