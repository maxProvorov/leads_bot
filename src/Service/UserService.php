<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\UserDto;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {}

    public function getUserInfo(): UserDto
    {
        return $currentUser = $this->userRepository->getUser();
    }
}