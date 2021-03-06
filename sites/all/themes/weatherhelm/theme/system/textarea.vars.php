<?php
/**
 * @file
 * textarea.vars.php
 */

/**
 * Implements hook_preprocess_textarea().
 */
function weatherhelm_preprocess_textarea(&$vars) {
  $vars['element']['#attributes']['class'][] = 'materialize-textarea';
  if (isset($vars['element']['#value'])) {
    if ($class = _weatherhelm_colorize_button($vars['element']['#value'])) {
      $vars['element']['#attributes']['class'][] = $class;
    }
  }
}
