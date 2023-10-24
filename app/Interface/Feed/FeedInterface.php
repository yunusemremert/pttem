<?php

namespace PtteM\Interface\Feed;

interface FeedInterface
{
    public function saveToFileDocument(): void;
    public function showToDocument(): array;
}