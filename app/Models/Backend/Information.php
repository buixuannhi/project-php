<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'informations';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'logo', 'email', 'phone', 'address', 'map'];
}
