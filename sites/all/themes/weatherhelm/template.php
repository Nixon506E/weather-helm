<?php
/**
 * @file
 * template.php
 *
 * This file should only contain light helper functions and stubs pointing to
 * other files containing more complex functions.
 *
 * The stubs should point to files within the `theme` folder named after the
 * function itself minus the theme prefix. If the stub contains a group of
 * functions, then please organize them so they are related in some way and name
 * the file appropriately to at least hint at what it contains.
 *
 * All [pre]process functions, theme functions and template implementations also
 * live in the 'theme' folder. This is a highly automated and complex system
 * designed to only load the necessary files when a given theme hook is invoked.
 * @see _weatherhelm_theme()
 * @see theme/registry.inc
 *
 * Due to a bug in Drush, these includes must live inside the 'theme' folder
 * instead of something like 'includes'. If a module or theme has an 'includes'
 * folder, Drush will think it is trying to weatherhelm core when it is invoked
 * from inside the particular extension's directory.
 * @see https://drupal.org/node/2102287
 */

/**
 * Include common functions used through out theme.
 */
include_once dirname(__FILE__) . '/theme/common.inc';

/**
 * Implements hook_theme().
 *
 * Register theme hook implementations.
 *
 * The implementations declared by this hook have two purposes: either they
 * specify how a particular render array is to be rendered as HTML (this is
 * usually the case if the theme function is assigned to the render array's
 * #theme property), or they return the HTML that should be returned by an
 * invocation of theme().
 */
function weatherhelm_theme(&$existing, $type, $theme, $path) {
  // If we are auto-rebuilding the theme registry, warn about the feature.
  if (
    // Only display for site config admins.
    isset($GLOBALS['user']) && function_exists('user_access') && user_access('administer site configuration')
    && theme_get_setting('weatherhelm_rebuild_registry')
    // Always display in the admin section, otherwise limit to three per hour.
    && (arg(0) == 'admin' || flood_is_allowed($GLOBALS['theme'] . '_rebuild_registry_warning', 3))
  ) {
    flood_register_event($GLOBALS['theme'] . '_rebuild_registry_warning');
    drupal_set_message(t('For easier theme development, the theme registry is being rebuilt on every page request. It is <em>extremely</em> important to <a href="!link">turn off this feature</a> on production websites.', array('!link' => url('admin/appearance/settings/' . $GLOBALS['theme']))), 'warning', FALSE);
  }

  // Custom theme hooks:
  // Do not define the `path` or `template`.
  $hook_theme = array(
    // 'bootstrap_links' => array(
    //   'variables' => array(
    //     'links' => array(),
    //     'attributes' => array(),
    //     'heading' => NULL,
    //   ),
    // ),
    // 'bootstrap_btn_dropdown' => array(
    //   'variables' => array(
    //     'links' => array(),
    //     'attributes' => array(),
    //     'type' => NULL,
    //   ),
    // ),
    // 'bootstrap_modal' => array(
    //   'variables' => array(
    //     'heading' => '',
    //     'body' => '',
    //     'footer' => '',
    //     'attributes' => array(),
    //     'html_heading' => FALSE,
    //   ),
    // ),
    // 'bootstrap_accordion' => array(
    //   'variables' => array(
    //     'id' => '',
    //     'elements' => array(),
    //   ),
    // ),
    // 'bootstrap_search_form_wrapper' => array(
    //   'render element' => 'element',
    // ),
    // 'bootstrap_panel' => array(
    //   'render element' => 'element',
    // ),
  );

  // Process custom. This should be used again for any sub-themes.
  weatherhelm_hook_theme_complete($hook_theme, $theme, $path . '/theme');

  // Process existing registry. Only invoke once from base theme.
  weatherhelm_hook_theme_complete($existing, $theme, $path . '/theme');

  return $hook_theme;
}

/**
 * Discovers and fills missing elements in the theme registry.
 *
 * Adds the following:
 *  - `includes` `*.vars.php` if variables file is found.
 *  - `includes` `*.func.php` if function file is found.
 *  - `function` if the function for $theme is found.
 *  - `path` if template file is found.
 *  - `template` if template file is found.
 */
