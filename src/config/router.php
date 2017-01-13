<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 10:59 AM
 */

use Symfony\Component\HttpFoundation as Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return function(Silex\Application $app) {

    $app->get('/', '@index')->bind('home');

    $app->match('/compose', '@compose')->bind('compose');
    $app->get('/inbox', '@messages/inbox')->bind('inbox');
    $app->get('/outbox', '@messages/outbox')->bind('outbox');
    $app->get('/inbox/{id}', '@messages/show')->bind('message_view');
    $app->get('/inbox/{id}/rm', '@messages/delete')->bind('message_rm');

    $app->get('/outbox/{id}', '@outbox/show')->bind('outbox_view');

    $app->get('/login', '@login');
    $app->match('/profile', '@profile')->bind('profile');

    $app->mount('/admin', function($admin) use ($app) {
        $admin->get('/', '@admin/index')->bind('admin');
        $admin->get('/users', '@admin/users/index')->bind('admin_users');
        $admin->match('/users/new', '@admin/users/new')->bind('admin_user_new');
        $admin->match('/users/{id}', '@admin/users/edit')->bind('admin_user_edit');
        $admin->match('/users/{id}/rm', '@admin/users/delete')->bind('admin_user_rm');
    });
    // $app->match('/logout', '@logout');

    $app->error(function(\Exception $e, Http\Request $request, $code) use ($app) {
        return $app['twig']->render('404.twig', [
            'message' => $e->getMessage()
        ]);
    });

};