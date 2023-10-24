<?php

namespace PtteM\Service\Feed;

use PtteM\Interface\Feed\FeedInterface;
use SimpleXMLElement;

final class XmlService extends AbstractFeedService implements FeedInterface
{
    private string $feederName;

    public function setFeederName(string $feederName): void
    {
        $this->feederName = $feederName;
    }

    public function saveToFileDocument(): void
    {
        $productsData = $this->getProductsData();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><products></products>');

        foreach ($productsData as $product) {
            $productNode = $xml->addChild('product');
            $productNode->addChild('id', $product['id']);
            $productNode->addChild('name', $product['name']);
            $productNode->addChild('price', $product['price']);
        }

        $xml->asXML(__DIR__ . '/../../../public/' . $this->feederName . '.xml');
    }

    public function showToDocument(): array
    {
        return $this->getProductsData();
    }
}