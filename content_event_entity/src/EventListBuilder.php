<?php

namespace Drupal\content_event_entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Event entities.
 *
 * @ingroup content_event_entity
 */
class EventListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Event ID');
    $header['name'] = $this->t('Title');
    $header['event_url'] = $this->t('Url');
    $header['start'] = $this->t('Start');
    $header['finish'] = $this->t('Finish');
    $header['speaker'] = $this->t('Speaker');
    $header['status'] = $this->t('Published');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $date_formatter = \Drupal::service('date.formatter');

    /* @var \Drupal\content_event_entity\Entity\Event $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.event.edit_form',
      ['event' => $entity->id()]
    );
    $row['event_url'] = Link::fromTextAndUrl('room',
      Url::fromUri($entity->get('event_url')->getValue()[0]['uri']));
    $row['start'] = $date_formatter->format($entity->get('start')->date->getTimeStamp());
    $row['finish'] = $date_formatter->format($entity->get('finish')->date->getTimeStamp());
    $row['speaker'] = $entity->get('speaker')->value;
    $row['status'] = $entity->get('status')->value ? 'Yes' : 'No';
    $row['operations']['data'] = $this->buildOperations($entity);
    return $row + parent::buildRow($entity);
  }

}
