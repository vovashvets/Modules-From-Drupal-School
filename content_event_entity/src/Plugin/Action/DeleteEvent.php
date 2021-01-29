<?php

namespace Drupal\content_event_entity\Plugin\Action;

use Drupal\Core\Action\Plugin\Action\DeleteAction;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;

/**
 * Redirects to a node deletion form.
 *
 * @deprecated in drupal:8.6.0 and is removed from drupal:9.0.0.
 *   Use \Drupal\Core\Action\Plugin\Action\DeleteAction instead.
 *
 * @see \Drupal\Core\Action\Plugin\Action\DeleteAction
 * @see https://www.drupal.org/node/2934349
 *
 * @Action(
 *   id = "event_delete_action",
 *   label = @Translation("Delete events"),
 *   type = "event",
 *   confirm_form_route_name = "entity.event.delete_multiple_form"
 * )
 */
class DeleteEvent extends DeleteAction {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, PrivateTempStoreFactory $temp_store_factory, AccountInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $entity_type_manager, $temp_store_factory, $current_user);
    @trigger_error(__NAMESPACE__ . '\DeleteEvent is deprecated in Drupal 8.6.x, will be removed before Drupal 9.0.0. Use \Drupal\Core\Action\Plugin\Action\DeleteAction instead. See https://www.drupal.org/node/2934349.', E_USER_DEPRECATED);
  }

}
