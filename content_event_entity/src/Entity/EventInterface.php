<?php

namespace Drupal\content_event_entity\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Event entities.
 *
 * @ingroup content_event_entity
 */
interface EventInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Event name.
   *
   * @return string
   *   Name of the Event.
   */
  public function getName();

  /**
   * Sets the Event name.
   *
   * @param string $name
   *   The Event name.
   *
   * @return \Drupal\content_event_entity\Entity\EventInterface
   *   The called Event entity.
   */
  public function setName($name);

  /**
   * Gets the Event creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Event.
   */
  public function getCreatedTime();

  /**
   * Sets the Event creation timestamp.
   *
   * @param int $timestamp
   *   The Event creation timestamp.
   *
   * @return \Drupal\content_event_entity\Entity\EventInterface
   *   The called Event entity.
   */
  public function setCreatedTime($timestamp);

}
