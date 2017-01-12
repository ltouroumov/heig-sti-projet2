<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 9/23/16
 * Time: 6:05 PM
 */

namespace App\Service;

use Silex\CallbackResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

class NodeControllerResolver implements ControllerResolverInterface
{
    private $delegate;
    private $callbackResolver;
    private $controllers;
    private $app;
    private $path;

    const CLASS_PATTERN = '#@(\w+(/\w+)*)#';

    /**
     * Constructor.
     *
     * @param object $app Application container
     * @param ControllerResolverInterface $delegate A ControllerResolverInterface instance to delegate to
     * @param CallbackResolver            $callbackResolver   A service resolver instance
     */
    public function __construct($path, $app, ControllerResolverInterface $delegate, CallbackResolver $callbackResolver)
    {
        $this->path = $path;
        $this->app = $app;
        $this->delegate = $delegate;
        $this->callbackResolver = $callbackResolver;
        $this->controllers = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getController(Request $request)
    {
        $controller = $request->attributes->get('_controller', null);

        if (is_string($controller) && preg_match(self::CLASS_PATTERN, $controller)) {
            return $this->resolve($controller);
        } else {
            return $this->delegate->getController($request);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments(Request $request, $controller)
    {
        return $this->delegate->getArguments($request, $controller);
    }

    /**
     * @param $controllerName string Controller definition
     *
     * @return callable Controller Callback
     */
    private function resolve($controllerName)
    {
        $controllerFile = sprintf("%s/%s.php", $this->path, substr($controllerName, 1));

        if (!file_exists($controllerFile)) {
            throw new \InvalidArgumentException(sprintf("Controller %s could not be found", $controllerName));
        }

        $controller = require $controllerFile;

        if (!is_callable($controller)) {
            throw new \InvalidArgumentException(sprintf("Controller %s does not return a closure", $controllerName));
        }

        return $controller;
    }
}