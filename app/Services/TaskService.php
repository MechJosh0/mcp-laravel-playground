<?php

namespace App\Services;

use App\Contracts\TaskRepositoryInterface;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {}

    public function getAllTasks(): Collection
    {
        return $this->taskRepository->all();
    }

    public function findTask(int $id): ?Task
    {
        return $this->taskRepository->find($id);
    }

    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask(Task $task, array $data): Task
    {
        return $this->taskRepository->update($task, $data);
    }

    public function deleteTask(Task $task): bool
    {
        return $this->taskRepository->delete($task);
    }

    public function getUserTasks(User $user): Collection
    {
        return $this->taskRepository->findByUser($user);
    }

    public function getUserCompletedTasks(User $user): Collection
    {
        return $this->taskRepository->findCompletedByUser($user);
    }

    public function getUserPendingTasks(User $user): Collection
    {
        return $this->taskRepository->findPendingByUser($user);
    }

    public function toggleTaskCompletion(Task $task): Task
    {
        return $this->taskRepository->update($task, [
            'completed' => !$task->completed
        ]);
    }
}