<?php

use Symfony\Component\HttpFoundation as Http;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Validator\Constraints as Assert;

return function (Http\Request $request, Silex\Application $app) {
    $model = [];

    if ($request->query->has('to')) {
        $tmp = $app['db']->executeQuery(
            "SELECT u.id FROM users u WHERE u.enabled = 1 AND u.username = ?",
            [$request->query->get('to')]
        )->fetch();

        $model = ['recipient' => $tmp['id']];
    }
    else if ($request->query->has('re')) {
        $tmp = $app['db']->executeQuery(
            "SELECT m.subject, m.sent_date, m.content, m.sender
             FROM messages m
             WHERE m.id = ? AND m.recipient = ?",
            [$request->query->get('re'), $app->user()->getId()]
        )->fetch();

        if ($tmp) {
            $model = [
                'recipient' => $tmp['sender'],
                'subject' => sprintf("Re: %s", $tmp['subject']),
                'content' => sprintf("\n\n---\nSubject: %s\nSent: %s\n%s", $tmp['subject'], $tmp['sent_date'], $tmp['content'])
            ];
        }
    }

    $form = $app['form.factory']->createBuilder('forms.compose', $model)->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        $app['db']->insert('messages', [
            'sender' => $app->user()->getId(),
            'recipient' => $data['recipient'],
            'sent_date' => date('Y-m-d H:m:s'),
            'subject' => $data['subject'],
            'content' => $data['content']
        ]);

        $app['session']->getFlashBag()->add('success', 'Message Sent');

        return new Http\RedirectResponse($app['url_generator']->generate('inbox'), 201);
    }

    return $app['twig']->render('compose.twig', [
        'form' => $form->createView()
    ]);
};