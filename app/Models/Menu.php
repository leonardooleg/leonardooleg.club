<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;


class Menu extends Model
{
    protected $table = "menus";

    protected $fillable = ['id','name'];


}
