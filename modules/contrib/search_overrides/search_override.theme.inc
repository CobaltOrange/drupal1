<?php

/**
 * @file
 * Contains search_override.theme.inc.
 *
 * Theme callback for Search override entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Search override templates.
 *
 * Default template: search_override.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_search_override(array &$variables) {
  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
