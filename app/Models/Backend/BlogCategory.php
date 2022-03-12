<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes, QueryFilter;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'image', 'description', 'status'];

    // filter by filed
    protected $filterable = ['status'];

    // Get categories active
    public function categoryActives()
    {
        return self::where('status', 1)->get();
    }

    // Check the blog number belongs to the blog categories
    public function blogOfBlogCategories()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }

    public function scopeSearchName($query)
    {
        if (request()->search_name) {
            $query->where('name', 'LIKE', '%' . request()->search_name . '%');
        }

        return $query;
    }
}
