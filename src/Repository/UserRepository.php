<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\UserDto;

class UserRepository extends ApiRepository
{

    public function __construct(
        string $apiToken,
        private string $userUrl)
    {
        parent::__construct($apiToken);
    }

    public function getUser(): UserDto
    {
        $data = $this->sendRequest($this->userUrl);
        return new UserDto($data['data'] ?? []);
    }
}