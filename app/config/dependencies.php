<?php
// DIC configuration
$container = $app->getContainer();

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
  return function ($request, $response) use ($c) {
    return $c['response']
      ->withStatus(404)
      ->withHeader('Content-Type', 'text/html')
      ->write('404 Dude!');
  };
};

// monolog
$container['logger'] = function ($c) {
  $settings = $c->get('settings');
  $logger = new Monolog\Logger($settings['logger']['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
  return $logger;
};

$container[App\Controller\BlogController::class] = function ($c) {
  return new App\Controller\BlogController($c->logger);
};
