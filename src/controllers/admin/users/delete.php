<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {

    $userId = $request->attributes->get('id');

    if ($userId != $app->user()->getId()) {
        $app['db']->update('users', [
            'deleted' => 1
        ],[
            'id' => $userId
        ]);

        $app['session']->getFlashBag()->add('success', 'User Removed');
    } else {
        $app['session']->getFlashBag()->add('warning', 'Suicide is Forbidden!');
    }

    return new Http\RedirectResponse($app['url_generator']->generate('admin_users'));
};