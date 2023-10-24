<?php

namespace app\Interface\Feed;

interface FeedInterface
{
    public function saveToFileDocument(): void;
    public function showToDocument(): array;
}