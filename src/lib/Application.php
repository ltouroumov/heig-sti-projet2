<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 1/12/17
 * Time: 2:42 PM
 */

namespace App;

use Silex\Application\SecurityTrait;

class Application extends \Silex\Application
{
    use SecurityTrait;

    public function user() {
        return $this['security.token_storage']->getToken()->getUser();
    }
}