<?php

namespace Drupal\events_management\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Latest Events' Block.
 *
 * @Block(
 *   id = "latest_events_block",
 *   admin_label = @Translation("Latest Events Block"),
 * )
 * **/
class LatestEventsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'event')
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->range(0, 5);

    $nids = $query->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

    $items = [];
    foreach ($nodes as $node) {
      $items[] = [
        'title' => $node->getTitle(),
        'url' => $node->toUrl()->toString(),
      ];
    }

    return [
      '#theme' => 'item_list',
      '#items' => $items,
      '#title' => $this->t('Latest Events'),
    ];
  }

}
