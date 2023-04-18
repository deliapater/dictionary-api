<?php

namespace Drupal\dictionary_api\Controller;

class DictionaryApi extends ControllerBase {
    
    public function search() {
        
        return [
            '#type' => 'markup',
            '#markup' => $this->t('This is going to list movies.')
        ];
    }
}