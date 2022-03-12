<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateCategoryRequest;
use App\Models\Backend\BlogCategory;
use App\Services\UploadService;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
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
        $page = 'Blog Categories Management';

        $params = $request->all();

        $categories = BlogCategory::latest()->searchName()->filter($params)->paginate(3);

        return view('backend.blog-categories.index', compact('page', 'categories'));
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
    public function store(Request $request)
    {
        if ($request->hasFile('category_image')) {
            $category_name = $request->name;

            $file = $request->file('category_image');

            // Method Upload
            $path = 'uploads/blog-categories';
            $image_name = $this->uploadService->uploadImageHandler($file, $category_name, $path);
        }

        // Merge field image -> request
        $request->merge(['image' => $image_name]);

        $result = BlogCategory::create($request->all());

        return alertInsert($result, 'blog-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $page = 'Edit Category';

        $category_update = BlogCategory::find($id);

        $params = $request->all();

        $categories = BlogCategory::latest()->searchName()->filter($params)->paginate(3);


        return view('backend.blog-categories.edit', compact('page', 'category_update', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $blog_category = BlogCategory::find($id);

        // Upload Product Avatar Handler => ImageName
        if ($request->hasFile('category_image')) {

            $category_name = $request->name;

            $file = $request->file('category_image');

            // Remove old file
            $path = 'uploads/blog-categories/';
            $this->uploadService->deleteFile($blog_category->image, $path);

            // Method Upload
            $path = 'uploads/blog-categories';
            $image_name = $this->uploadService->uploadImageHandler($file, $category_name, $path);

            // Merge field image -> request
            $request->merge(['image' => $image_name]);
        }

        $result = $blog_category->update($request->all());

        return alertUpdate($result, 'blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_category = BlogCategory::find($id);

        if ($blog_category->blogOfBlogCategories()->get()->count() > 0) {
            $message = 'Can\'t move record to trash! Because it belongs to a certain blog !';
            return redirect()->back()->with('error', $message);
        }

        $result = $blog_category->delete();

        return alertTrash($result, 'blog-categories.index');
    }

    public function trash()
    {
        $page = 'Categories Trash';

        $categories_trash = BlogCategory::onlyTrashed()->get();

        return view('backend.blog-categories.trash', compact('page', 'categories_trash'));
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
                BlogCategory::withTrashed()->whereIn('id', $action_id)->restore();

                return redirect()->back()->with('success', 'Record recovery successful!');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful restores!');
            };
        } else {
            // *** Action Delete *** \\

            // Unlink Images
            foreach ($action_id as $id) {

                $room = BlogCategory::onlyTrashed()->find($id);

                // Remove image from categories
                $path_image = 'uploads/blog-categories/';
                $this->uploadService->deleteFile($room->image, $path_image);
            }

            BlogCategory::withTrashed()->whereIn('id', $action_id)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
