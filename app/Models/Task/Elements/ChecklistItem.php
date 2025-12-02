<?php

namespace App\Models\Task\Elements;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'checklist_items';

    protected $fillable = [
        'checklist_id',
        'description',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }

    /**
     * Marca o item como concluído.
     *
     * @return bool
     */
    public function markCompleted(): bool
    {
        $this->is_completed = true;
        return $this->save();
    }

    /**
     * Marca o item como pendente.
     */
    public function markPending(): bool
    {
        $this->is_completed = false;
        return $this->save();
    }

    /**
     * Alterna o estado de is_completed.
     */
    public function toggle(): bool
    {
        $this->is_completed = ! $this->is_completed;
        return $this->save();
    }
}
