<?php

namespace Drupal\search_overrides;

use Drupal\node\Entity\Node;
use Drupal\Core\Entity\Element\EntityAutocomplete;

/**
 * Provides utility methods for search overrides.
 */
trait SearchOverridesTrait {

  /**
   * {@inheritdoc}
   */
  public function getEntities(array $values) {
    $entities = [];
    foreach ($values as $value) {
      if (is_array($value)) {
        $key = $value['value'];
      }
      else {
        $key = $value;
      }
      $entities[] = $this->getEntityFromValue($key);
    }
    return $entities;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntityFromValue(string $key) {
    if (!$key) {
      return FALSE;
    }
    if (strpos($key, '(') !== FALSE) {
      $key = EntityAutocomplete::extractEntityIdFromAutocompleteInput($key);
    }
    if (is_numeric($key)) {
      $entity = Node::load($key);
    }
    elseif (strpos($key, '-') === FALSE && strpos($key, '/')) {
      // Treat as a local entity reference.
      $parts = explode('/', $key);
      $entity = \Drupal::entityTypeManager()->getStorage($parts[0])->load($parts[1]);
    }
    else {
      // Only remaining possibility is content indexed from a different site.
      // TODO: construct an object that can provide needed methods e.g.
      // getTitle and toUrl.
    }
    return $entity;
  }

  public function getStorageValueFromId(string $id, $hash = FALSE) {
    if ($hash && strpos($id, $hash) === FALSE) {
      // Must be content from a foreign index, so return it all.
      return $id;
    }
    $parts = explode(':', $id);
    $id_parts = explode('/', $parts[1]);
    if ($id_parts[0] == 'node') {
      // If a node, return only the nid.
      return $id_parts[1];
    }
    else {
      // Otherwise, return the entity type id and the entity id.
      return $parts[1];
    }
  }

}
