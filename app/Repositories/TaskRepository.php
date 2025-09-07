<?php

namespace App\Repositories;

use App\Contracts\TaskRepositoryInterface;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(): Collection
    {
        return Task::all();
    }

    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task->fresh();
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    public function findByUser(User $user): Collection
    {
        return $user->tasks()->get();
    }

    public function findCompletedByUser(User $user): Collection
    {
        return $user->tasks()->where('completed', true)->get();
    }

    public function findPendingByUser(User $user): Collection
    {
        return $user->tasks()->where('completed', false)->get();
    }
}