<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'image_name'];

    protected $hidden = ['created_at', 'updated_at'];

    // Insert images
    public function createRoomImage($room, $imageName)
    {
        self::create([
            'room_id' => $room->id,
            'image_name' => $imageName,
        ]);
    }

    // Delete RoomImage by room id
    public function deleteRoomImage($room_id)
    {
        self::where('room_id', $room_id)->delete();
    }
}
