<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $guarded = [];
    // Полиморфное отношение
    public function model()
    {
        return $this->morphTo();
    }
}
