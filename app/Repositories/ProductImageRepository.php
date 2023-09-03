<?php

namespace App\Repositories;

use App\Models\ProductImageModel;

class ProductImageRepository
{
    protected $oProductImageModel;

    public function __construct(ProductImageModel $oProductImageModel) {
        $this->oProductImageModel = $oProductImageModel;
    }

    public function saveProductImage($aData) {
        return $this->oProductImageModel->create($aData);
    }

    public function deleteProductImage($iProductImageId) {
        $oData = $this->oProductImageModel->where('product_image_id', $iProductImageId);
        $oCopy = $oData->first()->toArray();
        $oData->delete();
        return $oCopy;
    }
}
