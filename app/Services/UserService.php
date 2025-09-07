<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    public function getAllUsersWithTasks(): Collection
    {
        return $this->userRepository->withTasks()->all();
    }

    public function findUser(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user): bool
    {
        return $this->userRepository->delete($user);
    }
}