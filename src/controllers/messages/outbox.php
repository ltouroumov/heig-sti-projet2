<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    $stmt = $app['db']->executeQuery(
        "SELECT m.id, m.sent_date, m.is_read, m.subject, us.username as sender_name, ur.username as recipient_name 
         FROM messages m
         JOIN users ur ON m.recipient = ur.id
         JOIN users us ON m.sender = us.id
         WHERE sender = ?
         ORDER BY sent_date DESC",
        [$app->user()->getId()]
    );

    return $app['twig']->render('messages/index.twig', [
        'messages' => $stmt->fetchAll(),
        'title' => 'Outbox',
        'show_controls' => false
    ]);
};