<?php

namespace Drupal\search_overrides\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SearchElevateSettingsForm.
 *
 * @ingroup search_api_solr_elevate_exclude
 */
class SearchOverrideSettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'searchoverride_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('search_overrides.settings');
    foreach ($form_state->getValues() as $key => $value) {
      if (strpos($key, 'search_override_') !== FALSE) {
        $config->set(str_replace('search_override_', '', $key), $value);
      }
    }
    $config->save();
    $this->messenger()->addMessage($this->t('Configuration was saved.'));
  }

  /**
   * Defines the settings form for Search elevate entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['searchoverride_settings']['#markup'] = 'Settings form for Search overrides. Manage configuration here.';
    $config = $this->config('search_overrides.settings');
    $form['preview'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Results Previews'),
      '#description' => $this->t('These fields will be used to preview search results in a tesing link and do not restrict the form or indexes on which overrides take effect. Use the site-relative path to the search results page, including the preceding slash. The URL parameter is the "Filter identifier" defined for the Fulltext search filter in your search view. It is the query parameter through which search keywords are passed.'),
      '#attributes' => ['class' => [
          'override-previews'
        ]
      ],
    ];
    $form['preview']['search_override_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Path'),
      '#default_value' => $config->get('path'),
      '#placeholder' => '/search',
      '#required' => TRUE,
    ];
    $form['preview']['search_override_parameter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL Parameter'),
      '#placeholder' => 'query',
      '#default_value' => $config->get('parameter'),
      '#required' => TRUE,
      '#prefix' => '?',
      '#suffix' => $this->t('=keywords'),
      '#attributes' => ['class' => [
          'preview-query'
        ],
      ],
    ];
    $form['search_override_match_entire_string'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Only match entire search strings'),
      '#default_value' => $config->get('match_entire_string'),
      '#description' => $this->t('Promotions and exclusions only get applied if they match a user\'s entire search string.'),
      '#required' => FALSE,
    ];
    $match_options = [
      'node' => $this->t('Select from nodes'),
      'index' => $this->t('Select from a search index'),
    ];
    $form['search_override_content_match'] = [
      '#type' => 'select',
      '#title' => $this->t('Content to select from '),
      '#default_value' => $config->get('content_match'),
      '#description' => $this->t('Specify how content with be selected to promote or exclude.'),
      '#options' => $match_options,
    ];
    $form['search_override_search_index'] = [
      '#type' => 'select',
      '#title' => $this->t('Solr index to select from '),
      '#default_value' => $config->get('search_index'),
      '#description' => $this->t('Specify which Solr index will be used to find content.'),
      '#options' => search_overrides_get_indexes(),
      '#states' => [
        'visible' => [
          ':input[name="search_override_content_match"]' => ['value' => 'index'],
        ],
      ],
    ];
    $form['save'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];
    $form['#attached']['library'][] = 'search_overrides/drupal.search_overrides.admin';

    return $form;
  }

}
