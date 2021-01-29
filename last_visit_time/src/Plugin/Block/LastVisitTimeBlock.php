<?php

namespace Drupal\last_visit_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 * @Block(
 *   id = "last_visit_time_block_plugin",
 *   admin_label = @Translation("Last Visit Time"),
 *   category = "Last Visit"
 * )
 */
class LastVisitTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $account;
  protected $config_factory;
  protected $date_formatter;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $account, ConfigFactoryInterface $config_factory, DateFormatterInterface $date_formatter) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
    $this->config_factory = $config_factory;
    $this->date_formatter = $date_formatter;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('config.factory'),
      $container->get('date.formatter')
    );
  }

  public function build() {
    if($this->account->isAuthenticated()) {
      $last_accessed_time = $this->account->getLastAccessedTime();
      $format = $this->config_factory->get('last_visit_time.settings')->get('format');
      $time = $this->date_formatter->format($last_accessed_time, $format);
      $markup = "<p>Last visited time: <b>{$time}</b></p>";
    } else {
      $markup = "<p>It's time to log in!</p>";
    }

    $build['last_visit_time'] = [
      '#markup' => $markup,
      '#cache' => [
        'max-age' => 0,
      ]
    ];

    return $build;
  }

}
