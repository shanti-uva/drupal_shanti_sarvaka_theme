<?php
/**
 * Implements HOOK_form_system_theme_settings_alter
 * Adds base color field to theme settings
 */
function shanti_sarvaka_form_system_theme_settings_alter(&$form, $form_state) {
  $form['shanti_sarvaka_default_title'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Deafult Title for Banner'),
    '#default_value' => theme_get_setting('shanti_sarvaka_default_title'),
    '#description'   => t("The text to display in colored banner if no page title is found"),
  );

  $form['shanti_sarvaka_base_color'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Base Color'),
    '#default_value' => theme_get_setting('shanti_sarvaka_base_color'),
    '#description'   => t("The base color for the banner of this site"),
  );
  
  $form['shanti_sarvaka_icon_code'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Icon Code'),
    '#default_value' => theme_get_setting('shanti_sarvaka_icon_code'),
    '#description'   => t("Icon for this site"),
  );
}

?>