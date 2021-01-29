<?php
namespace Drupal\latest_node_block_derivative\Plugin\Block;

use Drupal\Component\Utility\Html;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides block with latest nodes chosen content type.
 *
 * @Block(
 *   id = "latest_node_block_derivative",
 *   category = "Latest nodes",
 *   deriver = "Drupal\latest_node_block_derivative\Plugin\Derivative\LatestNodesBlockDeriver"
 * )
 */
class LatestNodesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $nodeStorage;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->nodeStorage = $entity_type_manager->getStorage('node'); // Get entity type node
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager') // Get Entity type manager service
    );
  }

  public function defaultConfiguration() {
    return [
      'limit' => 5
    ];
  }

  public  function blockForm($form, FormStateInterface $form_state) {
    $form['limit'] = [
      '#type' => 'number',
      '#title' => $this->t('How many link will be in block'),
      '#min' => 1,
      '#max' => 20,
      '#default_value' => $this->configuration['limit']
    ];
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['limit'] = $form_state->getValue('limit');
  }

  public function build() {
    $node_type = $this->getDerivativeId(); // Get content type name (node bundle name)
    $node_ids = $this
      ->nodeStorage
      ->getQuery()
      ->condition('status', NodeInterface::PUBLISHED)
      ->range(0, $this->configuration['limit'])
      ->sort('created', 'DESC')
      ->execute();

    $nodes = $this->nodeStorage->loadMultiple($node_ids);

    $modifier_class = Html::getClass('latest-nodes-list--' . str_replace('_', '-', $node_type));

    $build['content'] = [
      '#type' => 'html_tag',
      "#tag" => 'ul',
      '#attributes' => [
        'class' => ['latest-content-list', $modifier_class]
      ]
    ];

    foreach ($nodes as $node) {
      $link = [
        '#type' => 'link',
        '#title' => $node->label(),
        '#uri' => $node->toUrl('canonical', ['absolute' => TRUE]),
        '#attributes' => ['class' => 'latest-content-list-link'],
      ];

      $build['content'][] = [
        '#type' => 'html_tag',
        "#tag" => 'li',
        '#attributes' => ['class' => 'latest-content-list-item'],
        '0' => $link,
      ];
    }

    if (empty($node_ids)) {
      return [
        '#title' => $this->t('You have not any created nodes')
      ];
    }

    return $build;
  }
}
