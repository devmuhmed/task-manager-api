<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDueDates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $tasks = Task::dueSoon()->get();
        foreach ($tasks as $task) {
            Notification::create([
                'user_id' => $task->user_id,
                'message' => "Task '{$task->title}' is due soon.",
            ]);
        }
    }
}
