<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CountryRepository;

class CountryService
{
    public function __construct(private CountryRepository $countryRepository)
    {}

    public function getLast10Countries(): array
    {
        $countries = $this->countryRepository->getCountries();

        usort($countries, function($a, $b) {
            return strcmp($b->name, $a->name);
        });

        return array_slice($countries, 0, 10);
    }
}