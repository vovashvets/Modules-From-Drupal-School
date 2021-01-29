<?php

namespace Drupal\custom_access_pages\Controller;

use Drupal\Core\Controller\ControllerBase;

class AnonymousController extends ControllerBase {
  /*
   * Render array
   */
  public function anonymousUserRender() {
    return [
      '#title' => 'Hello, Anonymous User! This is a special page just anonymous.',
      '#markup' => 'Drupal is content management software. It\'s used to make many of the websites and applications
      you use every day. Drupal has great standard features, like easy content authoring, reliable performance,
      and excellent security. But what sets it apart is its flexibility; modularity is one of its core principles.
      Its tools help you build the versatile, structured content that dynamic web experiences need.',
    ];
  }
}
