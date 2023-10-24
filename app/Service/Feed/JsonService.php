<?php

namespace PtteM\Service\Feed;

use PtteM\Interface\Feed\FeedInterface;

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