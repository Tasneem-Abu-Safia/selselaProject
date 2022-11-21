<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{

    protected $fillable = ['id', 'size'];

    public function product_attributes()
    {
        return $this->hasMany(product_attributes::class);
    }

}
