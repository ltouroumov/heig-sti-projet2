<?php

require(__DIR__ . '/../vendor/autoload.php');

// Load the application
$app = (require __DIR__ . '/../src/boot.php')();
// Start it
$app['debug'] = true;
$app->run();