<?php

namespace App\Controllers\Api;

use App\Services\CategoryService;

class CategoryController extends ApiBaseController
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function getAllCategoryApi(): void
    {
        $categories = $this->categoryService->getAllCategories();
        $this->respondSuccess($categories);
    }
}
