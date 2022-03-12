<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreBannerRequest;
use App\Http\Requests\Backend\UpdateBannerRequest;
use App\Models\Backend\Banner;
use App\Services\UploadService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $uploadService;
    /**
     * Constructing global variable
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 'Banner Management';

        $params = $request->all();

        $banners = Banner::latest()->filter($params)->searchTitle()->paginate(3);

        return view('backend.banners.index', compact('page', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Add New Banners';

        return view('backend.banners.add', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $title = $request->title;

        // Upload banner Avatar Handler => ImageName
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');

            // Method Upload
            $path = 'uploads/banners';
            $imageName = $this->uploadService->uploadImageHandler($file, $title, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Insert banners into the database
        $returned_banner = Banner::create($request->all());

        // Check Result
        return alertInsert($returned_banner, 'banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Update Banner';

        $banner_edit = Banner::find($id);

        return view('backend.banners.edit', compact('page', 'banner_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $banner_update = Banner::find($id);

        $title = $request->title;

        // Upload banner Avatar Handler => ImageName
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');

            // Remove old image
            $path_image = 'uploads/banners';
            $this->uploadService->deleteFile($banner_update->image, $path_image);

            // Method Upload
            $path = 'uploads/banners';
            $imageName = $this->uploadService->uploadImageHandler($file, $title, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Update record in database
        $returned_banner = $banner_update->update($request->all());

        // Check Result
        return alertUpdate($returned_banner, 'banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner_delete = Banner::destroy($id);

        return alertTrash($banner_delete, 'banners.index');
    }

    public function trash()
    {
        $page = 'Banners Trash';

        $banners_trash = Banner::onlyTrashed()->get();

        return view('backend.banners.trash', compact('page', 'banners_trash'));
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

            if ($action_id) {
                Banner::withTrashed()->whereIn('id', $action_id)->restore();

                return redirect()->back()->with('success', 'Record recovery successful!');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful restores!');
            };
            // Success
        } else {
            // *** Action Delete *** \\

            if ($action_id) {
                // Unlink Images
                foreach ($action_id as $id) {

                    $banner = Banner::onlyTrashed()->find($id);

                    // Remove image from banners
                    $path_image = 'uploads/banners/';
                    $this->uploadService->deleteFile($banner->image, $path_image);
                }

                Banner::withTrashed()->whereIn('id', $action_id)->forceDelete();

                return redirect()->back()->with('success', 'Delete record successfully !');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful deletes!');
            };
        }
    }
}
