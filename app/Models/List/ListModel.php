<?php

namespace App\Models\List;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lists';

    protected $fillable = [
        'name',
    ];
}
