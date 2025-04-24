<?php

declare(strict_types=1);

namespace App\Dto;

class CountryDto
{
    public $id;
    public $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}