<?php

/**
 * @file
 * template.php
 */
 
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