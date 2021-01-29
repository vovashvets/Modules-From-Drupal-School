<?php

namespace Drupal\enabled_modules_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal;

/**
 * Provides a 'Enabled Modules Block' block.
 *
 * @Block(
 *   id = "enabled_modules_block",
 *   admin_label = @Translation("Enabled Modules Block")
 * )
 */
class EnabledModulesBlock extends BlockBase {

  public function build() {
    $machine_names = array_keys(Drupal::moduleHandler()->getModuleList());
    $readable_modules_name = []; //Empty array for array_push in foreach

    foreach ($machine_names as $name) {
      array_push($readable_modules_name, Drupal::moduleHandler()->getName($name));
    }

    $modules_names = implode(', ', $readable_modules_name);

    return array(
      '#title' => $this->t('This is you current enabled modules:'),
      '#markup' => $modules_names,
    );
  }
}

