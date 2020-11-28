<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryImport;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Country;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
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
        $products = DB::table('products')
            ->join('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->join('categories', 'categories.id', '=', 'categoryables.category_id')
            ->orderBy('created_at', 'desc')
            ->select('categories.title as category_name','products.*')
            ->paginate(15);
        return view('admin.products.index', [
            'products' => $products
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
        return view('admin.products.create', [
            'brands' => Brand::all(),
            'providers' => Provider::all(),
            'countries' => Country::all(),
            /*'sizes' => Size::all(),
            'colors' => Color::all(),*/
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
        $product = new Product($request->except('color_id', 'size_id'));
        $product->user_id=Auth::id();

        $medias= $request->file('media');
        foreach($medias as $media){
            $upload[] = '/storage/'.$media->store('/uploads/products', 'public');
        }
        if ($upload){
            $product->media=implode(';', array_diff( $upload, array('')));
        }

        $product->save();

        $sizes=array_diff( $request['size_id'], array(''));
        $colors=array_diff( $request['color_id'], array(''));
        $i=0;
        foreach ($sizes as $size){
            $isert[]=['color_id' => $colors[$i], 'size_id' => $size, 'product_id' => $product->id];
            $i++;
        };
        DB::table('attributeables')->insert($isert);
        // Categories
        if($request->input('categories')) :
            $product->categories()->attach($request->input('categories'));
        endif;
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return Response
     */
    public function show(Category $Products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $Products
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands= Brand::all();
        global $categoryID;
        $categoryID= DB::table('categoryables')->where('categoryable_id',$product->id)->first();
        $categoryID= $categoryID->category_id;
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

        $attributeables = DB::table('attributeables')
            ->where('product_id', '=', $id)
            ->join('sizes', 'sizes.id', '=', 'attributeables.size_id')
            ->join('colors', 'colors.id', '=', 'attributeables.color_id')
            ->select('attributeables.id','attributeables.size_id', 'attributeables.color_id', 'sizes.rus_name_size',  'sizes.brand_name_size', 'colors.name_color')
            ->get();
        return view('admin.products.edit', [
            'brands' => Brand::all(),
            'providers' => Provider::all(),
            'countries' => Country::all(),
            'attributeables' => $attributeables,
            'categories' =>$categories2,
            'product' => $product,
            'delimiter'  => ''
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
        $product = Product::findOrFail($id);
        $input = $request->except('color_id', 'size_id');
        $upload=$request->upload_media;
        foreach ( explode(';', $product->media) as $image){
            if(!in_array($image, $upload)  ){
                Storage::disk('public')->delete(str_replace('/storage', '', $image));
            }
        }
        $medias= $request->file('media');
        if($medias) {
            foreach ($medias as $media) {
                $upload[] = '/storage/' . $media->store('/uploads/products', 'public');
            }
        }
        if ($upload) {
            $input['media'] = implode(';', array_diff($upload, array('')));
        }

        $product->fill($input)->save();
        $sizes=array_diff( $request['size_id'], array(''));
        $colors=array_diff( $request['color_id'], array(''));
        $i=0;
        foreach ($sizes as $size){
                $isert[]=['color_id' => $colors[$i], 'size_id' => $size, 'product_id' => $product->id];
                $i++;
        };
        DB::table('attributeables')->where('product_id', '=', $product->id)->delete();
        DB::table('attributeables')->insert( $isert);
        // Categories
        $product->categories()->detach();
        if($request->input('categories')) :
            $product->categories()->attach($request->input('categories'));
        endif;
        return back()->with('success', 'Your Product has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $category
     * @return Response
     **/
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        foreach (explode(';',$product->media) as $media){
            Storage::disk('public')->delete(str_replace('/storage', '', $media));
        }

        $product->delete();
        DB::table('attributeables')->where('product_id', '=', $product->id)->delete();
        return redirect()->route('admin.products.index');
    }

    public function import(){
        return view('admin.products.import');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function import_store(Request $request){
        $import_file = $request->file('import_file'); //при завантажені файлів
        /*Для статуса*/
        $status_api='uploads/import/go_status.txt';

        Storage::disk('public')->put($status_api,  '0;0;начало');

        /*Для статуса*/
        if ($import_file) {
            $data = "storage/". $import_file->store('uploads/import', 'public'); ///потім видаляти файли потрібно
            if ( $xsl = file($data, FILE_IGNORE_NEW_LINES) ) {
                $all_rows = count($xsl);
                $i=0;
                foreach ($xsl as $xsl){
                   // continue;
                    if($i==0){
                        $i++;
                        continue;
                    }
                    $xsl=mb_convert_encoding($xsl, "utf-8", "windows-1251");
                    $arr= explode("\t", $xsl);
                    //sleep(5);
                    $i++;
                    $upload=false;
                    $code=$arr[13];
                    if(isset($product)) {
                        if ($product->vendor_code == $code) {
                            $product->count = $product->count + 1;
                            //знов повтор вставки розміру і кольору
                            $attributes = $product->attributes($product, $arr);
                        } else {
                            $product->save();
                            Storage::disk('public')->put($status_api, $all_rows . ';' . $i . ';' . $arr[8]);
                        }
                    }
                    $product = Product::where('vendor_code','=', $code)->first();
                    if($product){
                        //далі провыряэмо чи э такі лінки в базі, не має видаляємо з диску і з масиво
                        //і завантажуємо тільки відсутні
                        $medias=explode(';', $arr[15]);
                        foreach ($medias as $name){
                            $medias_name[]=basename($name);
                        }
                        $upload= explode(';', $product->media);
                        foreach ($upload as $name){
                            $uploads_name[]=basename($name);
                        }
                        foreach ( $upload as $image){
                            if(!in_array(basename($image), $medias_name)  ){
                                Storage::disk('public')->delete(str_replace('/storage', '', $image)); //перевірити ! чи без ід видаля
                                $upload = array_diff($upload, [$image]); //удаляем из массива
                                $uploads_name = array_diff($uploads_name, [basename($image)]); //удаляем из массива
                            }
                        }
                        foreach ($medias as $media) {
                            if(!in_array(basename($media), $uploads_name)  ){
                                $file_full_path = 'public/uploads/products/'.$product->id.'/';
                                $file_name = basename($media);
                                Storage::disk('local')->put($file_full_path  . $file_name, file_get_contents($media), 'public');
                                $upload[] = '/storage/uploads/products/'.$product->id.'/'.$file_name;
                            }
                        }
                        if ($upload) {
                            $product->media = implode(';', array_diff($upload, array('')));
                        }
/////


                        $product->new= 0;
                        if($arr[17]=="Да")
                            $product->sale = 1;
                        else
                            $product->sale = 0;
                        $product->price= $arr[7];
                        $product->count= 1;
                        DB::table('attributeables')->where('product_id', '=', $product->id)->delete();
                        $attributes = $product->attributes($product, $arr);
                    }else{
                        // Categories
                        $categories = Category::where('title','=', $arr[2])->first();
                        if(!$categories){
                            $site_category = CategoryImport::where('import_name', '=', $arr[2])->first();
                            if(isset($site_category))$site_category=$site_category->category_id;
                            if(!$site_category){
                                //не потрібно бо вже всі потрібні створені
                                //створюємо самі категорії
                                /*  $categories_parent = Category::where('title','=', $arr[1])->first();
                                  if(!$categories_parent){
                                      $site_category_parent = CategoryImport::where('import_name', '=', $arr[1])->first();
                                      if(isset($site_category_parent))$site_category_parent=$site_category_parent->category_id;
                                      if(!$site_category_parent){
                                          $categories_parent = new Category();
                                          $categories_parent->title = $arr[1];
                                          $categories_parent->slug = '';
                                          $categories_parent->save();

                                          $categories_parent_id= $categories_parent->id;
                                          $categories = new Category();
                                          $categories->title = $arr[2];
                                          $categories->slug = '';
                                          $categories->save();
                                          $categories->parent_id = $categories_parent_id;
                                          $categories->save();
                                      }else{
                                          $categories_id=$site_category_parent;
                                      }
                                  }*/
                                //створюємо самі категорії
                                // $categories_id=84; //додаємо в "без категорії"
                                continue;
                            }else{
                                $categories_id=$site_category;
                            }


                        }
                        if(!isset($categories_id)) $categories_id=$categories->id;


                        $product = new Product();
                        $product->name= $arr[14];
                        $product->code= $arr[0];
                        $product->vendor_code= $arr[13];


                        $provider = Provider::where('provider_name','=', $arr[12])->first();
                        if(!$provider){
                            $provider = new Provider();
                            $provider->provider_name=$arr[12];
                            $provider->save();
                        }
                        $product->provider_id = $provider->id;
                        $product->material= $arr[11];

                        $country = Country::where('name_country','=', $arr[9])->first();
                        if(!$country){
                            $country = new Country();
                            $country->name_country=$arr[9];
                            $country->save();
                        }
                        $product->country_id = $country->id;

                        $product->new = 1;
                        if($arr[17]=="Да")
                            $product->sale = 1;
                        else
                            $product->sale = 0;

                        $product->description= $arr[10];
                        $product->price= $arr[7];
                        $product->count= 1;
                        $product->user_id= 1;
                        $product->published= 0;
                        $product->slug = Str::slug( mb_substr($arr[14], 0, 40) ,'-');

                        $brand = Brand::where('name_brand','=', $arr[3])->first();
                        if(!$brand){
                            $brand = new Brand();
                            $brand->name_brand=$arr[3];
                            $brand->save();
                        }
                        $product->brand_id = $brand->id;
                        $product->save();

                        //далі додаємо медіа
                        $medias=explode(';', $arr[15]);
                        foreach ($medias as $media) {
                            $file_full_path = 'public/uploads/products/'.$product->id.'/';
                            $file_name = basename($media);
                            Storage::disk('local')->put($file_full_path  . $file_name, file_get_contents($media), 'public');
                            $upload[] = '/storage/uploads/products/'.$product->id.'/'.$file_name;
                        }
                        if ($upload) {
                            $product->media = implode(';', array_diff($upload, array('')));
                        }
                        $product->categories()->attach($categories_id);
                        $attributes = $product->attributes($product, $arr);


                        // Categories

                        $product->save();
                        Storage::disk('public')->put($status_api,  $all_rows.';'.$i.';'.$arr[8]);
                    }


                }
            } else {
                return response()->json([
                    'message'   => 'error parse',
                    'class_name'  => 'alert-danger'
                ]);
            }
        }
        sleep(2);
        Storage::disk('public')->put($status_api,  $all_rows.';9999999999999999;end');

        return response()->json([
            'message'   => 'Готово',
            'class_name'  => 'alert-success'
        ]);



    }



}
