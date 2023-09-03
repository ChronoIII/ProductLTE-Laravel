<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\ProductImageRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private $oProductRepository;

    private $oProductImageRepository;

    public function __construct(ProductRepository $oProductRepository, ProductImageRepository $oProductImageRepository) {
        $this->oProductRepository = $oProductRepository;
        $this->oProductImageRepository = $oProductImageRepository;
    }

    public function getProductList(array $aData = []) {
        $aFilter = Arr::only($aData, [
            'keyword', 'count', 'page', 'category_id'
        ]);

        return $this->oProductRepository->getProductList($aFilter);
    }

    public function getProduct(int $iProductId) {
        return $this->oProductRepository->getProduct($iProductId);
    }

    public function saveProduct(array $oProduct) {
        $oProductParams = Arr::only($oProduct, [
            'product_id', 'name', 'category_id', 'description', 'date_time',
        ]);
        $oProductResult = $this->oProductRepository->saveProduct($oProductParams);
        // Loop to add new images
        $aImageToAdd = $oProduct['image_to_add'] ?? [];
        foreach ($aImageToAdd as $mImage) {
            $this->saveProductImage($oProductResult, $mImage);
        }
        // Loop to delete removed images
        $aImageToRemove = $oProduct['image_to_delete'] ?? [];
        foreach ($aImageToRemove as $iProductImageId) {
            $this->removeProductImage($iProductImageId);
        }
        return $oProductResult;
    }

    public function deleteProduct(int $iProductId) {
        return $this->oProductRepository->deleteProduct($iProductId);
    }

    private function saveProductImage($oProduct, $oImage) {
        $sFilename = sprintf('%s', $oProduct['product_id']);
        $oImageFile = Storage::put($sFilename, $oImage);

        return $this->oProductImageRepository->saveProductImage([
            'product_id' => $oProduct->product_id,
            'image_path' => $oImageFile,
        ]);
    }

    private function removeProductImage($iProductImageId) {
        $oImageData = $this->oProductImageRepository->deleteProductImage($iProductImageId);
        $aPath = explode('/', $oImageData['image_path']);
        $sStoragePath = implode('/', [$aPath[count($aPath) - 2], $aPath[count($aPath) - 1]]);
        Storage::delete($sStoragePath ?? '');
    }
}
