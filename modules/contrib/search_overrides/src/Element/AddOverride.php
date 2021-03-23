<?php

namespace Drupal\search_overrides\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\search_overrides\Entity\SearchOverride;
use Drupal\search_overrides\SearchOverrideReferencer;


/**
 * Provides an element for add a search element to a node.
 *
 * @FormElement("search_override_element")
 */
class AddOverride extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#tree' => TRUE,
      '#process' => [
        [$class, 'processOverrideElement'],
      ],
    ];
  }

  /**
   * Render API callback: Composite element type for adding search overrides.
   *
   * Provides options for keywords and promote/exclude, with AJAX processing
   * of provided values.
   */
  public static function processOverrideElement(&$element, FormStateInterface $form_state, &$form) {
    $element['#attributes'] = [
      'class' => ['search-override--table--add-form'],
    ];

    $element['container'] = array(
      '#prefix' => '<div class="container-inline search-override--add-query-form">',
      '#suffix' => '</div>',
    );
    $element['container']['query'] = [
      '#type' => 'textfield',
      '#placeholder' => t('New keywords'),
      '#attributes' => [
        'class' => ['search-override--add-query-field'],
      ],
    ];

    $element['container']['field'] = [
      '#type' => 'select',
      '#options' => [
        'elnid' => t('Promote'),
        'exnid' => t('Exclude'),
      ],
    ];

    // Create the submit button.
    $element['container']['add-override'] = [
      '#type' => 'button',
      '#value' => t('Add'),
      '#states' => [
        'disabled' => [
          '.search-override--add-query-field' => ['empty' => TRUE],
        ],
      ],
      '#ajax' => [
        'callback' => [get_called_class(), 'processInput'], //alternative notation
        'disable-refocus' => TRUE, // Or TRUE to prevent re-focusing on the triggering element.
        'event' => 'click',
        'wrapper' => 'search-overrides--data', // This element is updated with this AJAX callback.
        'effect' => 'fade',
        'progress' => [
          'type' => 'throbber',
          'message' => t('Adding...'),
        ],
      ],
    ];

    return $element;
  }

  /**
   * AJAX callback to process provided override values.
   *
   * @param array $form
   *   The form definition.
   * @param FormStateInterface $form_state
   *   Current state of the form, including user input.
   *
   * @return AjaxResponse $response
   *   Will return an AJAX response, either an error or an update to the table.
   */
  public static function processInput(array &$form, FormStateInterface $form_state) {
    $node_form_values = $form_state->getValues();
    $values = $node_form_values['add-form']['container'];
    if (empty($values['query'])) {
      return FALSE;
    }
    if (!$form_state->isValidationComplete()) {
      return $values;
    }
    // Initialize the AJAX response, since we may use it to throw errors.
    $response = new AjaxResponse();
    $nid = $form_state->getformObject()->getEntity()->id();
    $elQuery = \Drupal::entityQuery('search_override');
    $elevates = $elQuery->condition('query', $values['query'])->execute();
    if ($elevates) {
      $el_id = array_pop($elevates);
      $override = SearchOverride::load($el_id);

      // Check if a value already exists for the query in the opposite field.
      $fields = ['elnid', 'exnid'];
      $field_pos = array_search($values['field'], $fields);
      unset($fields[$field_pos]);
      $field_to_check = array_pop($fields);

      $entities = $override->get($field_to_check)->getValue();
      $is_present = FALSE;
      foreach ($entities as $value) {
        if ($nid == $value['target_id']) {
          $is_present = TRUE;
        }
      }

      if ($is_present) {
        $title = t('Error');
        $content['#markup'] = t('An override already exists for this query, in the opposite field.');
        $content['#attached']['library'][] = 'core/drupal.dialog.ajax';
        $response->addCommand(new OpenModalDialogCommand($title, $content, ['width' => '250']));
        return $response;
      }

      $entities = $override->get($values['field'])->getValue();
      // Look for an existing value.
      $is_present = FALSE;
      foreach ($entities as $value) {
        if ($nid == $value['target_id']) {
          $is_present = TRUE;
        }
      }

      if ($is_present) {
        $title = t('Error');
        $content['#markup'] = t('This override already exists.');
        $content['#attached']['library'][] = 'core/drupal.dialog.ajax';
        $response->addCommand(new OpenModalDialogCommand($title, $content, ['width' => '250']));
        return $response;
      }

      // Add the new nid.
      $entities[] = $nid;
      $override->set($values['field'], $entities);
      $override->save();
    }
    else {
      // No existing override, so make one.
      $options = [
        $values['field'] => $nid,
        'query' => $values['query'],
      ];
      $override = SearchOverride::create($options);
      $override->save();
    }

    // Update the table of overrides directly.
    $referencer = new SearchOverrideReferencer;
    $new_table = $referencer->EntityOverridesTable($nid);

    $renderer = \Drupal::service('renderer');
    $renderedTable = $renderer->render($new_table);

    $response->addCommand(new ReplaceCommand('#search-overrides--data', $renderedTable));
    $response->addCommand(new InvokeCommand('.search-override--add-query-field', 'val', ['']));
    // Show the dialog box.
    return $response;
  }

}
