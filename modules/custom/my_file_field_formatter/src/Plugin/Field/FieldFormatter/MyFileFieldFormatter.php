<?php

namespace Drupal\my_file_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\file\Plugin\Field\FieldFormatter\FileFormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'my_file' formatter.
 *
 * @FieldFormatter(
 *   id = "my_file",
 *   label = @Translation("My file"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class MyFileFieldFormatter extends FileFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($this->getEntitiesToView($items, $langcode) as $delta => $file) {
      $item = $file->_referringItem;
      $field_parent = $item->getEntity();
      $elements[$delta] = [
        '#theme' => 'file_link',
        '#file' => $file,
        //'#description' => $this->getSetting('use_description_as_link_text') ? $item->description : NULL,
        '#description' => $field_parent->get('name')->getString(),
        '#cache' => [
          'tags' => $file->getCacheTags(),
        ],
      ];
      // Pass field item attributes to the theme function.
      if (isset($item->_attributes)) {
        $elements[$delta] += ['#attributes' => []];
        $elements[$delta]['#attributes'] += $item->_attributes;
        // Unset field item attributes since they have been included in the
        // formatter output and should not be rendered in the field template.
        unset($item->_attributes);
      }
    }

    return $elements;
  }

}