<?php

namespace App\Repositories;

use App\Models\ProductModel;

class ProductRepository
{
    private $oProductModel;

    public function __construct(ProductModel $oProductModel) {
        $this->oProductModel = $oProductModel;
    }

    public function getProductList(array $aFilter = []) {
        $aProducts = $this->oProductModel
            ->when(empty($aFilter['keyword']) === false, function($query) use ($aFilter) {
                return $query
                    ->where('name', 'like', '%' . $aFilter['keyword'] . '%')
                    ->orWhere('description', 'like', '%' . $aFilter['keyword'] . '%');
            })
            ->when(empty($aFilter['category_id']) === false, function($query) use ($aFilter) {
                return $query->where('category_id', $aFilter['category_id']);
            })
            ->with(['category', 'images'])
            ->orderBy('created_at', 'DESC')
            ->orderBy('product_id', 'DESC');

        if (empty($aProducts)) {
            return [];
        }
        return $aProducts->paginate($aFilter['count'] ?? 10);
    }

    public function getProduct(int $iProductId) {
        $aProduct = $this->oProductModel
            ->where(['product_id' => $iProductId])
            ->with(['category', 'images']);

        if (empty($aProduct)) {
            return null;
        }
        return $aProduct->first();
    }

    public function saveProduct(array $oProduct) {
        $aFilter = [
            'product_id'    => $oProduct['product_id'] ?? null,
        ];
        return $this->oProductModel->updateOrCreate($aFilter, $oProduct);
    }

    public function deleteProduct(int $iProductId) {
        return $this->oProductModel
            ->where(['product_id' => $iProductId])
            ->delete();
    }
}
