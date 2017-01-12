<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    return $app['twig']->render('admin/index.twig');
};