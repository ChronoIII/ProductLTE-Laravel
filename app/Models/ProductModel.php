<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\ProductFactory;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 't_products';

    protected $primaryKey = 'product_id';

    protected $guarded = [
        'password',
        'remember_token',
    ];

    protected function newFactory() {
        return new ProductFactory();
    }

    public function category() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    public function images() {
        return $this->hasMany(ProductImageModel::class, 'product_id', 'product_id');
    }

    protected static function booted() {
        static::deleting(function(ProductModel $oProduct) {
            $oProduct->images()->delete();
        });
    }

    public function getDescriptionAttribute(string $sDescription) {
        return json_decode($sDescription, true);
    }
}
