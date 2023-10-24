<?php

namespace PtteM\Controller\Feed;

use PtteM\Constant\Feed\FeedFormatConstants;
use PtteM\Controller\AbstractBaseController;
use PtteM\FeederList;
use PtteM\Service\Feed\JsonService;
use PtteM\Service\Feed\XmlService;
use SimpleXMLElement;

class FeedController extends AbstractBaseController
{
    private string $feederName;
    private string $feedFormat;
    private string $feedType;

    public function __construct(
        private readonly JsonService $jsonService,
        private readonly XmlService $xmlService
    )
    {
    }

    public function setFeedValue(string $feederName, string $feedFormat, string $feedType): void
    {
        $this->feederName = $feederName;
        $this->feedFormat = $feedFormat;
        $this->feedType = $feedType;
    }

    public function checkFeed(): bool
    {
        if (!FeederList::isFeederValid($this->feederName)) {
            $this->jsonResponseMessage("false", "Feeder is not registered in the system.", 400);

            return false;
        }

        if (!in_array($this->feedFormat, FeedFormatConstants::formatTypes)) {
            $this->jsonResponseMessage("false", "Feed format is incorrect.", 400);

            return false;
        }

        return true;
    }

    public function processToJson(): void
    {
        $this->jsonService->setFeederName($this->feederName);

        if ($this->feedType == "file") {
            try {
                $this->jsonService->saveToFileDocument();

                $this->responseMessageCreated();
            } catch (\Exception $e) {
                $this->responseMessageFailed($e->getTraceAsString());
            }

            return;
        }

        $document = $this->jsonService->showToDocument();

        $this->jsonFeedResponse($document, 200);
    }

    public function processToXml(): void
    {
        $this->xmlService->setFeederName($this->feederName);

        if ($this->feedType == "file") {
            try {
                $this->xmlService->saveToFileDocument();

                $this->responseMessageCreated();
            } catch (\Exception $e) {
                $this->responseMessageFailed($e->getTraceAsString());
            }

            return;
        }

        $document = $this->xmlService->showToDocument();

        $this->xmlFeedResponse($document, 200);
    }

    private function responseMessageCreated(): void
    {
        $this->jsonResponseMessage("true", "Feed created.", 201);
    }

    private function responseMessageFailed(string $message): void
    {
        $this->jsonResponseMessage("false", $message, 500);
    }

    private function xmlFeedResponse(array $message): void
    {
        http_response_code(200);

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><products></products>');

        foreach ($message as $product) {
            $productNode = $xml->addChild('product');
            $productNode->addChild('id', $product['id']);
            $productNode->addChild('name', $product['name']);
            $productNode->addChild('price', $product['price']);
        }

        header('Content-Type: text/xml');

        echo $xml->asXML();
    }
}