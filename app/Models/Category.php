<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Url;

/**
 * @method static lastCategories(int $int)
 */
class Category extends Model
{
    use NodeTrait;
    // Mass assigned
     protected $fillable = ['title', 'slug', 'path', 'parent_id', 'published', 'created_by', 'modified_by'];
    protected $guarded  = [];


    protected static function boot()
    {
        parent::boot();
        static::saving(function (self $model) {
            if ($model->isDirty('slug', 'parent_id') ) {
                $model->generatePath();
            }
        });

        static::saved(function (self $model) {
            // Данная переменная нужна для того, чтобы потомки не начали вызывать
            // метод, т.к. для них путь также изменится
            static $updating = false;
            if ( ! $updating && $model->isDirty('path')) {
                $updating = true;
                $model->updateDescendantsPaths();
                $updating = false;
            }
        });
    }

    // Генерация пути
    public function generatePath()
    {
        $slug = $this->slug;
        $this->path = $this->isRoot() ? $slug : $this->parent->path.'/'.$slug;
        return $this;
    }

    public function updateDescendantsPaths()
    {
        // Получаем всех потомков в древовидном порядке
        $descendants = $this->descendants()->defaultOrder()->get();
        // Данный метод заполняет отношения parent и children
        $descendants->push($this)->linkNodes()->pop();
        foreach ($descendants as $model) {
            $model->generatePath()->save();
        }
    }

    // Получение ссылки
    public function getUrl()
    {
        return 'catalog/'.$this->path;
    }

    public function setSlugAttribute($value) {
        if(isset($this->attributes['slug'])==false){$this->attributes['slug']='';}
        if($value ==  $this->attributes['slug'] || $value===""){
            $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 40) ,'-');
        }else{
            $this->attributes['slug'] = Str::slug( $value);
        }
    }





// Get children category
    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }
    // Polymorphic relation with products
    public function products()
    {
        return $this->morphedByMany('App\Models\Product', 'categoryable');
    }
    public function scopeLastCategories($query, $count){
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }
}


