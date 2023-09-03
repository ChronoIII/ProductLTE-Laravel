<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Requests\StoreProductRequest;

class ProductController extends Controller
{
    private $oProductService;

    public function __construct(ProductService $oProductService) {
        $this->oProductService = $oProductService;
    }

    public function index() {
        $aFilter = request()->all();
        $oResponse = $this->oProductService->getProductList($aFilter);

        return response()->json([
            'products'  =>  $oResponse,
        ], 200);
    }

    public function show(int $iProductId) {
        $oResponse = $this->oProductService->getProduct($iProductId);
        if ($oResponse === null) {
            return response()->json([
                'message'   => 'Product not found',
                'product'   => null,
            ], 404);
        }
        return response()->json([
            'message'   => '',
            'product'   => $oResponse,
        ], 200);
    }

    public function store(StoreProductRequest $oRequest) {
        $aParams = $oRequest->validated();
        $oResponse = $this->oProductService->saveProduct($aParams);

        return response()->json([
            'product'   => $oResponse
        ], 200);
    }

    public function destroy(int $iProductId) {
        $oResponse = $this->oProductService->deleteProduct($iProductId);

        return response()->json([
            'result'    => $oResponse,
        ], 200);
    }
}
