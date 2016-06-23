<?php

use League\Container\Container;

$container = new Container();

/**
 * Configuration
 */

$container->add('system.config.routes_file', __DIR__ . '/routes.php');

$container->add('app.config', [
    'twig.templates_dir' => dirname(__DIR__) . '/templates',
    'twig.cache_dir' => null
]);

/*
 * Controllers
 */

$container->add('controller.index', function() {
    return new App\Controller\IndexController();
});

$container->inflector('App\Controller\AbstractController')
    ->invokeMethod('setTemplateLoader', ['twig.environment']);

/*
 * Twig
 */

$container->add('twig.environment', function() use($container) {
    $config = $container->get('app.config');

    return new Twig_Environment($container->get('twig.loader'), [
        'cache' => $config['twig.cache_dir']
    ]);
});

$container->add('twig.loader', function() use($container) {
    $config = $container->get('app.config');
    return new Twig_Loader_Filesystem($config['twig.templates_dir']);
});

return $container;
