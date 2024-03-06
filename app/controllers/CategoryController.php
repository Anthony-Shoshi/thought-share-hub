<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController
{

    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    function index(): void
    {
        $categories = $this->categoryService->getAllCategories();
        include '../views/backend/categories/index.php';
        exit;
    }

    public function getCategoryById(int $categoryId): ?Category
    {
        return $this->categoryService->getCategoryById($categoryId);
    }

    public function getAllCategories(): array
    {
        return $this->categoryService->getAllCategories();
    }

    public function create(?string $message = ''): void
    {
        include '../views/backend/categories/create.php';
        exit;
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category();
            $category->category_name = $_POST['category_name'];
            $category->slug = Helper::slug($_POST['category_name']);

            $success = $this->categoryService->createCategory($category);

            if ($success) {
                $_SESSION['success'] = true;
                $_SESSION['message'] = 'Category created successfully!';
            } else {
                $_SESSION['success'] = false;
                $_SESSION['message'] = 'Failed to create category.';
            }

            header('location: /category/create');
        } else {
            echo "Method not allowed.";
        }
    }

    public function edit(): void
    {
        $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $category = $this->getCategoryById($categoryId);

        if (!$category) {
            $_SESSION['success'] = false;
            $_SESSION['message'] = 'Category not found.';
        }

        include '../views/backend/categories/edit.php';
        exit;
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category();
            $category->category_id = $_POST['category_id'];
            $category->category_name = $_POST['category_name'];
            $category->slug = Helper::slug($_POST['category_name']);

            $success = $this->categoryService->updateCategory($category);

            if ($success) {
                $_SESSION['success'] = true;
                $_SESSION['message'] = 'Category updated successfully!';
                header("Location: /category/index");
                exit();
            } else {
                $_SESSION['success'] = false;
                $_SESSION['message'] = 'Failed to update category.';
            }
        }
        header('location: /category/edit?id=' . $_POST['category_id']);
    }

    public function delete(): void
    {
        $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $success = $this->categoryService->deleteCategory($categoryId);

        if ($success) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'Category deleted successfully!';
        } else {
            $_SESSION['success'] = false;
            $_SESSION['message'] = 'Failed to delete category.';
        }

        $categories = $this->categoryService->getAllCategories();
        header('location: /category/index');
    }

    public function getAllCategoryApi(): void
    {
        $categories = $this->categoryService->getAllCategories();
        header('Content-Type: application/json');
        echo json_encode($categories);
    }
}
