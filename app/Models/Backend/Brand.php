<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, QueryFilter, SoftDeletes;

    protected $fillable = ['name', 'image', 'position', 'status'];

    // filter by filed
    protected $filterable = ['status'];

    public function scopeSearchName($query)
    {
        if (request()->search_name) {
            $query->where('name', 'LIKE', '%' . request()->search_name . '%');
        }

        return $query;
    }
}
