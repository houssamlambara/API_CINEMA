<?php

namespace App\Services;

use App\Repository\Interface\UserInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
            return $this->userRepository->register($data);
        }

        public function login(array $credentials)
        {
            return $this->userRepository->login($credentials);
        }

        public function logout()
        {
            return $this->userRepository->logout();
    }
}