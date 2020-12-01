<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Brand;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Session;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;



class SiteController extends Controller
{
    use NodeTrait;
   public function welcome(){
       $blogs=Blog::where('published', '1')->limit(9)->get();
       if(isset($_GET['filter_brand'])) $Value1= $_GET['filter_brand'];
       else $Value1= null;
       if(isset($_GET['filter_country'])) $Value2= $_GET['filter_country'];
       else $Value2= null;
       if(isset($_GET['filter_size'])) $Value3= $_GET['filter_size'];
       else $Value3= null;
       if(isset($_GET['filter_color'])) $Value4= $_GET['filter_color'];
       else $Value4= null;
       if(isset($_GET['sort'])){
           if($_GET['sort']=='price'){
               $Value5='price';
           }elseif($_GET['sort']=='new'){
               $Value5='created_at';
           }elseif($_GET['sort']=='discount'){
               $Value5='sale';
           }elseif($_GET['sort']=='popular'){
               $Value5='updated_at';  ///виправити коли буде додано відвідуваність
           }
       }else {
           $Value5= 'created_at';
       }
       if( $Value5== 'price')$Value6='asc';
       else $Value6='desc';
       $products = DB::table('products')
           ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
           ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
           ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
           ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
           ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
           ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
           ->leftjoin('countries','products.country_id', '=', 'countries.id')
           ->when($Value1, function($query) use ($Value1) {
               $query->whereIn('brands.id', $Value1);
           })
           ->when($Value2, function($query) use ($Value2) {
               $query->whereIn('countries.id', $Value2);
           })
           ->when($Value3, function($query) use ($Value3) {
               $query->whereIn('sizes.brand_name_size', $Value3);
           })
           ->when($Value4, function($query) use ($Value4) {
               $query->whereIn('colors.img_color', $Value4);
           })
           ->orderBy($Value5, $Value6)
           ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
               DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
               DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
               DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
           )
           ->where('products.published', '1')
           ->groupBy('products.id','categories.path','categories.title')
           ->limit(8)->get();

       $g=Menus::where('id', 2)->with('items')->first();
       $public_menu = $g->items;
       foreach ($public_menu as $menu){
           $test=Category::where('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
           if(isset($test)){
               $root[] = Category::descendantsAndSelf($test->id)->toTree()->first()->toarray();
           }else{
               $j['title'] =$menu->label;
               $j['path'] =$menu->link;
               $j['menu'] =1;
               $root[] =$j;
           }
           $test=false;
       }
       return view('welcome')->with(['b_menu'=>$root, 'blogs'=>$blogs,'products'=>$products]);

   }

    public function products(){
        $arr_color_list =array("бежевый", "белый", "голубой", "желтый", "зеленый", "коричневый", "красный", "оранжевый", "розовый", "серый", "синий", "фиолетовый", "черный");

        if(isset($_GET['path'])) {
            $category = Category::where('path', '=', $_GET['path'])->firstOrFail();
            // Get ids of descendants
            $categories = $category->descendants()->pluck('id');
            // Include the id of category itself
            $categories[] = $category->getKey();
        }
        if(isset($_GET['filter_brand'])) $Value1= $_GET['filter_brand'];
        else $Value1= null;
        if(isset($_GET['filter_country'])) $Value2= $_GET['filter_country'];
        else $Value2= null;
        if(isset($_GET['filter_size'])) $Value3= $_GET['filter_size'];
        else $Value3= null;
        if(isset($_GET['filter_color'])){
                $Value4= $_GET['filter_color'];
        }else {
            $Value4 = null;
        }
        if(isset($_GET['sort'])){
            if($_GET['sort']=='price'){
                $Value5='price';
            }elseif($_GET['sort']=='new'){
                $Value5='created_at';
            }elseif($_GET['sort']=='discount'){
                $Value5='sale';
            }elseif($_GET['sort']=='popular'){
                $Value5='updated_at';  ///виправити коли буде додано відвідуваність
            }
        }else {
            $Value5= 'created_at';
        }
        if( $Value5== 'price') $Value6='asc';
        else $Value6='desc';
        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id');

        if(isset($_GET['path'])) $products =$products->whereIn('categoryables.category_id', $categories);

        $products =$products->when($Value1, function($query) use ($Value1) {
                $query->whereIn('brands.id', $Value1);
            })
            ->when($Value2, function($query) use ($Value2) {
                $query->whereIn('countries.id', $Value2);
            })
            ->when($Value3, function($query) use ($Value3) {
                $query->whereIn('sizes.rus_name_size', $Value3);
            });
        //шукаємо потрібний колір якщо стандарний
            if($Value4) {
                foreach ($Value4 as $one_color){
                    if (in_array($one_color, $arr_color_list)) {
                        $products = $products->orWhere('colors.name_color', $one_color);
                    }else {
                        $products = $products->when($arr_color_list, function ($query) use ($arr_color_list) {
                            $query->whereNotIn('colors.name_color', $arr_color_list);
                        });
                    }
                }

            }
        $products =$products->orderBy($Value5, $Value6)
            ->where('products.published', 1)
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.rus_name_size) as rus_name_size")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(4);


