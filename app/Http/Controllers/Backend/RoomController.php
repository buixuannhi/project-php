<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreRoomRequest;
use App\Http\Requests\Backend\UpdateRoomRequest;
use App\Models\Backend\Category;
use App\Models\Backend\Room;
use App\Models\Backend\RoomImage;
use App\Models\Frontend\Order;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RoomController extends Controller
{

    protected $uploadService;
    protected $roomImage;
    protected $category;
    /**
     * Constructing global variable
     */
    public function __construct(
        UploadService $uploadService,
        RoomImage $roomImage,
        Category $category,
    ) {
        $this->uploadService = $uploadService;
        $this->roomImage = $roomImage;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 'List Rooms';

        $params = $request->all();

        $rooms = Room::latest()->filter($params)->filterPrice()->paginate(3);

        return view('backend.rooms.index', compact('rooms', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->categoryActives();

        $page = 'Add New Room';

        return view('backend.rooms.add', compact('categories', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        $room_name = $request->name;

        // Upload Room Avatar Handler => ImageName
        if ($request->hasFile('room_avatar')) {
            $file = $request->file('room_avatar');

            // Method UploadT
            $path = 'uploads/rooms/room_avatar';
            $imageName = $this->uploadService->uploadImageHandler($file, $room_name, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Insert rooms into the database
        $returned_room = Room::create($request->only(['name', 'image', 'category_id', 'slug', 'price', 'sale_price', 'status', 'bed', 'bath', 'area', 'quantity', 'description']));

        // Upload room image detail & Insert into database
        if ($request->hasFile('image_details')) {

            $files = $request->file('image_details');

            foreach ($files as $key => $file) {

                $imageNameDetail = $this->uploadService->uploadImageDetailHandler($file, $room_name, $key);

                // Insert into database 'room_images'
                $this->roomImage->createRoomImage($returned_room, $imageNameDetail);
            }
        }

        // Check Result
        return alertInsert($returned_room, 'rooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(Room::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Update Room';

        $categories = $this->category->categoryActives();
        $room_edit = Room::find($id);

        return view('backend.rooms.edit', compact('page', 'categories', 'room_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, $id)
    {

        $room_update = Room::find($id);

        $room_name = $request->name;

        // Upload Room Avatar
        if ($request->hasFile('room_avatar')) {

            $file = $request->file('room_avatar');

            // Remove old image
            $path_image_avatar = 'uploads/rooms/room_avatar/';
            $this->uploadService->deleteFile($room_update->image, $path_image_avatar);

            // Upload new file
            $image_name = $this->uploadService->uploadImageHandler($file, $room_name, $path_image_avatar);

            // Merge field image -> request
            $request->merge(['image' => $image_name]);
        }

        // Upload room image detail & Insert into database
        if ($request->hasFile('image_details')) {

            $files = $request->file('image_details');

            // Remove old file
            if ($room_update->roomImages) {
                foreach ($room_update->roomImages as $image_file) {
                    $path_image_detail = 'uploads/rooms/room_details/';
                    $this->uploadService->deleteFile($image_file->image_name, $path_image_detail);
                }
            }

            // Remove old image details from database
            RoomImage::where('room_id', $id)->delete();

            // Upload new file
            foreach ($files as $key => $file) {
                $image_name_detail = $this->uploadService->uploadImageDetailHandler($file, $room_name, $key);

                // Insert into database RoomImage
                $this->roomImage->createRoomImage($room_update, $image_name_detail);
            }
        }

        // Update record in database
        $returned_room = $room_update->update($request->all());

        // Check Result
        return alertUpdate($returned_room, 'rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Room  $room
     * @return \Illuminate\Http\Response
     */

    function checkOrderOfRoom($orders, $room_id)
    {
        if ($orders) {
            foreach ($orders as $order) {
                if ($order) {
                    foreach ($order->orderDetails as $item) {
                        if ($item->room_id == $room_id) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    public function destroy($id)
    {
        $room_delete = Room::find($id);

        $orders = Order::all();

        $check = $this->checkOrderOfRoom($orders, $room_delete->id);

        // Check Relationship
        if ($check) {
            $message = 'Can\'t move record to trash! Because it belongs to a certain order !';
            return redirect()->back()->with('error', $message);
        }

        $room_delete->delete();

        return alertTrash($room_delete, 'rooms.index');
    }

    public function trash()
    {
        $page = 'Room Trash';

        $rooms_trash = Room::onlyTrashed()->get();

        return view('backend.rooms.trash', compact('page', 'rooms_trash'));
    }

    public function trashAction(Request $request)
    {

        // Action
        $action = $request->action;

        // Get id from request
        $action_id = $request->all();

        // Slice Token and Action
        $action_id = array_slice($action_id, 1, -1);

        // *** Action Restore *** \\
        if ($action === 'restore') {
            Room::withTrashed()->whereIn('id', $action_id)->restore();

            // Success
            return redirect()->back()->with('success', 'Record recovery successful !');
        } else {
            // *** Action Delete *** \\

            // Unlink Images
            foreach ($action_id as $id) {

                $room = Room::onlyTrashed()->find($id);

                $image_details = $room->roomImages;

                // Remove image from room_avatar
                $path_image_avatar = 'uploads/rooms/room_avatar/';
                $this->uploadService->deleteFile($room->image, $path_image_avatar);

                // Remove image from product_details
                if ($image_details) {
                    foreach ($image_details as $image_file) {
                        $path_image_detail = 'uploads/rooms/room_details/';
                        $this->uploadService->deleteFile($image_file->image_name, $path_image_detail);
                    }
                }

                // Remove RoomImage
                $this->roomImage->deleteRoomImage($id);
            }

            // Real delete
            Room::withTrashed()->whereIn('id', $action_id)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
