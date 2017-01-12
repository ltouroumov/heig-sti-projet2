<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 10:59 AM
 */

use App\Service\ClassControllerResolver;
use App\Service\NodeControllerResolver;

return function($app) {

    $app->extend('resolver', function ($resolver, $app) {
        return new NodeControllerResolver(__DIR__ . '/../controllers', $app, $resolver, $app['callback_resolver']);
    });

    $app->extend('resolver', function ($resolver, $app) {
        return new ClassControllerResolver($app, $resolver, $app['callback_resolver']);
    });

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/../views',
    ));

};