<?php

namespace Drupal\search_overrides\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\search_overrides\SearchOverrideReferencer;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\search_api\Entity\Index;
use Drupal\search_overrides\SearchOverridesTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides listings of instances (with overrides) for a specified rule.
 */
class Manager extends ControllerBase {

  use SearchOverridesTrait;

  public function removeEntity($override, $entity, $field) {
    $message = $this->processRemoval($override, $entity, $field);
    // Redirect to a specified destination, if provided.
    $destination = Url::fromUserInput(\Drupal::destination()->get());
    if ($destination->getRouteName()) {
      // Valid internal path.
      $this->messenger()->addMessage($message);
      return $this->redirect($destination->getRouteName(), $destination->getRouteParameters());
    }
    $message = [
      '#type' => 'markup',
      '#markup' => $message,
    ];
    return $message;
  }

  public function removeEntityAjax($override, $entity, $field) {
    $message = $this->processRemoval($override, $entity, $field);
    // Update the table of overrides directly.
    $referencer = new SearchOverrideReferencer;
    $new_table = $referencer->EntityOverridesTable($entity);

    $renderer = \Drupal::service('renderer');
    $renderedTable = $renderer->render($new_table);

    $response = new AjaxResponse();
    $response->addCommand(new ReplaceCommand('#search-overrides--data', $renderedTable));
    // Show the dialog box.
    return $response;
  }

  public function processRemoval($override, $entity_id, $field) {
    $entities = $override->get($field)->getValue();
    foreach ($entities as $key => $temp_entity) {
      $target_id = (is_array($temp_entity)) ? array_pop($temp_entity) : $temp_entity;
      if ($target_id == $entity_id) {
        unset($entities[$key]);
      }
    }
    $override->set($field, $entities);
    $count = 0;
    foreach (['elnid','exnid'] as $count_field) {
      $count += count($override->get($count_field)->getValue());
    }
    if ($count) {
      $override->save();
      $message = $this->t('The search override was updated.');
    }
    else {
      $override->delete();
      $message = $this->t('The search override was removed.');
    }
    return $message;
  }

  public function searchIndex(Request $request, $index_id, $count) {
    $results = [];

    // Get the typed string from the URL, if it exists.
    if ($input = $request->query->get('q')) {
      $index = Index::load($index_id);
      $query = $index->query();
      $query->keys($input);
      $query_results = $query->execute();

      foreach ($query_results as $query_result) {
        $key = $this->getStorageValueFromId($query_result->getId());
        $entity = $this->getEntityFromValue($key);
        // @todo: find a reliable way to create a title for content from a
        // different foreign site.
        $results[] = [
          'value' => $entity->label() . ' (' . $key . ')',
          'label' => $entity->label(),
        ];
      }
    }

    return new JsonResponse($results);
  }

}
