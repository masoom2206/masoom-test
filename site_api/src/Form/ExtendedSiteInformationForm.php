<?php

namespace Drupal\site_api\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Callback Class ExtendedSiteInformationForm()
 */
class ExtendedSiteInformationForm extends SiteInformationForm {
  /**
   * Callback function buildForm()
   * to add a custom field in site info for site API 
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_config = $this->config('system.site');
    $form =  parent::buildForm($form, $form_state);
    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => t('Site API Key'),
      '#default_value' => $site_config->get('siteapikey') ?: '',
      '#description' => t("Custom field to set the API Key"),
      '#attributes' => [
        'placeholder' => t("No API Key yet"),
      ]
    ];
    return $form;
  }
  /**
   * Submit handler for custom field 
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();
    parent::submitForm($form, $form_state);
    drupal_set_message(t("Site API key '".$form_state->getValue('siteapikey')."' has been saved"));
  }
}
