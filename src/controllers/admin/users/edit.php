<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    $user = $app['db']->executeQuery(
        "SELECT * FROM users WHERE id = ?",
        [$request->attributes->get('id')]
    )->fetch();

    $user['enabled'] = $user['enabled'] === '1';

    $form = $app['form.factory']->createBuilder(\App\Form\UserFormType::class, $user)
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        if ($data['plain_password'] !== null) {
            $encoder = $app['security.default_encoder'];
            $password = $encoder->encodePassword($data['plain_password'], null);
        } else {
            $password = $user['password'];
        }

        if ($user['id'] == $app->user()->getId()) {
            $app['session']->getFlashBag()->add('warning', "You can't disable yourself!");
            $enabled = true;
        } else {
            $enabled = $data['enabled'];
        }

        $app['db']->update('users', [
            'username' => $data['username'],
            'password' => $password,
            'roles' => $data['roles'],
            'enabled' => $enabled
        ], ['id' => $user['id']]);

        $app['session']->getFlashBag()->add('success', 'User updated');

        return new Http\RedirectResponse($app['url_generator']->generate('admin_users'));
    }

    return $app['twig']->render('admin/users/form.twig', [
        'is_edit' => true,
        'user' => $user,
        'form' => $form->createView()
    ]);
};