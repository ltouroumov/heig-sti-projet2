<?php

use Symfony\Component\HttpFoundation as Http;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Validator\Constraints as Assert;

return function (Http\Request $request, Silex\Application $app) {
    $user = $app['db']->executeQuery(
        "SELECT * FROM users WHERE id = ?",
        [$app->user()->getId()]
    )->fetch();

    $form = $app['form.factory']->createBuilder(Type\FormType::class)
        ->add('plain_password', Type\RepeatedType::class, [
            'type' => Type\PasswordType::class,
            'required' => false,
            'first_options' => [
                'label' => 'Password',
            ],
            'second_options' => [
                'label' => 'Repeat Password',
            ],
            'constraints' => $app['security.password_constraints']
        ])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        if ($data['plain_password'] !== null) {
            $encoder = $app['security.default_encoder'];
            $password = $encoder->encodePassword($data['plain_password'], null);


            $app['db']->update('users', [
                'password' => $password,
            ], ['id' => $app->user()->getId()]);

            $app['session']->getFlashBag()->add('success', 'Password updated');
        }

        return new Http\RedirectResponse($app['url_generator']->generate('profile'));
    }

    return $app['twig']->render('profile.twig', [
        'user' => $user,
        'form' => $form->createView()
    ]);
};