<?php

namespace Drupal\content_event_entity\Plugin\Action;

use Drupal\Core\Action\Plugin\Action\PublishAction;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Publishes a event.
 *
 * @deprecated in drupal:8.5.0 and is removed from drupal:9.0.0.
 *   Use \Drupal\Core\Action\Plugin\Action\PublishAction instead.
 *
 * @see \Drupal\Core\Action\Plugin\Action\PublishAction
 * @see https://www.drupal.org/node/2919303
 *
 * @Action(
 *   id = "event_publish_action",
 *   label = @Translation("Publish selected events"),
 *   type = "event"
 * )
 */
class PublishEvent extends PublishAction {

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $entity_type_manager);
    @trigger_error(__NAMESPACE__ . '\PublishEvent is deprecated in Drupal 8.5.x, will be removed before Drupal 9.0.0. Use \Drupal\Core\Action\Plugin\Action\PublishAction instead. See https://www.drupal.org/node/2919303.', E_USER_DEPRECATED);
  }

}
