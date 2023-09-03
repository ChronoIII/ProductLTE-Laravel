<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    private $oCategoryService;

    public function __construct(CategoryService $oCategoryService) {
        $this->oCategoryService = $oCategoryService;
    }

    public function index() {
        $oResponse = $this->oCategoryService->getCategoryList();

        return response()->json([
            'categories'    => $oResponse,
        ], 200);
    }

    public function store(StoreCategoryRequest $oRequest) {
        $oCategory = $oRequest->validated();
        $oResponse = $this->oCategoryService->saveCategory($oCategory);
        if ($oResponse === null) {
            return response()->json(null, 500);
        }
        return response()->json($oResponse, 200);
    }
}
