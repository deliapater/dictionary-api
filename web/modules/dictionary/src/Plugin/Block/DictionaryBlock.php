<?php

namespace Drupal\dictionary\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block for calling an API with an input and updating the response.
 *
 * @Block(
 *   id = "my_api_block",
 *   admin_label = @Translation("My API Block"),
 * )
 */
class DictionaryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Build the form and the response block.
    $form = \Drupal::formBuilder()->getForm('\Drupal\dictionary\Form\DictionaryForm');
    $response = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'my-api-response',
      ],
    ];

    // Return the render array for the block.
    return [
      'form' => $form,
      'response' => $response,
    ];
  }

}

// This file defines a Drupal block plugin that provides a block for calling an API with an input and updating the response. It extends the BlockBase
//  class and defines a build method which returns a render array for the block.

// In the build method, a form object is obtained by calling getForm on the formBuilder service, and a container element is created for the response
// with an ID of "my-api-response". Both the form and response are returned as elements in an associative array, with the keys "form" and "response",
// respectively.

// The block is identified by its ID, which is "my_api_block", and its admin label is set to "My API Block".