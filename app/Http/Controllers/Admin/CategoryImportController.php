<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryImport;
use Illuminate\Http\Request;

class CategoryImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $list = CategoryImport::paginate(30);
        $all_category = Category::all();
        //$list = CategoryRepository::getAllWithPadinate(30);
        return view('admin.category_imports.index', [
            'categories' => $list,
            'all_category' => $all_category,
        ]);
    }
    public function children($id)
    {
        $head = Category::ancestorsOf($id);
        $parent= Category::where('id', $id)->first();
        $list = Category::with('ancestors')->where('parent_id', $id)->paginate(30);
        return view('admin.category_imports.index', [
            'categories' => $list,
            'parent' => $parent,
            'head' => $head,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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

        return view('admin.category_imports.create', [
            'category'   => [],
            'categories' =>$categories2,
            'delimiter'  => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $node = new CategoryImport();
        $node->import_name = $request['import_name'];
        $node->category_id = $request['category_id'];
        $node->save();
        return redirect()->route('admin.category-import.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryImport  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryImport  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryImport $category_import)
    {
        global $categoryID;

        $categoryID= $category_import->category_id;
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


        return view('admin.category_imports.edit', [
            'category'   => $category_import,
            'categories' =>$categories2,
            'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryImport  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,CategoryImport $category_import)
    {

        $category_import->import_name = $request['import_name'];
        $category_import->category_id = $request['category_id'];
        $category_import->save();

        return redirect()->route('admin.category-import.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryImport  $category_import
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryImport $category_import)
    {
        $category_import->delete();
            return redirect()->route('admin.category-import.index');
    }
}
