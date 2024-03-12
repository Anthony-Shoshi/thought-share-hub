<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryService {

    private $categoryRepository;

    public function __construct() {
        $this->categoryRepository = new CategoryRepository();
    }

    public function getCategoryBySlug(string $slug): ?Category {
        return $this->categoryRepository->getBySlug($slug);
    }
    
    public function getCategoryById(int $categoryId): ?Category {
        return $this->categoryRepository->getById($categoryId);
    }

    public function getAllCategories(): array {
        return $this->categoryRepository->getAll();
    }

    public function createCategory(Category $category): bool {
        return $this->categoryRepository->create($category);
    }
    
    public function updateCategory(Category $category): bool {
        return $this->categoryRepository->update($category);
    }
    
    public function deleteCategory(int $categoryId): bool {
        return $this->categoryRepository->delete($categoryId);
    }

    public function getTotalCategoryCount(): int {
        return $this->categoryRepository->getTotalCategoryCount();
    }
}
