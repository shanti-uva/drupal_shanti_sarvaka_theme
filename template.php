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
  $variables['breadcrumb'][] = drupal_get_title();
}

function shanti_sarvaka_preprocess_region(&$variables) {
  $variables['home_url'] = url(variable_get('site_frontpage', 'node'));
}

/**
 * Implements HOOK_breadcrumbs
 * Customizes output of breadcrumbs
 */
function shanti_sarvaka_get_breadcrumbs($variables) {

  $breadcrumbs = $variables['breadcrumb'];
  $intro = theme_get_setting('shanti_sarvaka_breadcrumb_intro');
  $output = '<ol class="breadcrumb">';
  if(isset($intro)) {
      $output .= '<li><span class="tag-before-breadcrumb">' . $intro . ':</span></li>';
  }
  if(is_array($breadcrumbs) && count($breadcrumbs) > 0) {
    if(count($breadcrumbs) == 1) {
        $breadcrumbs[0] = '<a>Home</a>';
    }
    foreach($breadcrumbs as $crumb) {
        $output .= '<li>' . $crumb . '</li>';
    }
  } 
  $output .= '</ol>';
  return $output;
}