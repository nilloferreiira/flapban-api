<?php

namespace App\Models\Task\Elements;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_checklist';

    protected $fillable = [
        'task_id',
        'title',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function items()
    {
        return $this->hasMany(ChecklistItem::class, 'checklist_id');
    }
}
