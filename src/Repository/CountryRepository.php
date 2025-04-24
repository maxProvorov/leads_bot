<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\CountryDto;

class CountryRepository extends ApiRepository
{

    public function __construct(
        string $apiToken,
        private string $countriesUrl)
    {
        parent::__construct($apiToken);
    }

    public function getCountries(): array
    {
        $data = $this->sendRequest($this->countriesUrl);

        return array_map(function($countryData) {
            return new CountryDto($countryData);
        }, $data['data'] ?? []);
    }
}