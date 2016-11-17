<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 11:10 AM
 */

use Symfony\Component\HttpFoundation as Http;

return function(Http\Request $request, Silex\Application $app) {
    return $app->render('index');
};