<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes, QueryFilter;

    protected $fillable = ['title', 'slug', 'blog_category_id', 'image', 'content', 'admin_id', 'status'];

    protected $filterable = ['blog_category_id', 'status'];

    public function scopeAddNewBlog($query, $request, $image)
    {
        $request->only(['title', 'image', 'blog_category_id', 'slug',  'status', 'content']);

        $blog = Blog::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'image' => $image,
            'blog_category_id' => $request->blog_category_id,
            'content' => $request->content,
        ]);

        return $blog;
    }

    // Category of blog
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    // Blog of admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Comment of blog
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearchTitle($query)
    {
        if (request()->search_title) {
            $query->where('title', 'LIKE', '%' . request()->search_title . '%');
        }

        return $query;
    }
}
