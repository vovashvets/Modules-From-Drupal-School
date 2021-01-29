<?php

namespace Drupal\last_visit_time\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LastVisitTimeConfigForm extends ConfigFormBase {

  const DEFAULT_DATE_FORMAT = 'short';
  protected $dateFormatStorage;

  public function __construct(ConfigFactoryInterface $config_factory, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($config_factory);
    $this->dateFormatStorage = $entity_type_manager->getStorage('date_format');
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity_type.manager')
    );
  }

  public function getFormId() {
    return 'last_visit_time_settings';
  }

  protected function getEditableConfigNames() {
    return ['last_visit_time.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $people_last_visit_time_data = $this->config('last_visit_time.settings');
    $config_data_format = $people_last_visit_time_data->get('format');
    $default_value = isset($config_data_format) ? $people_last_visit_time_data->get('format') : self::DEFAULT_DATE_FORMAT;

    $formats = $this->dateFormatStorage->loadMultiple();
    foreach ($formats as $key => $format) {
      $formats_keys[$key] = $this->t("@format - @pattern", [
        '@format' => $format->label(),
        '@pattern' => $format->getPattern(),
      ]);
    }

    $form['people']['date_format'] = [
      '#type' => 'select',
      '#title' => t('Date format'),
      '#default_value' => $default_value,
      '#options' => $formats_keys,
      '#attributes' => ['class' => ['date-format-detect']],
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('last_visit_time.settings')
      ->set('format', $form_state->getValue('date_format'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
