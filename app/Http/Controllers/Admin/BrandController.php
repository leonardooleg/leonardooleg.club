<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use function App\Http\Controllers\Admin;

class BrandController extends Controller
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
        $brands = Brand::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.brands.index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.brands.create', [
            'brands' => Brand::all()
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
        /*$request->validate([
            'logo_brand'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);*/
        $brands = new Brand();

        $input = $request->all();
        $logo_brand = $request->file('logo_brand');
        if ($logo_brand){
            $upload=$request->file('logo_brand')->store('uploads/brands', 'public');
            if ($upload){
                $input['logo_brand'] = $upload;
            }
        }
        $brands->fill($input)->save();
        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return Response
     */
    public function show(Brand $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param brand $brands
     * @return Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', [
            'brand' => $brand
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
        $task = Brand::findOrFail($id);
        $input = $request->all();
        $logo_brand = $request->file('logo_brand');
        if ($logo_brand){
            $upload=$request->file('logo_brand')->store('uploads/brands', 'public');
            if ($upload){
                Storage::disk('public')->delete($input['logo_brand']);
                $input['logo_brand'] = $upload;
            }
        }

        $task->fill($input)->save();
        return back()->with('success', 'Your brand has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Brand $brand
     * @return Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }

}
