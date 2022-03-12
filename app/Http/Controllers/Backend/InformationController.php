<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreInformationRequest;
use App\Http\Requests\Backend\UpdateInformationRequest;
use App\Models\Backend\Information;
use App\Services\UploadService;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    protected $uploadService;
    /**
     * Constructing global variable
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function show()
    {
        $page = "Update Information";

        $info = Information::get()->first();

        if ($info) {
            return view('backend.informations.edit', compact('page', 'info'));
        } else {
            return view('backend.informations.add', compact('page', 'info'));
        }
    }

    public function add(StoreInformationRequest $request)
    {
        if ($request->hasFile('logo_image')) {
            $category_name = $request->name;

            $file = $request->file('logo_image');

            // Method Upload
            $path = 'uploads/logo';
            $image_name = $this->uploadService->uploadImageHandler($file, $category_name, $path);

            // Merge field image -> request
            $request->merge(['logo' => $image_name]);
        }

        $info = Information::create($request->all());

        if ($info) {
            return redirect()->back()->with('success', 'Update information successfully !');
        } else {
            return redirect()->back()->with('success', 'Update information failed !');
        }
    }

    public function update(UpdateInformationRequest $request)
    {
        $info_update = Information::get()->first();

        if ($request->hasFile('logo_image')) {
            $category_name = $request->name;

            $file = $request->file('logo_image');

            // Method Upload
            $path = 'uploads/logo';
            $image_name = $this->uploadService->uploadImageHandler($file, $category_name, $path);

            // Merge field image -> request
            $request->merge(['logo' => $image_name]);
        }

        $info = $info_update->update($request->all());

        if ($info) {
            return redirect()->back()->with('success', 'Update information successfully !');
        } else {
            return redirect()->back()->with('success', 'Update information failed !');
        }
    }
}
