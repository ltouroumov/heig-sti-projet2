<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {

    $message = $app['db']->executeQuery(
        "SELECT id FROM messages WHERE id = ? AND recipient = ?",
        [$request->attributes->get('id'), $app->user()->getId()]
    )->fetch();

    if ($message != null) {
        $app['db']->delete('messages', [
            'id' => $message['id']
        ]);

        $app['session']->getFlashBag()->add('success', 'Message Deleted');
    } else {
        $app['session']->getFlashBag()->add('danger', 'Message not found!');
    }

    return new Http\RedirectResponse($app['url_generator']->generate('inbox'));
};