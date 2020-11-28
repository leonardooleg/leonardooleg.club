<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
class MenuItem extends Model
{
    protected $table="menu_items";

    protected $fillable=['label','link','parent','sort','class','menu','depth'];


}
