<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_calories',
        'date',
        'user_id',
    ];

    protected $table = 'calorie';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}