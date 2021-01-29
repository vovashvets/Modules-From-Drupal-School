<?php

namespace Drupal\content_event_entity\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\link\LinkItemInterface;

/**
 * Defines the Event entity.
 *
 * @ingroup content_event_entity
 *
 * @ContentEntityType(
 *   id = "event",
 *   label = @Translation("Event"),
 *   label_collection = @Translation("Events"),
 *   label_singular = @Translation("event"),
 *   label_plural = @Translation("events"),
 *   label_count = @PluralTranslation(
 *     singular = "@count event",
 *     plural = "@count events",
 *   ),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\content_event_entity\Entity\EventViewsData",
 *     "list_builder" = "Drupal\content_event_entity\EventListBuilder",
 *     "translation" = "Drupal\content_event_entity\EventTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\content_event_entity\Form\EventForm",
 *       "add" = "Drupal\content_event_entity\Form\EventForm",
 *       "edit" = "Drupal\content_event_entity\Form\EventForm",
 *       "delete" = "Drupal\content_event_entity\Form\EventDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\content_event_entity\Form\DeleteMultiple"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\content_event_entity\EventHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\content_event_entity\EventAccessControlHandler",
 *   },
 *   base_table = "event",
 *   data_table = "event_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer event entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/event/{event}",
 *     "add-form" = "/event/add",
 *     "delete-multiple-form" = "/admin/structure/events/event/delete",
 *     "edit-form" = "/event/{event}/edit",
 *     "delete-form" = "/event/{event}/delete",
 *     "collection" = "/admin/structure/events"
 *   },
 *   field_ui_base_route = "entity.event.collection"
 * )
 */
class Event extends ContentEntityBase implements EventInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Event entity.'))
      ->setTranslatable(TRUE)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -8,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -8,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['event_url'] = BaseFieldDefinition::create('link')
      ->setLabel(t('Url'))
      ->setDescription(t('Link to the conference room online.'))
      ->setTranslatable(TRUE)
      ->setRequired(TRUE)
      ->setSettings(array(
        'link_type' => LinkItemInterface::LINK_GENERIC,
        'title' => DRUPAL_DISABLED,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'link_default',
        'weight' => -7,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['start'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Start'))
      ->setDescription(t('Date and time of the event start.'))
      ->setTranslatable(TRUE)
      ->setRequired(TRUE)
      ->setSettings([
        'datetime_type' => 'datetime'
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['finish'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Finish'))
      ->setDescription(t('Date and time of the event finish.'))
      ->setTranslatable(TRUE)
      ->setRequired(TRUE)
      ->setSettings([
        'datetime_type' => 'datetime'
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['speaker'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Speaker'))
      ->setDescription(t("Event's speaker"))
      ->setTranslatable(TRUE)
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the Event is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
