<?php
define('BASE_PATH', realpath(__DIR__ . '/../../'));
require_once __DIR__ . '/../../vendor/autoload.php';
$dotEnv = $dotEnv = \Dotenv\Dotenv::create(BASE_PATH);
$dotEnv->load();
