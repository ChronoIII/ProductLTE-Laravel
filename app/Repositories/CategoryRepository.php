<?php

namespace App\Repositories;

use App\Models\CategoryModel;

class CategoryRepository
{
    private $oCategoryModel;

    public function __construct(CategoryModel $oCategoryModel) {
        $this->oCategoryModel = $oCategoryModel;
    }

    public function getCategoryList(array $aFilter = []) {
        $aCategories = $this->oCategoryModel
            ->when(empty($aFilter) === false, function($query) use ($aFilter) {
                return $query->where($aFilter);
            });

        if (empty($aCategories)) {
            return [];
        }
        return $aCategories->get();
    }

    public function addCategory(array $oCategory) {
        $aFilter = [
            'category_id'   => $oCategory['category_id'] ?? null,
        ];
        return $this->oCategoryModel->updateOrCreate($aFilter, $oCategory);
    }
}
