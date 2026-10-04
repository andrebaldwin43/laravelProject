<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Fitness extends Model
{
    use HasFactory;

    protected $table = 'fitness'; 

    protected $fillable = [
        'current_weight',
        'target_weight',
        'height',
        'age',
        'sex',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}