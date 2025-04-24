<?php

declare(strict_types=1);

namespace App\Repository;

class ApiRepository
{
    public function __construct(private string $apiToken)
    {}

    protected function sendRequest(string $url): array
    {
        $fullUrl = $url . '?token=' . $this->apiToken;
        $response = file_get_contents($fullUrl);

        return json_decode($response, true);
    }
}