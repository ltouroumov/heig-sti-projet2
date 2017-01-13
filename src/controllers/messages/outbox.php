<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    $stmt = $app['db']->executeQuery(
        "SELECT m.id, m.sent_date, m.is_read, m.subject, m.content,
                us.id as sender_id, us.username as sender_name,
                ur.id as recipient_id, ur.username as recipient_name 
         FROM messages m
         JOIN users ur ON m.recipient = ur.id
         JOIN users us ON m.sender = us.id
         WHERE m.sender = ? AND m.deleted = 0
         ORDER BY m.sent_date DESC",
        [$app->user()->getId()]
    );

    return $app['twig']->render('messages/index.twig', [
        'messages' => $stmt->fetchAll(),
        'title' => 'Outbox',
        'show_controls' => false
    ]);
};