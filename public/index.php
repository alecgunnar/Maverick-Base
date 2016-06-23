<?php

use Maverick\Application;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

$root = dirname(__DIR__);

require $root . '/vendor/autoload.php';

$app = new Maverick\Application();

$container = require($root . '/app/config/container.php');
$app->withContainer($container);

$app->initialize()
    ->run(ServerRequest::fromGlobals(), new Response());
