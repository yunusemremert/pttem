<?php

namespace App\Service\Feed;

use App\Interface\Feed\FeedInterface;

require_once "app/Service/Feed/AbstractFeedService.php";
require_once "app/Interface/Feed/FeedInterface.php";

final class JsonService extends AbstractFeedService implements FeedInterface
{
    private string $feederName;

    public function setFeederName(string $feederName): void
    {
        $this->feederName = $feederName;
    }

    public function saveToFileDocument(): void
    {
        $productsData = $this->getProductsData();

        $file = fopen(__DIR__ . '/../../../public/' . $this->feederName . '.json', 'w');

        fwrite($file, json_encode($productsData, JSON_PRETTY_PRINT));
    }

    public function showToDocument(): array
    {
        return $this->getProductsData();
    }
}