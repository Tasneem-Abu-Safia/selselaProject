<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = [
        'url',
        'product_id',
        'is_main',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }}
