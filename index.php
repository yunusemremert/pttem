<?php

use Bootstrap\App;
use PtteM\Controller\DefaultController;
use PtteM\Controller\Feed\FeedController;
use PtteM\Route;

require_once "bootstrap/App.php";

App::init();

require 'vendor/autoload.php';

$route = new Route();

$route->get('/', function() {
    $defaultController = new DefaultController();

    $defaultController->index();
});

$route->get('/feed/:feeder/:format/:type', function($matches) {
    $feederName = $matches[1];
    $feedFormat = $matches[2];
    $feedType   = $matches[3];

    $feedController = new FeedController(new \PtteM\Service\Feed\JsonService(), new \PtteM\Service\Feed\XmlService());

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
