# Event Management Module

## Description

The Event Management module is designed for Drupal 10 and provides a comprehensive system for managing events. Back-end users can create, update, delete, and manage events, while end-users can browse and view event details. Key features include an option to show or hide past events, a frontend listing page for published events, event details page, and a block displaying the latest five created events.

## Features

- Operations for events (List events, Event details)
- Configuration page to toggle the visibility of past events
- Custom database table for logging configuration changes
- Frontend page to list published events
- Frontend page for event details
- Frontend Drupal block to list the latest five created events

## Event Attributes

- **Title**: The title of the event
- **Image**: An image associated with the event
- **Description**: A detailed description of the event
- **Start Time**: The starting time of the event
- **End Time**: The ending time of the event
- **Category**: The category of the event

## Requirements

- Drupal 10
- MySQL 8
- PHP 8
- Docker

## Installation

### 1. Enable the Module

Use docker or the Drupal admin interface to enable the module:

- Using docker:
  ```bash
  docker-compose exec web drush en events_management -y
  docker-compose exec web drush cr
  ```

### Module structure:

├── events_management.info.yml
├── events_management.install
├── events_management.module
├── events_management.permissions.yml
├── events_management.routing.yml
├── README.md
├── src
│   ├── Controller
│   │   └── EventsController.php
│   ├── Form
│   │   └── EventsManagementSettingsForm.php
│   └── Plugin
│       └── Block
│           └── LatestEventsBlock.php
└── templates
    ├── event-detail.html.twig
    └── events-list.html.twig
