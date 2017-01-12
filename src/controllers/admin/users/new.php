<?php

use Symfony\Component\HttpFoundation as Http;

return function (Http\Request $request, Silex\Application $app) {
    $form = $app['form.factory']->createBuilder(\App\Form\UserFormType::class, [], [
        'requires_password' => true
    ])->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        $encoder = $app['security.default_encoder'];
        $password = $encoder->encodePassword($data['plain_password'], null);

        $app['db']->insert('users', [
            'username' => $data['username'],
            'password' => $password,
            'roles' => $data['roles'],
            'enabled' => $data['enabled']
        ]);

        $app['session']->getFlashBag()->add('success', 'User Created');

        return new Http\RedirectResponse($app['url_generator']->generate('admin_users'));
    }

    return $app['twig']->render('admin/users/form.twig', [
        'is_edit' => false,
        'user' => ['id' => 0],
        'form' => $form->createView()
    ]);
};