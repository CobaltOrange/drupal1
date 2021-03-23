<?php

namespace Drupal\custom_1\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class custom_1Form extends ConfigFormBase {

    /**
    * {@inheritdoc}
    */
    public function getFormId() {
        return 'custom_1_form';
    }
   
    /**
    * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {
        // Form constructor.
        $form = parent::buildForm($form, $form_state);
        // Default settings.
        $config = $this->config('custom_1.settings');
        // Page title field.
        $form['page_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lorem ipsum generator page title:'),
            '#default_value' => $config->get('loremipsum.page_title'),
            '#description' => $this->t('Give your lorem ipsum generator page a title.'),
        ];
        // Source text field.
        $form['source_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Source text for lorem ipsum generation:'),
            '#default_value' => $config->get('custom_1.source_text'),
            '#description' => $this->t('Write one sentence per line. Those sentences will be used to generate random text.'),
        ];
  
        return $form;
    }

    /**
    * {@inheritdoc}
    */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('custom_1.settings');
        $config->set('custom_1.source_text', $form_state->getValue('source_text'));
        $config->set('custom_1.page_title', $form_state->getValue('page_title'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }

    /**
    * {@inheritdoc}
    */
    protected function getEditableConfigNames() {
        return [
            'custom_1.settings',
    ];
  }
}