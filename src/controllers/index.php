<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 11:10 AM
 */

use Symfony\Component\HttpFoundation as Http;

return function(Http\Request $request, Silex\Application $app) {
    $stmt = $app['db']->executeQuery(
        "SELECT m.id, m.sent_date, m.is_read, m.subject, us.username as sender_name, ur.username as recipient_name 
         FROM messages m
         JOIN users ur ON m.recipient = ur.id
         JOIN users us ON m.sender = us.id
         WHERE m.recipient = ? AND m.is_read = 0 AND m.deleted = 0
         ORDER BY m.sent_date DESC",
        [$app->user()->getId()]
    );

    $form = $app['form.factory']->createBuilder('forms.compose', null, [
        'ignore_user' => $app->user()->getId(),
        'content_rows' => 10
    ])->getForm();

    return $app['twig']->render('index.twig', [
        'messages' => $stmt->fetchAll(),
        'form' => $form->createView()
    ]);
};