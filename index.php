<?php

use App\Route;
use App\Controller\Feed\FeedController;
use App\Controller\DefaultController;
use Bootstrap\App;

require_once "bootstrap/App.php";

App::init();

require_once "app/Route.php";
require_once "app/Controller/DefaultController.php";
require_once "app/Controller/Feed/FeedController.php";
require_once "app/Service/Feed/JsonService.php";
require_once "app/Service/Feed/XmlService.php";

$route = new Route();

$route->get('/', function() {
    $defaultController = new DefaultController();

    $defaultController->index();
});

$route->get('/feed/:feeder/:format/:type', function($matches) {
    $feederName = $matches[1];
    $feedFormat = $matches[2];
    $feedType   = $matches[3];

    $feedController = new FeedController(new \App\Service\Feed\JsonService(), new \App\Service\Feed\XmlService());

    $feedController->setFeedValue($feederName, $feedFormat, $feedType);

    $checkFeed = $feedController->checkFeed();
    if (!$checkFeed) {
        return;
    }

    if ($feedFormat == "json") {
        $feedController->processToJson();

        return;
    }

    $feedController->processToXml();
});

$route->run();
