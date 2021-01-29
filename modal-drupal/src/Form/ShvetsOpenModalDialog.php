<?php

namespace Drupal\shvets_dialog\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;


class ShvetsOpenModalDialog extends FormBase {
  public function getFormId() {
    return "shvets_openmodal_form";
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['form_name'] = [
      '#type' => 'select',
      '#title' => $this->t('Form Title Here'),
      '#options' => [
        '-1' => $this->t('Nothing select'),
        '0' => $this->t('Option 1'),
        '1' => $this->t('Option 2'),
        '2' => $this->t('Option 3'),
      ],
      '#ajax' => [
        '#event' => 'change',
        'callback' => '::openModalDialog',
        'disable-refocus' => FALSE,
        'wrapper' => "my-custom-class",
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Progress message here.')
        ],
      ],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit btn text')
    ];

    return $form;
  }

  public function openModalDialog(&$form, $form_state) {
    $value = $form_state->getValue('form_name');
    $valueName = $form['form_name']['#options'][$value];

    $dialogText['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $dialogText['#markup'] = "Your selected value is: $valueName";

    $response = new AjaxResponse();
    $response->addCommand(new OpenModalDialogCommand('Dialog Title and selected value ', $dialogText, ['width' => 300]));

    return $response;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }
}
