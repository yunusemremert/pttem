<?php

namespace App\Controller;

abstract class AbstractBaseController
{
    protected function jsonResponseMessage(string $status, array|string $message, int $code): void
    {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message
        ];

        http_response_code($code);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    protected function jsonFeedResponse(array $message, int $code): void
    {
        http_response_code($code);

        echo json_encode($message, JSON_PRETTY_PRINT);
    }
}