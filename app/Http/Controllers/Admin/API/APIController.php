<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use function App\Http\Controllers\Admin\API;
use Illuminate\Support\Facades\DB;
class APIController extends Controller
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

    public function sizes($brand, $category, $filter)
    {
        if ($filter==1){
            $sizes = DB::table('sizes')
                ->where('sizes.brand_id',  '=', $brand)
                ->where('sizes.category_id',  '=', $category)
                ->join('brands', 'brands.id', '=', 'sizes.brand_id')
                ->orderBy('created_at', 'desc')
                ->select('brands.id', 'brands.name_brand', 'sizes.*')
                ->get();
        }elseif ($filter==2){
            $sizes = DB::table('sizes')
                ->where('sizes.category_id',  '=', $category)
                ->join('brands', 'brands.id', '=', 'sizes.brand_id')
                ->orderBy('created_at', 'desc')
                ->select('brands.id', 'brands.name_brand', 'sizes.*')
                ->get();
        }elseif ($filter==3){
            $sizes = DB::table('sizes')
                ->where('sizes.brand_id',  '=', $brand)
                ->join('brands', 'brands.id', '=', 'sizes.brand_id')
                ->orderBy('created_at', 'desc')
                ->select('brands.id', 'brands.name_brand', 'sizes.*')
                ->get();
        }else{
            $sizes=false;
        }

        foreach ($sizes as $size){
            $sizes_arr[$size->id] = $size->brand_name_size.' ( '. $size->rus_name_size. ')';
        }
        return  json_encode($sizes_arr);
    }

    public function colors($brand)
    {
        $colors = DB::table('colors')
            ->where('colors.brand_id',  '=', $brand)
            ->join('brands', 'brands.id', '=', 'colors.brand_id')
            ->orderBy('created_at', 'desc')
            ->select('colors.*')
            ->get();
        foreach ($colors as $color){
            $colors_arr[$color->id] =  $color->name_color;
        }
        return  json_encode($colors_arr);

    }


}
