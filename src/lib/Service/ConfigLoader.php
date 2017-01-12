<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 1/12/17
 * Time: 9:34 AM
 */

namespace App\Service;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class ConfigLoader
{
    private $locator;

    public function __construct(FileLocator $locator)
    {
        $this->locator = $locator;
    }

    public function load($name, callable $processor = null) {
        $files = $this->locator->locate($name, null, false);

        $config = [];

        foreach ($files as $file) {
            $tmp = Yaml::parse(file_get_contents($file));
            $config = array_merge_recursive($config, $tmp);
        }

        if ($processor !== null) {
            return call_user_func($processor, $config);
        } else {
            return $config;
        }
    }
}