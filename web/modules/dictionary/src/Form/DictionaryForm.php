<?php

namespace Drupal\dictionary\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use GuzzleHttp\Client;

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
    return $form;
  }

  public function myCallbackMethod(array &$form, FormStateInterface $form_state) {
    $input = $form_state->getValue('input');

    // Make an API call with GuzzleHttp\Client.
    $client = new Client(['base_uri' => 'https://api.dictionaryapi.dev/api/v2/entries/en/']);
    $response = $client->request('GET', $input);

    // Get the response body.
    $response_body = (string) $response->getBody();

    // Return the response as an Ajax command.
    $ajax_response = new \Drupal\Core\Ajax\AjaxResponse();
    $ajax_response->addCommand(new \Drupal\Core\Ajax\HtmlCommand('#my-api-response', $response_body));

    return $ajax_response;
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Nothing to do here since we are using Ajax.
  }

}