        return response()->json($products);
    }


    public function catalog($path = 'catalog')
    {


        if(isset($_GET['filter_country'])) $filter_country= $_GET['filter_country'];
        else $filter_country= false;
        if(isset($_GET['filter_color'])) $filter_color= $_GET['filter_color'];
        else $filter_color= false;

        if($path !='catalog') {
            $category = Category::where('path', '=', $path)->firstOrFail();
            // Get ids of descendants
            $categories = $category->descendants()->pluck('id');
            // Include the id of category itself
            $categories[] = $category->getKey();
            $category_title =$category->title;
        }else{
            $category_title =false;
        }

        $products_filter= DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id');
             if($path !='catalog') {
                 $products_filter=$products_filter->whereIn('categoryables.category_id', $categories);
             }

            $products_filter=$products_filter->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                DB::raw("GROUP_CONCAT(sizes.rus_name_size) as rus_name_size")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->get();
             $arr_color_list =array("бежевый", "белый", "голубой", "желтый", "зеленый", "коричневый", "красный", "оранжевый", "розовый", "серый", "синий", "фиолетовый", "черный");
        foreach ($products_filter as $product_f){
            $filters['brand'][$product_f->brand_id]=$product_f->name_brand;
            $filters['country'][$product_f->country_id]=$product_f->name_country;
            foreach (explode(',', $product_f->rus_name_size) as $size){
                $filters['size'][$size]=$size;
            }
            $img_color=explode(',', $product_f->img_colors);
            $i=0;
            foreach (explode(',', $product_f->name_colors) as $color){
                $arr_more_color=explode('-',$color);
                foreach ($arr_more_color as $arr_one_color ){
                    if (in_array($arr_one_color, $arr_color_list)) {
                        $filters['color'][$arr_one_color]=$img_color[$i];
                    }else{
                        $filters['color']['другие цвета']='/img/transparent-color.png';
                    }
                }
                $i++;
            }
        }

        if(!isset($filters)){
            $filters=false;
        }else{
            $filters['color']=array_reverse( $filters['color'], true);
        }

        if(isset($filter_country[0])){
            $title_country = $filters['country'][$filter_country[0]];
            $arr_morf_1=['Нижнее белье', 'Бикини', 'Боди', 'Эротическое', 'Одежда для дома']; //подключаем разные синтаксисы
            if(in_array($category_title, $arr_morf_1)){
                $arra_morf = json_decode(file_get_contents('morf_2.json'));
            }else{
                $arra_morf = json_decode(file_get_contents('morf.json'));
            }
            $title_country=$arra_morf->$title_country;
        }else{
            $title_country=false;
        }
        if(isset($filter_color[0])){
            $title_color = array_search($filter_color[0], $filters["color"]);;
        }else{
            $title_color=false;
        }
        if($path !='catalog') {
            $categories = Category::ancestorsAndSelf($category->id); //щоб працювало бокове меню
        }
        $g=Menus::where('id', 2)->with('items')->first();
        $public_menu = $g->items;
            foreach ($public_menu as $menu){
                $test=Category::where('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
                if(isset($test)){
                    $root[] = Category::descendantsAndSelf($test->id)->toTree()->first()->toarray();
                }else{
                    $j['title'] =$menu->label;
                    $j['path'] =$menu->link;
                    $j['menu'] =1;
                    $root[] =$j;
                }
                $test=false;
            }
        $title='';
            if($title_country != false){
                $title= $title_country.' ';
            }else{}

            if($category_title != false){
                $title.= $category_title.' ';

            }else{}

            if($title_color != false){
                $title.= 'цвет '. $title_color;
            }else{}

            if($title==''){
                $title=null;
            }


       // return view('category')->with([ 'all'=> Product::count(), 'b_menu'=>$root, 'filters'=>$filters,  'title'=>$title,  'name_category'=>$category_title]);
        return view('category')->with([ 'b_menu'=>$root, 'filters'=>$filters,  'title'=>$title,  'name_category'=>$category_title]);

    }

    public function product($categoryPath, $productSlug)
    {

        // Сначала находим раздел по пути
        $category = Category::where('path', '=', $categoryPath)->firstOrFail();

        // Затем в этом разделе ищем товар с указанной заглушкой
        $product = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->where('products.slug', '=', $productSlug)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'brands.url  as brands_url', 'countries.name_country')
            ->groupBy('products.id','categories.path','categories.title')
            ->first();
        $attr_all = DB::table('attributeables')
            ->where('product_id', '=', $product->id)
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->select('attributeables.*', 'colors.name_color',  'colors.img_color', 'sizes.rus_name_size','sizes.brand_name_size','sizes.grudi_size','sizes.talii_size','sizes.pod_grudyu_size','sizes.bedra_size','sizes.stopy_size' )
            ->get()->toArray();
        $attr_colors = array();
        foreach ($attr_all as $c) {
            $attr_colors[$c->img_color] = $c; // Get unique country by code.
        }
        $attr_sizes = array();
        foreach ($attr_all as $s) {
            $attr_sizes[$s->brand_name_size] = $s; // Get unique country by code.
        }

        $g=Menus::where('id', 2)->with('items')->first();
        $public_menu = $g->items;
        foreach ($public_menu as $menu){
            $test=Category::where('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
            if(isset($test)){
                $root[] = Category::descendantsAndSelf($test->id)->toTree()->first()->toarray();
            }else{
                $j['title'] =$menu->label;
                $j['path'] =$menu->link;
                $j['menu'] =1;
                $root[] =$j;
            }
            $test=false;
        }

        $category = Category::where('path', '=', $categoryPath)->firstOrFail();
        // Get ids of descendants
        $categories_o = $category->descendants()->pluck('id');
        // Include the id of category itself
        $categories_o[] = $category->getKey();
        $similar_p = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->whereIn('categoryables.category_id', $categories_o)
            ->where('products.id', '!=', $product->id)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title')
            ->groupBy('products.id','categories.path','categories.title')
            ->get(20);
        $categories = Category::ancestorsAndSelf($category->id);

        /*Ласт*/
        $recent = Session::get('recent');
        if (!is_array($recent)) {
            $recent = array();
        }
        $recent[] = $product->id;
        while (count($recent) > 20) {
            array_shift($recent);
        }
        $recent=array_unique($recent);
        Session::put('recent', $recent);
        $last_p = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->whereIn('products.id', $recent)
            ->where('products.id', '!=', $product->id)
            ->select('products.*', 'categories.path', 'categories.title')
            ->groupBy('products.id','categories.path','categories.title')
            ->get();
        /*Ласт*/
        $media =explode(';', $product->media);
        return view('product')->with(['b_menu'=>$root, 'categories'=>$categories,'product'=>$product,'attr_all'=>$attr_all,'attr_sizes'=>$attr_sizes,'attr_colors'=>$attr_colors,'similar_p'=>$similar_p,'last_p'=>$last_p, 'media' => $media]);
    }


    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        return view('blogs')->with(['blogs'=>$blogs]);
    }

    public function blog($url)
    {
        $blog = Blog::where('url', '=', $url)->first();
        return view('blog')->with(['blog'=>$blog]);
    }
    public function page($url)
    {
        $page = Page::where('url', '=', $url)->first();
        return view('page')->with(['page'=>$page]);
    }

    public function brands()
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->toarray();
        foreach ($brands as $brand){
            $abc= substr($brand['name_brand'], 0,1);
            $brands_sort[$abc][]=$brand;
        }
        ksort($brands_sort, SORT_STRING);
        $count = count($brands);
        return view('brands')->with(['brands'=>$brands_sort, 'count'=>$count]);
    }
    public function brand($url)
    {
        $url=$_SERVER['REQUEST_URI'];
        $url= str_replace('/brands/','', $url);
        $url= str_replace('.html','', $url);

        $products = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->where('brands.url', $url)
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'brands.description_brand', 'brands.logo_brand')
            ->groupBy('products.id','categories.path','categories.title')
            ->paginate(15);

        $count = $products->count();
        $related_products=false;
        if($count<5){
            $related_products = DB::table('products')
                ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
                ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
                ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
                ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
                ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
                ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
                ->leftjoin('countries','products.country_id', '=', 'countries.id')
                ->orderBy('id', 'desc')
                ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                    DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                    DB::raw("GROUP_CONCAT(colors.img_color) as img_colors"),
                    DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes")
                )
                ->groupBy('products.id','categories.path','categories.title')
                ->limit(8)
                ->inRandomOrder()
                ->get();

        }

        $products_filter = DB::table('products')
            ->leftJoin('categoryables', 'categoryables.categoryable_id', '=', 'products.id')
            ->leftJoin('categories', 'categoryables.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftjoin('attributeables','attributeables.product_id', '=', 'products.id')
            ->leftjoin('colors','attributeables.color_id', '=', 'colors.id')
            ->leftjoin('sizes','attributeables.size_id', '=', 'sizes.id')
            ->leftjoin('countries','products.country_id', '=', 'countries.id')
            ->orderBy('created_at', 'desc')
            ->select('products.*', 'categories.path', 'categories.title', 'brands.name_brand', 'countries.name_country',
                DB::raw("GROUP_CONCAT(sizes.brand_name_size) as brand_name_sizes"),
                DB::raw("GROUP_CONCAT(colors.name_color) as name_colors"),
                DB::raw("GROUP_CONCAT(colors.img_color) as img_colors")
            )
            ->groupBy('products.id','categories.path','categories.title')
            ->get();

        foreach ($products_filter as $product_f){
            $filters['brand'][$product_f->brand_id]=$product_f->name_brand;
            $filters['country'][$product_f->country_id]=$product_f->name_country;
            foreach (explode(',', $product_f->brand_name_sizes) as $size){
                $filters['size'][$size]=$size;
            }
            $img_color=explode(',', $product_f->img_colors);
            $i=0;
            foreach (explode(',', $product_f->name_colors) as $color){
                $filters['color'][$color]=$img_color[$i];
                $i++;
            }
        }

        $categories = null;

        $g=Menus::where('id', 2)->with('items')->first();
        $public_menu = $g->items;
        foreach ($public_menu as $menu){
            $test=Category::where('path', '=', str_replace('/catalog/', '', mb_substr($menu->link, 0, -1)) )->first();
            if(isset($test)){
                $root[] = Category::descendantsAndSelf($test->id)->toTree()->first()->toarray();
            }else{
                $j['title'] =$menu->label;
                $j['path'] =$menu->link;
                $j['menu'] =1;
                $root[] =$j;
            }
            $test=false;
        }

        $brand = Brand::where('url', '=', $url)->firstOrFail();

        return view('brand')->with(['brand_one'=>$brand, 'products'=>$products, 'related_products'=>$related_products, 'count'=>$count, 'b_menu'=>$root, 'filters'=>$filters]);
    }

    public function sizes()
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->toarray();
        foreach ($brands as $brand){
            $brands_sort[$brand['name_brand']]=$brand;
        }
        ksort($brands_sort, SORT_STRING);
        return view('sizes')->with(['brands'=>$brands_sort]);
    }
    public function size($url)
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->toarray();
        foreach ($brands as $brand){
            $brands_sort[$brand['name_brand']]=$brand;
        }
        ksort($brands_sort, SORT_STRING);
        $size = Brand::where('url','=', $url)->first();
        return view('size')->with(['brands'=>$brands_sort, 'size'=>$size]);
    }

    public function productID($id)
    {
        $product=Product::where('id',$id)->first();

        return redirect($product->getUrl());
    }
}
