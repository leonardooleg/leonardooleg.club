<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $guarded = [];

    public function setUrlAttribute($value) {
        if( $value==="" || $value==null){
            $this->attributes['url'] = Str::slug( mb_substr($this->title, 0, 60) ,'-');
        }else{
            $this->attributes['url'] = Str::slug( $value);
        }
    }
}
