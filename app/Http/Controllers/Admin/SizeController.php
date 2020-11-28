<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use function App\Http\Controllers\Admin;
use DB;

class SizeController extends Controller
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
        $sizes = DB::table('sizes')
            ->join('categories', 'categories.id', '=', 'sizes.category_id')
            ->join('brands', 'brands.id', '=', 'sizes.brand_id')
            ->orderBy('created_at', 'desc')
            ->select('brands.name_brand','categories.title as category_name','sizes.*')
            ->paginate(15);

        return view('admin.sizes.index', [
            'sizes' => $sizes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        global $categories2;

        $nodes = Category::get()->toTree();
        $traverse = function ($categories, $prefix = '') use (&$traverse) {
            global $categories2;
            foreach ($categories as $category) {
                $categories2.=  '<option value="'.$category->id.'"> '.$prefix.' '.$category->title.' </option>';
                $traverse($category->children, $prefix.'-');
            }
        };
        $traverse($nodes);
        $brands= Brand::all();
        return view('admin.sizes.create', [
            'brands'   => $brands,
            'categories' =>$categories2,
            'delimiter'  => ''
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
        $sizes = new Size($request->all());
        $sizes->save();
        return redirect()->route('admin.sizes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return Response
     */
    public function show(Size $sizes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param size $sizes
     * @return Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        $brands= Brand::all();
        global $categoryID;
        $categoryID= $size->category_id;
        global $categories2;
        $nodes = Category::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            global $categories2;
            global $categoryID;
            foreach ($categories as $category0) {
                if($categoryID==$category0->id) $categories2.=  '<option value="'.$category0->id.'" selected> '.$prefix.' '.$category0->title.' </option>';
                else $categories2.=  '<option value="'.$category0->id.'"> '.$prefix.' '.$category0->title.' </option>';
                $traverse($category0->children, $prefix.'-');
            }
        };
        $traverse($nodes);


        return view('admin.sizes.edit', [
            'brands'   => $brands,
            'categories' =>$categories2,
            'size' => $size
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
        $task = Size::findOrFail($id);
        $input = $request->all();
        $logo_size = $request->file('logo_size');
        if ($logo_size){
            $upload=$request->file('logo_size')->store('uploads/sizes', 'public');
            if ($upload){
                $input['logo_size'] = $upload;
            }
        }

        $task->fill($input)->save();
        return back()->with('success', 'Your size has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Size $size
     * @return Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index');
    }

}
