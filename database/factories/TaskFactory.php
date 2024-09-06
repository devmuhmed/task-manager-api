<?php

namespace Database\Factories;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'priority' => $this->faker->randomElement(TaskPriorityEnum::toValues()),
            'status' => $this->faker->randomElement(TaskStatusEnum::toValues()),
        ];
    }
}
