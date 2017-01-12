<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    $stmt = $app['db']->executeQuery(
        "SELECT * 
         FROM users u"
    );

    return $app['twig']->render('admin/users/index.twig', [
        'users' => $stmt->fetchAll()
    ]);
};