<?php

namespace Drupal\events_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends ControllerBase {
  public function listEvents() {
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'event')
      ->condition('status', 1);

    // Check the configuration to see if past events should be shown.
    $show_past_events = \Drupal::config('events_management.settings')->get('show_past_events');
    if (!$show_past_events) {
      $query->condition('field_event_start_time', date('Y-m-d\TH:i:s'), '>=');
    }

    $nids = $query->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

    $items = [];
    foreach ($nodes as $node) {
      $items[] = [
        'title' => $node->getTitle(),
        'image' => $node->get('field_event_image')->entity ? $node->get('field_event_image')->entity->url() : '',
        'description' => $node->get('field_event_description')->value,
        'start_time' => $node->get('field_event_start_time')->value,
        'end_time' => $node->get('field_event_end_time')->value,
        'category' => $node->get('field_event_category')->entity ? $node->get('field_event_category')->entity->label() : '',
        'url' => $node->toUrl()->toString(),
      ];
    }

    return [
      '#theme' => 'events_list',
      '#items' => $items,
      '#title' => $this->t('Upcoming Events'),
    ];
  }

  public function eventDetail($event) {
    $node = \Drupal\node\Entity\Node::load($event);
    return [
      '#theme' => 'event_detail',
      '#event' => [
        'title' => $node->getTitle(),
        'image' => $node->get('field_event_image')->entity ? $node->get('field_event_image')->entity->url() : '',
        'description' => $node->get('field_event_description')->value,
        'start_time' => $node->get('field_event_start_time')->value,
        'end_time' => $node->get('field_event_end_time')->value,
        'category' => $node->get('field_event_category')->entity ? $node->get('field_event_category')->entity->label() : '',
      ],
    ];
  }
}
