<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreBrandRequest;
use App\Http\Requests\Backend\UpdateBrandRequest;
use App\Models\Backend\Brand;
use App\Services\UploadService;
use Illuminate\Http\Request;

class BrandController extends Controller
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

        $page = 'Brand Management';

        $params = $request->all();

        $brands = Brand::latest()->searchName()->filter($params)->paginate(3);

        return view('backend.brands.index', compact('page', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {

        if ($request->hasFile('brand_image')) {
            $brand_name = $request->name;

            $file = $request->file('brand_image');

            // Method Upload
            $path = 'uploads/brands';
            $image_name = $this->uploadService->uploadImageHandler($file, $brand_name, $path);

            // Merge field image -> request
            $request->merge(['image' => $image_name]);
        }

        $result = Brand::create($request->all());

        return alertInsert($result, 'brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $page = 'Edit Brand';

        $brand_update = Brand::find($id);

        $params = $request->all();

        $brands = Brand::latest()->searchName()->filter($params)->paginate(3);

        return view('backend.brands.edit', compact('page', 'brand_update', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::find($id);

        // Upload Product Avatar Handler => ImageName
        if ($request->hasFile('brand_image')) {

            $brand_name = $request->name;

            $file = $request->file('brand_image');

            // Remove old file
            $path = 'uploads/brands/';
            $this->uploadService->deleteFile($brand->image, $path);

            // Method Upload
            $image_name = $this->uploadService->uploadImageHandler($file, $brand_name, $path);

            // Merge field image -> request
            $request->merge(['image' => $image_name]);
        }


        $result = $brand->update($request->all());

        return alertUpdate($result, 'brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::destroy($id);

        return alertTrash($brand, 'brands.index');
    }


    public function trash()
    {
        $page = 'Brands Trash';

        $brands_trash = Brand::onlyTrashed()->get();

        return view('backend.brands.trash', compact('page', 'brands_trash'));
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
                brand::withTrashed()->whereIn('id', $action_id)->restore();

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

                    $brand = Brand::onlyTrashed()->find($id);

                    // Remove image from brands
                    $path_image = 'uploads/brands/';
                    $this->uploadService->deleteFile($brand->image, $path_image);
                }

                Brand::withTrashed()->whereIn('id', $action_id)->forceDelete();

                return redirect()->back()->with('success', 'Delete record successfully !');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful deletes!');
            };
        }
    }
}
