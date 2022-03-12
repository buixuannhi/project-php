<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreCategoryRequest;
use App\Http\Requests\Backend\UpdateCategoryRequest;
use App\Models\Backend\Category;
use App\Services\UploadService;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $page = 'Categories Management';

        $params = $request->all();
        
        $categories = Category::latest()->filter($params)->paginate(3);

        $select_category = Category::all();

        return view('backend.categories.index', compact('page', 'categories', 'select_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        if ($request->hasFile('category_image')) {
            $category_name = $request->name;

            $file = $request->file('category_image');

            // Method Upload
            $path = 'uploads/categories';
            $image_name = $this->uploadService->uploadImageHandler($file, $category_name, $path);
        }

        // Merge field image -> request
        $request->merge(['image' => $image_name]);

        $result = Category::create($request->all());

        return alertInsert($result, 'categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $page = 'Edit Category';

        $category_update = Category::find($id);

        $params = $request->all();

        $categories = Category::latest()->filter($params)->paginate(3);

        $select_category = Category::all();

        return view('backend.categories.edit', compact('page', 'category_update', 'categories', 'select_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);

        // Upload Product Avatar Handler => ImageName
        if ($request->hasFile('category_image')) {

            $category_name = $request->name;

            $file = $request->file('category_image');

            // Remove old file
            $path = 'uploads/categories/';
            $this->uploadService->deleteFile($category->image, $path);

            // Method Upload
            $path = 'uploads/categories/';
            $image_name = $this->uploadService->uploadImageHandler($file, $category_name, $path);

            // Merge field image -> request
            $request->merge(['image' => $image_name]);
        }


        $result = $category->update($request->all());

        return alertUpdate($result, 'categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->roomOfCategories()->get()->count() > 0) {
            $message = 'Can\'t move record to trash! Because it belongs to a certain room !';
            return redirect()->back()->with('error', $message);
        } else if ($category->childrenCategories()->get()->count() > 0) {
            $message = 'Can\'t move record to trash! Because it belongs to a child category !';
            return redirect()->back()->with('error', $message);
        };

        $result = $category->delete();

        return alertTrash($result, 'categories.index');
    }


    public function trash()
    {
        $page = 'Categories Trash';

        $categories_trash = Category::onlyTrashed()->get();

        return view('backend.categories.trash', compact('page', 'categories_trash'));
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
                Category::withTrashed()->whereIn('id', $action_id)->restore();

                return redirect()->back()->with('success', 'Record recovery successful!');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful restores!');
            };
            // Success
        } else {
            // *** Action Delete *** \\

            // Unlink Images
            foreach ($action_id as $id) {

                $room = Category::onlyTrashed()->find($id);

                // Remove image from categories
                $path_image = 'uploads/categories/';
                $this->uploadService->deleteFile($room->image, $path_image);
            }

            Category::withTrashed()->whereIn('id', $action_id)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
