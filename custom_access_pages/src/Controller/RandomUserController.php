<?php

namespace Drupal\custom_access_pages\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;

class RandomUserController extends ControllerBase {
  /*
   * This function check access permission
   * ONLY authorized users have access to link menu for this page
   */
  public function access(AccountInterface $account) {
    return AccessResult::allowedIf($this->customCondition());
//    For multiple access condition use it:
//    return AccessResult::allowedIf($account->hasPermission('access content') && $this->customCondition());
  }

  /**
   * This function give us random number from 0 to 7
   * and if this number is 5 than user can see this page
   * @return bool
   */
  public function customCondition(){
    $rand_num = rand(0, 7);

    if ($rand_num == 5) {
      $key_to_page = TRUE; // TRUE
    } else {
      $key_to_page = FALSE; // FALSE
    }

    return $key_to_page;
  }

  /*
   * Render array
   */
  public function randomUserRender() {
    return [
      '#title' => 'Hello, Special User!',
      '#markup' => 'This page only visible to special users! Congrats, You are special user!',
    ];
  }
}
