<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Fitness extends Model
{
    use HasFactory;

    public static function levels() {
        return [
            '1.2'   => 'Sedentary',
            '1.375' => 'Lightly active',
            '1.55'  => 'Moderately active',
            '1.725' => 'Very active',
            '1.9'   => 'Super active'
        ];
    }

    protected $table = 'fitness'; 

    protected $fillable = [
        'daily_calories',
        'current_weight',
        'target_weight',
        'height_ft',
        'height_in',
        'age',  
        'fitness_level',
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