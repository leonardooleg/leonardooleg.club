<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $guarded = [];
    public function setUrlAttribute($value) {
        if( $value==="" || $value==null){
            $this->attributes['url'] = Str::slug( mb_substr($this->name_brand, 0, 30) ,'-');
        }else{
            $this->attributes['url'] = Str::slug( $value);
        }
    }
}
