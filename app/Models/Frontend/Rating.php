<?php

namespace App\Models\Frontend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'star', 'message', 'status'];

    public function scopeAddRating($query, $request)
    {
        $review = self::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'star' => $request->star,
            'message' => $request->message,
        ]);

        return $review;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSort($query, $sort)
    {
        if ($sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }
    }
}
