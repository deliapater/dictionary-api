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