<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'phone', 'message'];

    public function scopeFilterByDate($query)
    {

        $start_date = request()->start_date;

        $end_date = request()->end_date;

        if ($start_date && $end_date) {

            $start_date = Carbon::create($start_date);

            $end_date = Carbon::create($end_date);

            $start_date->toDateTimeString();

            $end_date->toDateTimeString();

            // $query->whereBetween('reservation_from', [$from, $to])->get();

            $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        }

        return $query;
    }
}
