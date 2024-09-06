<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        });

        $query->when($filters['category_id'] ?? null, function ($query, $category_id) {
            $query->where('category_id', $category_id);
        });

        $query->when($filters['due_date'] ?? null, function ($query, $due_date) {
            $query->whereDate('due_date', $due_date);
        });
    }

    public function scopeDueSoon($query)
    {
        return $query->where('due_date', '<=', now()->addDays(2));
    }
}
