<?php

namespace App\Models\Task\Elements;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_links';

    protected $fillable = [
        'task_id',
        'title',
        'url',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
