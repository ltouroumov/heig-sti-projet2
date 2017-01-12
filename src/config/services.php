<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 10:59 AM
 */

use App\Form\UserFormType;
use App\Service\ClassControllerResolver;
use App\Service\ConfigLoader;
use App\Service\NodeControllerResolver;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;

return function($app) {

    $app['config_loader'] = function() use ($app) {
        $locator = new FileLocator(__DIR__);
        return new ConfigLoader($locator);
    };

    $app['markdown'] = function() {
        return new \cebe\markdown\GithubMarkdown();
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
        $twig->addFilter(new \Twig_Filter('markdown', function ($string) use ($app) {
            return $app['markdown']->parse($string);
        }), ['is_safe' => ['html']]);

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

    $app->extend('form.types', function ($types) use ($app) {
        // $types[] = new UserFormType($app);
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
        // Plain text (e.g. for debugging)
        return new PlaintextPasswordEncoder();
    };

    $app->register(new Silex\Provider\DoctrineServiceProvider(), $app['config_loader']->load('database.yml'));


};