<?php

namespace App\Contracts;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Task;
    public function create(array $data): Task;
    public function update(Task $task, array $data): Task;
    public function delete(Task $task): bool;
    public function findByUser(User $user): Collection;
    public function findCompletedByUser(User $user): Collection;
    public function findPendingByUser(User $user): Collection;
}