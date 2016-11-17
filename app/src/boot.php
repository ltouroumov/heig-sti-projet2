<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 11/17/16
 * Time: 10:55 AM
 */

return function() {

    $app = new Silex\Application();

    (require __DIR__.'/config/services.php')($app);
    (require __DIR__.'/config/router.php')($app);

    return $app;

};