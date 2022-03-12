<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreServiceRequest;
use App\Http\Requests\Backend\UpdateServiceRequest;
use App\Models\Backend\BlogCategory;
use App\Models\Backend\Service;
use App\Services\UploadService;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $page = 'Services Management';

        $params = $request->all();

        $services = Service::latest()->searchTitle()->filter($params)->paginate(3);

        return view('backend.services.index', compact('page', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Add New Services';

        $blog_categories = BlogCategory::all();

        return view('backend.services.add', compact('page', 'blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $title = $request->title;

        // Upload service Avatar Handler => ImageName
        if ($request->hasFile('service_image')) {
            $file = $request->file('service_image');

            // Method Upload
            $path = 'uploads/services';
            $imageName = $this->uploadService->uploadImageHandler($file, $title, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Insert services into the database
        $returned_service = Service::create($request->all());

        // Check Result
        return alertInsert($returned_service, 'services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit Service';

        $service_edit = Service::find($id);

        $blog_categories = BlogCategory::all();

        return view('backend.services.edit', compact('page', 'service_edit', 'blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        $service_update = Service::find($id);

        $title = $request->title;

        // Upload service Avatar Handler => ImageName
        if ($request->hasFile('service_image')) {
            $file = $request->file('service_image');

            // Remove old image
            $path_image = 'uploads/services';
            $this->uploadService->deleteFile($service_update->image, $path_image);

            // Method Upload
            $path = 'uploads/services';
            $imageName = $this->uploadService->uploadImageHandler($file, $title, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Update record in database
        $returned_service = $service_update->update($request->all());

        // Check Result
        return alertUpdate($returned_service, 'services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service_delete = Service::destroy($id);

        return alertTrash($service_delete, 'services.index');
    }


    public function trash()
    {
        $page = 'Services Trash';

        $services_trash = Service::onlyTrashed()->get();

        return view('backend.services.trash', compact('page', 'services_trash'));
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
                Service::withTrashed()->whereIn('id', $action_id)->restore();

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

                    $service_delete = Service::onlyTrashed()->find($id);

                    // Remove services image
                    $path_image = 'uploads/services';
                    $this->uploadService->deleteFile($service_delete->image, $path_image);
                }

                Service::withTrashed()->whereIn('id', $action_id)->forceDelete();

                return redirect()->back()->with('success', 'Delete record successfully !');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful deletes!');
            };
        }
    }
}
