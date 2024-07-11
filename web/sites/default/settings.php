<?php


$databases['default']['default'] = [
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'host' => 'db',
  'port' => '3306',
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
   ];

   $config_directories = [
    'CONFIG_SYNC_DIRECTORY' => 'sites/default/files/config_sync',
  ];
  
  $settings['hash_salt'] = 'random-hash-salt';
  
  $settings['update_free_access'] = FALSE;
  
  $settings['file_private_path'] = 'sites/default/files/private';
  
  $settings['file_temp_path'] = 'sites/default/files/tmp';