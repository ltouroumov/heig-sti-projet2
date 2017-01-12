<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    $stmt = $app['db']->executeQuery(
        "SELECT m.id, m.sent_date, m.is_read, m.subject, m.content, us.username as sender_name, ur.username as recipient_name, m.recipient
         FROM messages m
         JOIN users ur ON m.sender = ur.id
         JOIN users us ON m.sender = us.id
         WHERE m.id = :id AND (m.recipient = :user OR m.sender = :user)
         ORDER BY sent_date DESC",
        ['id' => $request->attributes->get('id'), 'user' => $app->user()->getId()]
    );

    $message = $stmt->fetch();

    if ($message !== null) {
        $isRecipient = $message['recipient'] == $app->user()->getId();
        if ($isRecipient) {
            $app['db']->executeUpdate(
                "UPDATE messages m SET m.is_read = 1 WHERE m.id = ?",
                [$message['id']]
            );
        }

        return $app['twig']->render('messages/show.twig', [
            'message' => $message,
            'show_controls' => $isRecipient
        ]);
    } else {
        return new Http\Response(null, 404);
    }
};