<?php

namespace Drupal\dictionary\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Component\Serialization\Json;

/**
 * Provides a form for calling an API with an input and updating a block.
 */
class DictionaryForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_api_module_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['input'] = [
      '#type' => 'textfield',
      '#title' => t('Input'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
      '#ajax' => [
        'callback' => [$this, 'myCallbackMethod'],
        'wrapper' => 'my-api-response',
      ],
    ];
     // Add a container for the definition.
    $form['definition'] = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'definition-container',
      ],
    ];

    return $form;
  }

  public function myCallbackMethod(array &$form, FormStateInterface $form_state) {
      $input = $form_state->getValue('input');

      // Make an API call with Drupal's built-in HTTP client.
      $url = 'https://api.dictionaryapi.dev/api/v2/entries/en/' . $input;
      $response = \Drupal::httpClient()->get($url);

      // Get the response body.
      $response_body = (string) $response->getBody();
      $response_data = Json::decode($response_body);

      // Get the definition of the first result.
      $definition = '';
      if (!empty($response_data[0]['meanings'][0]['definitions'][0]['definition'])) {
        $definition = $response_data[0]['meanings'][0]['definitions'][0]['definition'];
      }

      // Return the response as an Ajax command.
      $ajax_response = new \Drupal\Core\Ajax\AjaxResponse();
      $ajax_response->addCommand(new \Drupal\Core\Ajax\HtmlCommand('#definition-container', $definition));

      return $ajax_response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Nothing to do here since we are using Ajax.
  }

}