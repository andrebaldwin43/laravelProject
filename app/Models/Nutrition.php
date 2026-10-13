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
        'carbohydrate',
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

    // function to get get all nutrition records for the current user and date and add them together
    public static function getDailyNutritionForUser($userId)
    {
        return self::where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->get()
            ->reduce(function ($carry, $item) {
                foreach ($item->getAttributes() as $key => $value) {
                    if (in_array($key, ['id', 'user_id', 'created_at', 'updated_at'])) {
                        continue;
                    }

                    $carry[$key] = ($carry[$key] ?? 0) + $value;
                }

                return $carry;

            }, []);
    }
}