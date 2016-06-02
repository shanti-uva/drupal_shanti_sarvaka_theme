<?php
/**
* Implements HOOK_form_system_theme_settings_alter
* 		Default values in shanti_sarvaka.info > theme settings where applicable
*/
function shanti_sarvaka_form_system_theme_settings_alter(&$form, $form_state) {
    global $base_path;
    $form['shanti_sarvaka_shanti_site'] = array(
        '#type'          => 'checkbox',
        '#title'         => t('Shanti Site'),
        '#default_value' => theme_get_setting('shanti_sarvaka_shanti_site'),
        '#description'   => t("Check if you want Shanti Logo and title to appear in top bar"),
    );
    $form['shanti_sarvaka_use_admin_site_title'] = array(
        '#type'          => 'checkbox',
        '#title'         => t('Use Admin Site Title'),
        '#default_value' => theme_get_setting('shanti_sarvaka_use_admin_site_title'),
        '#description'   => t("Use site title in <a href=\"/admin/config/system/site-information\">admin settings</a>."),
        '#states' => array(
            'visible' => array(
              ':input[name="shanti_sarvaka_shanti_site"]' => array('checked' => TRUE),
            ),
        ),
    );
    $form['shanti_sarvaka_default_title'] = array(
        '#type'          => 'textfield',
        '#title'         => t('Default Title for Banner'),
        '#default_value' => theme_get_setting('shanti_sarvaka_default_title'),
        '#description'   => t("The default page title to display in colored banner if no page title is found"),
    );
    $form['shanti_sarvaka_prefix_default_title'] = array(
        '#type'          => 'checkbox',
        '#title'         => t('Prefix Default Title before all Page Titles in Banner'),
        '#default_value' => theme_get_setting('shanti_sarvaka_prefix_default_title'),
        '#description'   => t("Prefix the default title before every page name"),
        '#states' => array(
            'invisible' => array(
              ':input[name="shanti_sarvaka_default_title"]' => array('value' => ''),
            ),
        ),
    );
    $form['shanti_sarvaka_breadcrumb_intro'] = array(
        '#type'          => 'textfield',
        '#title'         => t('Text before breadcrumbs'),
        '#default_value' => theme_get_setting('shanti_sarvaka_breadcrumb_intro'),
        '#description'   => t("The text to display in front of the breadcrumbs"),
    );
    $form['shanti_sarvaka_breadcrumb_prefix'] = array(
        '#type'          => 'select',
        '#title'         => t('Choose the prefix you want for your breadcrumbs'),
        '#options' 			 => array(
            1 => t('None'),
            2 => t('Collection Only'),
            3 => t('Username and Collection'),
            4 => t('Home'),
        ),
        '#default_value' => theme_get_setting('shanti_sarvaka_breadcrumb_prefix'),
        '#description'   => t("Select the option for your breadcrumb prefix"),
    );
    $form['shanti_sarvaka_breadcrumb_nohome'] = array(
        '#type'          => 'checkbox',
        '#title'         => t('Remove "Home" as first item in breadcrumbs'),
        '#default_value' => theme_get_setting('shanti_sarvaka_breadcrumb_nohome'),
        '#description'   => t("Check this box to remove the first breadcrumb, \"Home\""),
    );
    $form['shanti_sarvaka_icon_class'] = array(
        '#type'          => 'textfield',
        '#title'         => t('Icon Class Name for Banner'),
        '#default_value' => theme_get_setting('shanti_sarvaka_icon_class'),
        '#description'   => t('Icon in title banner for this site. Use the class name as listed on the <a href="@link" target="_blank">Shanticon Reference Page</a> without the "shanticon-" prefix.', 
        array("@link" => $base_path . drupal_get_path('theme', 'shanti_sarvaka') . '/fonts/shanticon/bin/demo.html')),
    );
    $form['shanti_sarvaka_site_body_tag'] = array(
        '#type'          => 'textfield',
        '#title'         => t('Unique Body Class for Site'),
        '#default_value' => theme_get_setting('shanti_sarvaka_site_body_tag'),
        '#description'   => t("A unique class identifying the site to add to the body tag"),
    );
    $form['shanti_sarvaka_show_login_link'] = array(
        '#type'          => 'checkbox',
        '#title'         => t('Show Login Link in Main Menu'),
        '#default_value' => theme_get_setting('shanti_sarvaka_show_login_link'),
        '#description'   => t('Uncheck this box to prevent the login link from appearing in the main menu'),
    );
    // Custom submit handler for validation
    $form['#submit'][] = 'shanti_sarvaka_form_system_theme_settings_submit';
} 

/**
 * Implements hook_form_system_theme_settings_submit
 * For validating theme settings input
 */
function shanti_sarvaka_form_system_theme_settings_submit(&$form, &$form_state) {
    // Remove unnecessary "shanticon-" prefix to site icon setting
    if (!empty($form_state['values']['shanti_sarvaka_icon_class'])) {
        $form_state['values']['shanti_sarvaka_icon_class'] = str_replace('shanticon-', '', $form_state['values']['shanti_sarvaka_icon_class']);
    }
}
