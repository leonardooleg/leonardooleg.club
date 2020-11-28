<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use function App\Http\Controllers\Admin;
use DB;
class ColorController extends Controller
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
        $colors = DB::table('colors')
            ->join('brands', 'brands.id', '=', 'colors.brand_id')
            ->orderBy('created_at', 'desc')
            ->select('brands.name_brand','colors.*')
            ->paginate(15);
        return view('admin.colors.index', [
            'colors' => $colors

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.colors.create', [
            'brands' => Brand::all(),
            'colors' => Color::all()
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
        $Colors = new Color($request->all());
        $media= $request->file('img_color');
        $Colors->img_color = '/storage/'.$media->store('/uploads/colors', 'public');
        $Colors->save();
        return redirect()->route('admin.colors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return Response
     */
    public function show(Category $Colors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Color $Colors
     * @return Response
     */
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.edit', [
            'colors' => Color::all(),
            'brands' => Brand::all(),
            'color' => $color
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
        $task = Color::findOrFail($id);
        $input = $request->all();
        $media= $request->file('img_color');
        if($media){
            $upload=$task->img_color;
            Storage::disk('public')->delete(str_replace('/storage', '', $upload));
            $input['img_color'] = '/storage/' . $media->store('/uploads/colors', 'public');
        }

        $task->fill($input)->save();
        return back()->with('success', 'Your Color has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Color $color
     * @return Response
     */
    public function destroy(Color $color)
    {
        Storage::disk('public')->delete(str_replace('/storage', '', $color->img_color));
        $color->delete();
        return redirect()->route('admin.colors.index');

    }

}
