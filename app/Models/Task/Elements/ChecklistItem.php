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
}
