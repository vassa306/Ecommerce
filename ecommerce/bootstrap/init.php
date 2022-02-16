<?php
/**
 * start session if not already started
 */
if (! isset($_SESSION))
    session_start();
require_once __DIR__ . '/../app/config/_env.php';
require_once __DIR__ . '/../bootstrap/init.php';
new \app\classes\Database();

// set custom error handler
set_error_handler([new \app\Classes\ErrorHandler(),'handleErrors']);

require_once __DIR__ . '/../app/routing/routes.php';

new \app\RouteDispatcher($router);
?>
