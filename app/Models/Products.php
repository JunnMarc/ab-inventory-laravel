<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name', 'product_category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category');
    }
}
