<?php

namespace Drupal\limited_textarea\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\StringTextareaWidget;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'limited_textarea' widget.
 *
 * @FieldWidget(
 *   id = "limited_textarea",
 *   label = @Translation("Text area with symbols limit"),
 *   field_types = {
 *     "string_long"
 *   }
 * )
 */
class LimitedTextareaWidget extends StringTextareaWidget{

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
        'limit' => '300',
      ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element = parent::settingsForm($form, $form_state);

    $element['limit'] = [
      '#type' => 'number',
      '#title' => t('Limit'),
      '#default_value' => $this->getSetting('limit'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    $summary[] = t('Limit: @limit', ['@limit' => $this->getSetting('limit')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element,$form, $form_state);

    $element['value']['#attributes']['id'][] = 'limited-textarea';
    $element['value']['#attributes']['maxlength'] = $this->getSetting('limit');
    $element['value']['#attached']['library'][] = 'limited_textarea/limited_textarea_style';
    $element['value']['#suffix'] = '<div id="symbol-limit-wrapper">
                    <span id="symbol-count">0</span>
                    <span id="symbol-limit">/</span>
                </div>';
    return $element;
  }

}
