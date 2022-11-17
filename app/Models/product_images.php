<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'product_id',
        'is_main',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }}
