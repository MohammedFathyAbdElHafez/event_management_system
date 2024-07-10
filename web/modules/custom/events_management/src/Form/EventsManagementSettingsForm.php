<?php

namespace Drupal\events_management\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Events Management settings for this site.
 */
class EventsManagementSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'events_management_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['events_management.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('events_management.settings');

    $form['show_past_events'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show past events'),
      '#default_value' => $config->get('show_past_events'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('events_management.settings');
    $previous_value = $config->get('show_past_events');
    $new_value = $form_state->getValue('show_past_events');

    if ($previous_value !== $new_value) {
      // Log configuration change.
      \Drupal::database()->insert('events_management_log')
        ->fields([
          'uid' => \Drupal::currentUser()->id(),
          'timestamp' => \Drupal::time()->getRequestTime(),
          'message' => 'Changed show_past_events setting from ' . $previous_value . ' to ' . $new_value,
        ])
        ->execute();
    }

    $config->set('show_past_events', $new_value)->save();

    parent::submitForm($form, $form_state);
  }

}
