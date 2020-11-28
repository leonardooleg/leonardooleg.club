<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Product extends Model
{

    protected $fillable = ['name', 'code', 'vendor_code', 'provider_id', 'brand_id', 'material', 'country_id', 'size_id', 'color_id', 'media', 'new', 'sale', 'description', 'price', 'count', 'user_id', 'slug','published', 'created_by', 'updated_at'];
    protected $guarded = [];

    // Получение ссылки
    public function getUrl()
    {
        $url= $this->categories[0];
        return 'catalog/'.$url->path.'/'.$this->slug.'.html';
    }

    public function setSlugAttribute($value) {
        if( $value==="" || $value==null){
            $this->attributes['slug'] = Str::slug( mb_substr($this->name, 0, 40) ,'-');
        }else{
            $this->attributes['slug'] = Str::slug( $value);
        }
    }



    // Polymorphic relation with categories
    public function categories()
    {
        return $this->morphToMany('App\Models\Category', 'categoryable');
    }
    public function scopeLastProducts($query, $count){
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function attributes($product, $arr){
        $arr_spain = json_decode(file_get_contents('Spain.json'), true);
        //найти ід кольору і розміру
        $brand_id = $product->brand_id;

        $color_name=basename($arr[5]);
        $color=Color::where('img_color', 'LIKE', "%$color_name%")->first();
        if(!$color){
            if (array_key_exists($arr[4],$arr_spain)) {
                $name=$arr_spain[$arr[4]];
            }else{
                $name=$arr[4];
            }
            $color = new Color();
            $color->name_color = $name;

            $file_full_path = 'public/uploads/colors/';
            Storage::disk('local')->put($file_full_path  . $color_name, file_get_contents($arr[5]), 'public');
            $color->img_color = '/storage/uploads/colors/'.$color_name;

            $color->brand_id = $brand_id;
            $color->save();
        }
        $id_color=$color->id;
        $size=Size::where('brand_name_size','=', $arr[6])->where('brand_id','=',$brand_id)->first();
        if(!$size){
            $size = new Size();
            $size->brand_name_size = $arr[6];
            $size->rus_name_size = $arr[6];
            $size->category_id = $product->categories[0]->id;
            $size->brand_id = $brand_id;
            $size->save();
        }
        $id_size=$size->id;
        DB::table('attributeables')->insert(
            ['color_id' => $id_color, 'size_id' => $id_size, 'product_id' => $product->id]
        );
        $ret['brand_id'] = $brand_id;
        return $ret;
    }

}
