<?php
namespace Drupal\latest_node_block_derivative\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LatestNodesBlockDeriver extends DeriverBase implements ContainerDeriverInterface {

  protected $entityTypeBundleInfo;

  public function __construct(EntityTypeBundleInfoInterface $entityTypeBundleInfo) {
    $this->entityTypeBundleInfo = $entityTypeBundleInfo;
  }

  public static function create(ContainerInterface $container, $base_plugin_id) {
    return new static(
      $container->get('entity_type.bundle.info')
    );
  }

  public function getDerivativeDefinitions($base_plugin_definition) {
    $node_types = $this->entityTypeBundleInfo->getBundleInfo('node');

    foreach ($node_types as $type => $type_info) {
      $this->derivatives[$type] = $base_plugin_definition;

      $admin_label = 'Latest nodes of ' . $type_info['label'];
      $this->derivatives[$type]['admin_label'] = $admin_label;
    }
    return $this->derivatives;
  }
}
