<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    return $app['twig']->render('login.twig', [
        'error' => $app['security.last_error']($request)
    ]);
};
