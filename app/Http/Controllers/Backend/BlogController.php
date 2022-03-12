<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Blog;
use App\Models\Backend\BlogCategory;
use App\Services\UploadService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $uploadService;
    protected $blog_categories;
    /**
     * Constructing global variable
     */
    public function __construct(
        UploadService $uploadService,
        BlogCategory $blog_categories,
    ) {
        $this->uploadService = $uploadService;
        $this->blog_categories = $blog_categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 'List Blogs';

        $params = $request->all();

        $blogs = Blog::latest()->searchTitle()->filter($params)->paginate(3);

        $blog_categories = $this->blog_categories->categoryActives();

        return view('backend.blogs.index', compact('blogs', 'blog_categories', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->blog_categories->categoryActives();

        $page = 'Add New Blogs';

        return view('backend.blogs.add', compact('categories', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;

        // Upload Room Avatar Handler => ImageName
        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');

            // Method Upload
            $path = 'uploads/blog';
            $imageName = $this->uploadService->uploadImageHandler($file, $title, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Insert rooms into the database
        $returned_blog = Blog::addNewBlog($request, $imageName);

        // Check Result
        return alertInsert($returned_blog, 'blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Update Blog';

        $categories = $this->blog_categories->categoryActives();
        $blog_edit = Blog::find($id);

        return view('backend.blogs.edit', compact('page', 'categories', 'blog_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog_update = Blog::find($id);

        $title = $request->title;

        // Upload Room Avatar Handler => ImageName
        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');

            // Method Upload
            $path = 'uploads/blog';
            $imageName = $this->uploadService->uploadImageHandler($file, $title, $path);

            // Merge field image -> request
            $request->merge(['image' => $imageName]);
        }

        // Update record in database
        $returned_blog = $blog_update->update($request->all());

        // Check Result
        return alertUpdate($returned_blog, 'blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_delete = Blog::destroy($id);

        return alertTrash($blog_delete, 'blogs.index');
    }

    public function trash()
    {
        $page = 'Categories Trash';

        $blogs_trash = Blog::onlyTrashed()->get();

        return view('backend.blogs.trash', compact('page', 'blogs_trash'));
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
                Blog::withTrashed()->whereIn('id', $action_id)->restore();

                return redirect()->back()->with('success', 'Record recovery successful!');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful restores!');
            };
            // Success
        } else {
            // *** Action Delete *** \\

            // Unlink Images
            foreach ($action_id as $id) {

                $room = Blog::onlyTrashed()->find($id);

                // Remove image from categories
                $path_image = 'uploads/categories/';
                $this->uploadService->deleteFile($room->image, $path_image);
            }

            Blog::withTrashed()->whereIn('id', $action_id)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
