<?php

namespace Drupal\switch_checkbox_widget\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\BooleanCheckboxWidget;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'switch_checkbox' widget.
 *
 * @FieldWidget(
 *   id = "switch_checkbox",
 *   label = @Translation("Custom Switch checkbox"),
 *   field_types = {
 *     "boolean"
 *   },
 *   multiple_values = TRUE
 * )
 */
class SwitchCheckboxWidget extends BooleanCheckboxWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $main_widget = parent::formElement($items, $delta, $element, $form, $form_state);
    $main_widget['value']['#attributes']['class'][] = 'input-switch-checkbox';
    $main_widget['value']['#attached'] = [
      'library' => [
        'switch_checkbox_widget/switch-checkbox',
      ],
    ];

    return $main_widget;
  }
}
