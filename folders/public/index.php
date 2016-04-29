<?php
require '../vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
));

// Create monolog logger and store logger in container as singleton 
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Define routes
$app->get('/', function () use ($app) {
    // Sample log message
    $app->log->info("Slim-Skeleton '/' route");
    // Render index view
    $app->render('index.html');
});

// API group
$app->group('/api', function () use ($app) {
    // folders group
    $app->group('/folder', function () use ($app) {
        // GET /folder
        $app->get('/', function () use ($app) {
            // Return list of folders (folders.json)
        });

        // POST /folder
        $app->post('/', function () use ($app) {
            // Add new folder
        });

        // PUT /folder/:id
        $app->put('/:id', function ($id) use ($app) {
            // Edit folder name with IndexRowID = :id
        });

        // DELETE /folder/:id
        $app->delete('/:id', function ($id) use ($app) {
            // Delete folder with IndexRowID = :id
        });
    });
    // workpapers group
    $app->group('/workpaper', function () use ($app) {
        // GET /workpaper
        $app->get('/', function () use ($app) {
            // Return list of workpapers (workpapers.json)
        });

        // POST /workpaper
        $app->post('/', function() use ($app) {
            // Add new workpaper
        });

        // DELETE /workpaper/:id
        $app->delete('/:id', function ($id) use ($app) {
            // Delete workpaper with FormRef =:id
        });
    });
});

// Run app
$app->run();
