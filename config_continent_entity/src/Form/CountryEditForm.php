<?php

namespace Drupal\config_continent_entity\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class CountryEditForm.
 *
 * Provides the edit form for our Country entity.
 *
 * @ingroup country
 */
class CountryEditForm extends CountryFormBase {

  /**
   * Returns the actions provided by this form.
   *
   * For the edit form, we only need to change the text of the submit button.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   *
   * @return array
   *   An array of supported actions for the current entity form.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = $this->t('Update Country');
    return $actions;
  }

}
