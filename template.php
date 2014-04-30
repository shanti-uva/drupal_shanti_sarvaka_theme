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
  $variables['base_color'] = theme_get_setting('shanti_sarvaka_base_color');
  $variables['icon_code'] = theme_get_setting('shanti_sarvaka_icon_code');
}

/**
 * Implements HOOK_breadcrumbs
 * Customizes output of breadcrumbs
 */
function shanti_sarvaka_get_breadcrumbs($variables) {
  /**
   * what we want is:
   * 
   * <!--
            <ol class="breadcrumb">
              <li><span class="tag-before-breadcrumb"><?php print $site_name; ?>:</span></li>
              <li><a href="#">World</a></li>
              <li><a href="#">Asia</a></li>
              <li><a href="#">Greater Himalayas & Tibetan Plateau</a></li>
              <li><a href="#">China</a></li>
              <li><a href="#">Tibet Autonomous Region</a></li>
              <li><a href="#">Lhasa</a></li>
              <li class="active">Lhasa</li>
            </ol>-->
   */
  $breadcrumbs = $variables['breadcrumb'];

  $output = '<ol class="breadcrumb">';
  $output .= '<li><span class="tag-before-breadcrumb">' . $variables['site_name'] . ':</span></li>';
  if(is_array($breadcrumbs) && count($breadcrumbs) > 0) { 
    foreach($breadcrumbs as $crumb) {
      $output .= '<li><a href="#">' . $crumb . '</a></li>';
    }
  }
  $output .= '</ol>';
  return $output;
}