<?php

namespace Drupal\search_overrides\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\Element\EntityAutocomplete;
use Drupal\search_overrides\SearchOverridesTrait;

/**
 * Form controller for Search elevate edit forms.
 *
 * @ingroup search_api_solr_elevate_exclude
 */
class SearchOverrideForm extends ContentEntityForm {

  use SearchOverridesTrait;

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $config = $this->config('search_overrides.settings');
    $content_match = $config->get('content_match');
    $index = FALSE;
    if ($content_match && $content_match == 'index') {
      $index = $config->get('search_index');
    }
    $this->processElement($form['elnid'], $form_state, $form, $index);
    $this->processElement($form['exnid'], $form_state, $form, $index);

    return $form;
  }

  private function processElement(array &$element, FormStateInterface $form_state, array &$complete_form, $index = FALSE) {
    if ($element['#type'] == 'container') {
      $field_name = $element['widget']['#field_name'];
      $values = $form_state->getValue($field_name);
      foreach($element['widget'] as $delta => $widget_part) {
        if (is_numeric($delta)) {
          $this->addAutocomplete($element['widget'][$delta]['value'], $form_state, $complete_form, $index);
        }
      }
    }
    else {
      $this->addAutocomplete($element, $form_state, $complete_form, $index);
    }
  }

  private function addAutocomplete(array &$element, FormStateInterface $form_state, array &$complete_form, $index = FALSE) {
    if ($index) {
      // Index was specified, so use to find matches.
      $element['#autocomplete_route_name'] = 'search_overrides.autocomplete';
      $element['#autocomplete_route_parameters'] = [
        'index_id' => $index,
        'count' => 10,
      ];
      if ($key = $element['#default_value']) {
        $entity = $this->getEntityFromValue($key);
        $element['#default_value'] = $entity->label() . ' (' . $key . ')';
      }

    }
    else {
      // Default to a standard, node autocomplete.
      $element['#type'] = 'entity_autocomplete';
      $element['#target_type'] = 'node';
      if ($key = $element['#default_value']) {
        $element['#default_value'] = $this->getEntityFromValue($key);
      }
    }
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $config = $this->config('search_overrides.settings');
    $content_match = $config->get('content_match');
    // No need for extra processing if using only nodes.
    if ($content_match == 'index') {
      $values['elnid'] = $form_state->getValue('elnid', []);
      $values['exnid'] = $form_state->getValue('exnid', []);
      // Parse out entity ids from returned values.
      foreach($values as $field => $field_values) {
        foreach ($field_values as $index => $value_array) {
          if (is_numeric($index) && $value_array['value']) {
            $field_values[$index]['value'] = EntityAutocomplete::extractEntityIdFromAutocompleteInput($value_array['value']);
          }
        }
        $form_state->setValue($field, $field_values);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Search override.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Search override.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.search_override.collection');
  }

}
