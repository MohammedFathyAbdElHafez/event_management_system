# Event Management System

## Description

This project sets up a Drupal 10 site using Docker for an 'Events Management' custom module. The module helps back-end users manage events that end-users can browse. It includes features such as CRUD operations for events, configuration settings to show or hide past events, and frontend pages and blocks to display events.


## Features

- Operations for events (List events, Event details)
- Configuration page to toggle the visibility of past events
- Custom database table for logging configuration changes
- Frontend page to list published events
- Frontend page for event details
- Frontend Drupal block to list the latest five created events


## Requirements

- Docker
- Docker Compose

## Project Setup

### 1. Clone the Repository

```bash
git clone https://github.com/MohammedFathyAbdElHafez/event_management_system.git
cd event_management_system
```
### 2. Install the project

- First method:
  ** You can install it be accessing Drupal admin interface to enable the module.

- Second method:
  ** You can use docker to install it:

  ```bash
    docker-compose exec web drush site:install standard --db-url=drupal://drupal:drupal@db/drupal --account-name=admin --account-pass=admin --site-name="Drupal Site"
  ```

### 3. Enable the Events Module

Use docker or the Drupal admin interface to enable the module:

- Using docker:
  ```bash
  docker-compose exec web drush en events_management -y
  docker-compose exec web drush cr
  ```

### 4. Access the drupal UI:

- You can access the drupal UI from this url by this credentials:
url: http://localhost:8080/
username: admin
password: admin

### 4. Install module:

- go to `admin/modules` and upload .zip file to module.
- install the module to access module routes.




