<?php

namespace App\Models\Backend;

use App\Models\Frontend\Order;
use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes, QueryFilter;

    protected $fillable = ['name', 'image', 'category_id', 'slug', 'price', 'sale_price', 'status', 'bed', 'bath', 'area', 'quantity', 'description'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $filterable = ['category_id', 'price', 'bed', 'bath', 'area'];


    // Category of room
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Image detail
    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function scopeRoomByCategory($query)
    {
        $slug = request()->slug;

        if ($slug) {
            // Get category by slug
            $category = Category::where('slug', $slug)->first();
            // Check category exits
            if ($category) {
                $query = Room::where('category_id', $category->id);
            }
        }

        return $query;
    }

    public function filterName($query, $value)
    {
        $query->where('name', 'like', '%' . $value . '%');
        return $query;
    }

    public function scopeFilterPrice($query)
    {
        if (request()->price_from && request()->price_to) {
            $from = request()->price_from;
            $to = request()->price_to;

            $query->where('price', '>=', $from)->where('price', '<=', $to);
        }

        return $query;
    }

    public function scopeSortBy($query)
    {
        if (request()->sort_by) {
            $sort_by = request()->sort_by;

            switch ($sort_by) {
                case 'price-low-to-hight':
                    $query->orderBy('price', 'desc');
                    break;

                case 'price-hight-to-low':
                    $query->orderBy('price', 'asc');
                    break;

                case 'name-a-z':
                    $query->orderBy('name', 'asc');
                    break;

                case 'name-z-a':
                    $query->orderBy('name', 'desc');
                    break;

                default:
                    $query->oldest();
                    break;
            }
        }
    }
}
