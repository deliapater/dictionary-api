<?php

namespace Drupal\dictionary\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for calling an API with an input and updating a block.
 */
class DictionaryController extends ControllerBase {

  /**
   * Calls the API with the given input.
   *
   * @param string $input
   *   The input value.
   *
   * @return array
   *   The API response as a render array.
   */
  public function callApi($input) {
    dd('got here');
    $response = my_api_module_make_api_call($input);

    // Return the response as a render array.
    return [
      '#markup' => $response,
    ];
  }

}