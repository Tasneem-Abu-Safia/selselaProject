<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'icon',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }

}
