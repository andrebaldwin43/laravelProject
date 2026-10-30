<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Macro extends Model
{
    use HasFactory;

    protected $table = 'macro';

    protected $fillable = [
        'user_id',
        'daily_calories',
        'daily_protein',
        'daily_carbohydrate',
        'daily_fat',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

