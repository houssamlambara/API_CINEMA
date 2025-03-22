<?php

namespace App\Repository\Interface;

interface UserInterface
{
    public function All();
    public function register(array $data);
    public function login(array $credentials);
    public function logout();
    public function update(array $data);
}
