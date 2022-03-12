<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, QueryFilter, SoftDeletes;

    protected $fillable = ['title', 'content', 'image', 'position', 'status', 'price'];

    // filter by filed
    protected $filterable = ['status', 'position'];

    public function scopeSearchTitle($query)
    {
        if (request()->search_title) {
            $query->where('title', 'LIKE', '%' . request()->search_title . '%');
        }

        return $query;
    }
}
