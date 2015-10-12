<?php
/**
 * @file
 * Theme settings.
 */

/**
 * Implements theme_settings().
 */
function THEMENAME_form_system_theme_settings_alter(&$form, &$form_state) {
  // Ensure this include file is loaded when the form is rebuilt from the cache.
  $form_state['build_info']['files']['form'] = $theme_path . '/theme-settings.php';

  // Add a custom submit handler.
  $form['#submit'][] = 'THEMENAME_form_system_theme_settings_submit';

  // Return the additional form widgets.
  return $form;
}

/**
 * Submit handler for system_theme_settings().
 */
function THEMENAME_form_system_theme_settings_submit($form, &$form_state) {
  $values = $form_state['values'];

  // Save images.
  foreach ($values as $name => $value) {
    if (preg_match('/_image$/', $name)) {
      if (!empty($values[$name])) {
        $file = file_load($values[$name]);
        $file->status = FILE_STATUS_PERMANENT;
        file_save($file);
        file_usage_add($file, 'THEMENAME', 'theme', 1);
        variable_set($name, $file->fid);
      }
    }
  }
}
