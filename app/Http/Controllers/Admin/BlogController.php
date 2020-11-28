<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Blog::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blogs.index', [
            'blogs' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view('admin.blogs.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $blog = new Blog($request->all());
        $blog->user_id=Auth::id();

        $logo_brand = $request->file('img');
        if ($logo_brand){
            $upload=$request->file('img')->store('uploads/blogs', 'public');
            if ($upload){
                $blog->img = $upload;
            }
        }

        $blog->save();
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return Response
     */
    public function show(Category $Blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $Blogs
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.blogs.edit', [
            'blog' => Blog::findOrFail($id),
        ]);
    }

    /**
     * Update the given user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $input = $request->all();
        $logo_brand = $request->file('img');
        if ($logo_brand){
            $upload=$request->file('img')->store('uploads/blogs', 'public');
            if ($upload){
                Storage::disk('public')->delete($blog->img);
                $input['img'] = $upload;
            }
        }


        $blog->fill($input)->save();

        return back()->with('success', 'Your Blog has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Blog $blog
     * @return Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index');

    }

}
