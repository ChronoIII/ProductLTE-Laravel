<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private $oCategoryRepository;

    public function __construct(CategoryRepository $oCategoryRepository) {
        $this->oCategoryRepository = $oCategoryRepository;
    }

    public function getCategoryList(array $aFilter = []) {
        return $this->oCategoryRepository->getCategoryList($aFilter);
    }

    public function saveCategory(array $oCategory) {
        return $this->oCategoryRepository->addCategory($oCategory);
    }
}
