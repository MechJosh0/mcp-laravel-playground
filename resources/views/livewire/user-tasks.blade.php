<?php

use App\Models\User;
use App\Services\TaskService;
use Livewire\Volt\Component;

new class extends Component
{
    public User $user;
    
    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function toggleTask($taskId)
    {
        $task = $this->user->tasks()->findOrFail($taskId);
        app(TaskService::class)->toggleTaskCompletion($task);
        $this->user->refresh();
    }

    public function with(): array
    {
        return [
            'tasks' => $this->user->tasks()->orderBy('created_at', 'desc')->get(),
            'completedCount' => $this->user->tasks()->where('completed', true)->count(),
            'pendingCount' => $this->user->tasks()->where('completed', false)->count(),
        ];
    }
}; ?>

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Tasks</h2>
            <p class="text-gray-600 dark:text-gray-400">Manage {{ $user->name }}'s tasks</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <div class="text-2xl font-bold text-green-600">{{ $completedCount }}</div>
                <div class="text-sm text-gray-500">Completed</div>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-blue-600">{{ $pendingCount }}</div>
                <div class="text-sm text-gray-500">Pending</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        @if($tasks->count() > 0)
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Created
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($tasks as $task)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($task->completed)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                ✓ Completed
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                ⏳ Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $task->title }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            {{ Str::limit($task->description, 80) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $task->created_at->diffForHumans() }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="toggleTask({{ $task->id }})"
                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ $task->completed ? 'Mark as Pending' : 'Mark as Completed' }}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center py-12">
            <div class="text-gray-400 dark:text-gray-600 text-lg mb-4">📋</div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No tasks found</h3>
            <p class="text-gray-500 dark:text-gray-400">This user has no tasks assigned yet.</p>
        </div>
        @endif
    </div>
</div>