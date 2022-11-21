<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'color'];

    public function product_attributes()
    {
        return $this->hasMany(product_attributes::class);
    }
}
