<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function all(): Collection
    {
        return $this->query->get();
    }

    public function find(int $id): ?User
    {
        return $this->query->find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function withTasks(): UserRepositoryInterface
    {
        $this->query = $this->query->with('tasks');
        return $this;
    }
}