<?php

use Symfony\Component\HttpFoundation as Http;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Validator\Constraints as Assert;

return function (Http\Request $request, Silex\Application $app) {
    if ($request->query->has('to')) {
        $tmp = $app['db']->executeQuery(
            "SELECT u.id FROM users u WHERE u.enabled = 1 AND u.id = ?",
            [$app->user()->getId()]
        )->fetch();

        $recipient = $tmp['id'];
    } else {
        $recipient = null;
    }

    $form = $app['form.factory']->createBuilder('forms.compose')->getForm();

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