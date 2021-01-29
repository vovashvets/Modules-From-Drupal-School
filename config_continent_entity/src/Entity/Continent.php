<?php

namespace Drupal\config_continent_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the continent entity.
 *
 * The lines below, starting with '@ConfigEntityType,' are a plugin annotation.
 * These define the entity type to the entity type manager.
 *
 * The properties in the annotation are as follows:
 *  - id: The machine name of the entity type.
 *  - label: The human-readable label of the entity type. We pass this through
 *    the "@Translation" wrapper so that the multilingual system may
 *    translate it in the user interface.
 *  - handlers: An array of entity handler classes, keyed by handler type.
 *    - access: The class that is used for access checks.
 *    - list_builder: The class that provides listings of the entity.
 *    - form: An array of entity form classes keyed by their operation.
 *  - entity_keys: Specifies the class properties in which unique keys are
 *    stored for this entity type. Unique keys are properties which you know
 *    will be unique, and which the entity manager can use as unique in database
 *    queries.
 *  - links: entity URL definitions. These are mostly used for Field UI.
 *    Arbitrary keys can set here. For example, User sets cancel-form, while
 *    Node uses delete-form.
 *
 * @see http://previousnext.com.au/blog/understanding-drupal-8s-config-entities
 * @see annotation
 * @see Drupal\Core\Annotation\Translation
 *
 * @ingroup continent
 *
   * @ConfigEntityType(
 *   id = "continent",
 *   label = @Translation("Continent"),
 *   admin_permission = "administer continents",
 *   handlers = {
 *     "access" = "Drupal\config_continent_entity\ContinentAccessController",
 *     "list_builder" = "Drupal\config_continent_entity\Controller\ContinentListBuilder",
 *     "form" = {
 *       "add" = "Drupal\config_continent_entity\Form\ContinentAddForm",
 *       "edit" = "Drupal\config_continent_entity\Form\ContinentEditForm",
 *       "delete" = "Drupal\config_continent_entity\Form\ContinentDeleteForm"
 *     }
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "name" = "name"
 *   },
 *   links = {
 *     "edit-form" = "/continents/manage/{continent}",
 *     "delete-form" = "/continents/manage/{continent}/delete"
 *   },
 *   config_export = {
 *     "id",
 *     "name",
 *     "code",
 *   }
 * )
 */
class Continent extends ConfigEntityBase {

  /**
   * The continent ID.
   *
   * @var string
   */
  public $id;

  /**
   * The continent Name.
   *
   * @var string
   */
  public $name;

  /**
   * The continent Code.
   *
   * @var string
   */
  public $code;
}
