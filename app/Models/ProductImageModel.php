<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImageModel extends Model
{

    protected $table = 't_product_images';

    protected $primaryKey = 'product_image_id';

    protected $guarded = [];

    public function getImagePathAttribute(string $sImagePath) {
        return Storage::url($sImagePath);
    }
}
