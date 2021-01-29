<?php

namespace Drupal\config_continent_entity;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines an access controller for the robot entity.
 *
 * We set this class to be the access controller in Continent's entity annotation.
 *
 * @see \Drupal\continent\Entity\Continent
 *
 * @ingroup continent
 */
class ContinentAccessController extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  public function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    // The $opereration parameter tells you what sort of operation access is
    // being checked for.
    if ($operation == 'view') {
      return AccessResult::allowed();
    }
    // Other than the view operation, we're going to be insanely lax about access.
    return parent::checkAccess($entity, $operation, $account);
  }

}
