<?php

namespace Drupal\custom_access_pages\Controller;

use Drupal\Core\Controller\ControllerBase;

class RegularUserController extends ControllerBase {
  /*
   * Render array with Twig template
   */
  public function regularUserRender() {

    return [
      '#theme' => 'regular_page',
      '#custom_content' => $this->t('Important Information'),
    ];
  }
}
