<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 10:59 AM
 */

use App\Service\ClassControllerResolver;
use App\Service\ConfigLoader;
use App\Service\NodeControllerResolver;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Validator\Constraints as Assert;

return function($app) {

    $app['config_loader'] = function() use ($app) {
        $locator = new FileLocator(__DIR__);
        return new ConfigLoader($locator);
    };

    $app['markdown'] = function() {
        $md = new \cebe\markdown\GithubMarkdown();
        $md->enableNewlines = true;
        return $md;
    };

    $app->extend('resolver', function ($resolver, $app) {
        return new NodeControllerResolver(__DIR__ . '/../controllers', $app, $resolver, $app['callback_resolver']);
    });

    $app->extend('resolver', function ($resolver, $app) {
        return new ClassControllerResolver($app, $resolver, $app['callback_resolver']);
    });

    $app->register(new Silex\Provider\SessionServiceProvider());

    $app->register(new Silex\Provider\TwigServiceProvider(), [
        'twig.path' => __DIR__ . '/../views',
        'twig.form.templates' => ['bootstrap_3_layout.html.twig']
    ]);

    $app->extend('twig', function($twig, $app) {
        $twig->addFunction(new \Twig_Function('markdown', function ($string) use ($app) {
            return $app['markdown']->parse($string);
        }), ['pre_escape' => 'html', 'is_safe' => ['all']]);

        return $twig;
    });

    $app->register(new Silex\Provider\LocaleServiceProvider(), [
        'locale' => 'en'
    ]);

    $app->register(new Silex\Provider\TranslationServiceProvider(), [
        'translator.domains' => [],
    ]);

    $app->register(new Silex\Provider\CsrfServiceProvider());

    $app->register(new Silex\Provider\ValidatorServiceProvider());

    $app->register(new Silex\Provider\FormServiceProvider());

    $app['forms.user'] = function () use ($app) {
        return new \App\Form\UserFormType($app);
    };

    $app['forms.compose'] = function() use ($app) {
        return new \App\Form\ComposeFormType($app['db']);
    };

    $app->extend('form.types', function ($types) use ($app) {
        $types[] = 'forms.user';
        $types[] = 'forms.compose';
        return $types;
    });

    $app['app_user_provider'] = function () use ($app) {
        return new \App\UserProvider($app['db']);
    };

    $app->register(new Silex\Provider\SecurityServiceProvider(),
        $app['config_loader']->load('security.yml', function ($config) use ($app) {
            foreach ($config['security.firewalls'] as $fwName => &$fwConfig) {
                if (isset($fwConfig['user_provider'])) {

                    $providerName = $fwConfig['user_provider'];
                    $fwConfig['users'] = function() use ($providerName, $app) {
                        return $app[$providerName];
                    };
                    unset($fwConfig['user_provider']);

                }
            }
            return $config;
        })
    );

    $app['security.default_encoder'] = function ($app) {
        return $app['security.encoder.bcrypt'];
    };

    $app->register(new Silex\Provider\DoctrineServiceProvider(), $app['config_loader']->load('database.yml'));

    $app['security.password_constraints'] = [
        new Assert\Length(['min' => 12])
    ];

};