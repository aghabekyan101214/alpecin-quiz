<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, ModelStringUtils;

    public function translations()
    {
        return $this->hasMany(ProductsLanguage::class, "product_id", "id");
    }
}
