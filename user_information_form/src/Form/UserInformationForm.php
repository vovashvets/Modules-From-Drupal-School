<?php

namespace Drupal\user_information_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class UserInformationForm extends FormBase {

  public function getFormId() {
    return 'user_information_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('User Information Form is example of work with Form API.<br> You can try to submit this form.'),
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Your Name'),
      '#description' => $this->t('Required.'),
      '#required' => TRUE,
    ];

    $form['colour_radios'] = [
      '#type' => 'radios',
      '#title' => $this->t('Pick your favourite colour'),
      '#description' => $this->t('Or chose "Other" and enter you color.'),
      '#options' => [
        'blue' => $this->t('Blue'),
        'red' => $this->t('Red'),
        'white' => $this->t('White'),
        'black' => $this->t('Black'),
        'other' => $this->t('Other'),
      ],
      '#attributes' => [
        'name' => 'field_select_colour',
      ],
      //add the #states property to the radios
      '#states' => [
        'enabled' => [
          //enable the radios only if the custom color textbox is empty
          ':input[name="field_custom_colour"]' => ['value' => ''],
        ],
      ],
    ];

    //this textfield will only be shown when the option 'Other'
    //is selected from the radios above.
    $form['custom_colour'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'Enter favourite colour',
      '#attributes' => [
        //also add static name and id to the textbox
        'id' => 'custom-colour',
        'name' => 'field_custom_colour',
      ],
      '#states' => [
        //show this textfield only if the radio 'other' is selected above
        'visible' => [
          ':input[name="field_select_colour"]' => ['value' => 'other'],
        ],
      ],
    ];

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('name');
    if (strlen($name) < 4) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('name', $this->t('The name must be at least 4 characters long.'));
    }
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
     * This would normally be replaced by code that actually does something
     * with the title.
     */
    $name = $form_state->getValue('name');
    $this->messenger()->addMessage($this->t('Thank you %name for submit, but this form wont\'t do anything. It just for demonstration Form API.', ['%name' => $name]));

  }
}
