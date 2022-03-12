<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'blog_id', 'parent_id', 'message', 'status'];

    public function scopeAddComment($query)
    {
        $request = request();

        $parent_id = $request->parent_id ? $request->parent_id : 0;

        $user_id = Auth::user()->id;

        $comment = $this->create([
            'user_id' => $user_id,
            'blog_id' => $request->blog_id,
            'parent_id' => $parent_id,
            'message' => $request->message,
        ]);

        return $comment;
    }

    // User comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Blog comment
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Parent comment
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
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
