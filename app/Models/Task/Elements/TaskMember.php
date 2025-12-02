<?php

namespace App\Models\Task\Elements;

use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_members';

    protected $fillable = [
        'task_id',
        'user_id',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function addMember(Task $task, User $user): self
    {
        // evita duplicata
        $existing = self::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            return $existing; // ou retornar null ou lançar uma exceção
        }

        return self::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
        ]);
    }

    public static function removeMember(Task $task, User $user): bool
    {
        $membership = self::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->first();

        if (! $membership) {
            return false;
        }

        return (bool) $membership->delete(); // soft delete
    }

    public static function isMember(Task $task, User $user): bool
    {
        return self::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->exists();
    }
}
