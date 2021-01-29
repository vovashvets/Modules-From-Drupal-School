<?php

namespace Drupal\content_event_entity\Form;

use Drupal\Core\Entity\Form\DeleteMultipleForm as EntityDeleteMultipleForm;
use Drupal\Core\Url;

/**
 * Provides a event deletion confirmation form.
 *
 * @internal
 */
class DeleteMultiple extends EntityDeleteMultipleForm {

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.event.collection');
  }

  /**
   * {@inheritdoc}
   */
  protected function getDeletedMessage($count) {
    return $this->formatPlural($count, 'Deleted @count event item.', 'Deleted @count events items.');
  }

  /**
   * {@inheritdoc}
   */
  protected function getInaccessibleMessage($count) {
    return $this->formatPlural($count, "@count event item has not been deleted because you do not have the necessary permissions.", "@count events items have not been deleted because you do not have the necessary permissions.");
  }

}