function weatherhelm_hook_theme_complete(&$registry, $theme, $path) {
  $registry = drupal_array_merge_deep(
    $registry,
    weatherhelm_find_theme_includes($registry, '.vars.php', $path),
    weatherhelm_find_theme_includes($registry, '.func.php', $path),
    drupal_find_theme_functions($registry, array($theme)),
    drupal_find_theme_templates($registry, '.tpl.php', $path)
  );
  // Post-process the theme registry.
  foreach ($registry as $hook => $info) {
    // Core find functions above does not carry over the base `theme path` when
    // finding suggestions. Add it to prevent notices for `theme` calls.
    if (!isset($info['theme path']) && isset($info['base hook'])) {
      $registry[$hook]['theme path'] = $path;
    }
    // Setup a default "context" variable. This allows #context to be passed
    // to every template and theme function.
    // @see https://drupal.org/node/2035055
    if (isset($info['variables']) && !isset($info['variables']['context'])) {
      $registry[$hook]['variables'] += array(
        'context' => array(),
      );
    }
  }
}

/**
 * Discovers and sets the path to each `THEME-HOOK.$extension` file.
 */
function weatherhelm_find_theme_includes($registry, $extension, $path) {
  $regex = '/' . str_replace('.', '\.', $extension) . '$/';
  $files = drupal_system_listing($regex, $path, 'name', 0);

  $hook_includes = array();
  foreach ($files as $name => $file) {
    // Chop off the remaining extension.
    if (($pos = strpos($name, '.')) !== FALSE) {
      $name = substr($name, 0, $pos);
    }
    // Transform "-" in filenames to "_" to match theme hook naming scheme.
    $hook = strtr($name, '-', '_');
    // File to be included by core's theme function when the hook is invoked.
    // This only applies to base hooks. When hook derivatives are called
    // (those with a double "__"), it checks for the base hook, calls its
    // variable processors and ignores anything specific to the derivative.
    // Due to the way it works, It becomes redundant to give it a path that is
    // not a base hook.
    // @see https://drupal.org/node/939462
    if (isset($registry[$hook]) && !isset($registry[$hook]['base hook'])) {
      // Include the file so core can discover any containing functions.
      include_once DRUPAL_ROOT . '/' . $file->uri;
      $hook_includes[$hook]['includes'][] = $file->uri;
    }
  }

  return $hook_includes;
}


/**
 * Declare various hook_*_alter() hooks.
 *
 * hook_*_alter() implementations must live (via include) inside this file so
 * they are properly detected when drupal_alter() is invoked.
 */
// weatherhelm_include('weatherhelm', 'theme/alter.inc');

//Fieldset
function weatherhelm_fieldset($variables) {
  $element = $variables ['element'];
  element_set_attributes($element, array('id'));
  _form_set_class($element, array('form-wrapper collapsible popout'));

  // $output = '<fieldset' . drupal_attributes($element ['#attributes']) . 'data-attribute="expanded"' . '>';
  // if (!empty($element ['#title'])) {
  //   // Always wrap fieldset legends in a SPAN for CSS positioning.
  //   $output .= '<legend><span class="fieldset-legend">' . $element ['#title'] . '</span></legend>';
  // }
  // $output .= '<div class="fieldset-wrapper">';
  // if (!empty($element ['#description'])) {
  //   $output .= '<div class="fieldset-description">' . $element ['#description'] . '</div>';
  // }
  // $output .= $element ['#children'];
  // if (isset($element ['#value'])) {
  //   $output .= $element ['#value'];
  // }
  // $output .= '</div>';
  // $output .= "</fieldset>\n";

  $output = '<ul' . drupal_attributes($element['#attributes']) . 'data-collapsible="expandable"' . '>';
  $output .= '<li class="active">';

  if (!empty($element ['#title'])) {
    // Always wrap fieldset legends in a SPAN for CSS positioning.
    $output .= '<div class="collapsible-header active"><i class="mdi-image-filter-drama"></i>'  . $element ['#title'] . '</div>';
  }

  $output .= '<div class="collapsible-body">';
  if (!empty($element ['#description'])) {
    $output .= '<div class="fieldset-description">' . $element ['#description'] . '</div>';
  }
  $output .= $element ['#children'];

  if (isset($element ['#value'])) {
    $output .= $element ['#value'];
  }
  $output .= '</div>';
  $output .= "</ul>\n";
  // $output .= '                <li>
  //                 <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>First</div>
  //                 <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  //               </li>
  //               <li>
  //                 <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>First</div>
  //                 <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  //               </li>
  //               <li>
  //                 <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>First</div>
  //                 <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  //               </li>
  //               <li>
  //                 <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>First</div>
  //                 <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
  //               </li>';
  // $output .= '</ul>';
  return $output;
}

/**
 * Returns HTML for a set of links.
 */
function weatherhelm_links($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

	  if (isset($attributes['id']) && $attributes['id'] == 'nav-mobile') {
		$custom_class = 'waves-effect waves-blue';
		$class[] = $custom_class;
		$link['attributes']['class'][] = $custom_class;
	  }
      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}
