<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calories',
        'protein',
        'carbs',
        'fat',
        'fiber',
        'sugar',
        'cholesterol',
        'sodium',
        'saturated_fat'
    ];

    protected $table = 'nutrition';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}