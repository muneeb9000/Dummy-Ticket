<?php

namespace App\Services;

use App\Models\FaqCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FaqCategoryService
{
    public function getAllCategories()
    {
        return FaqCategory::orderBy('created_at', 'desc')->get();
    }

    public function getCategoryById($id)
    {
        return FaqCategory::findOrFail($id);
    }

    public function createCategory(array $data)
    {
        $this->validateData($data);

        return FaqCategory::create([
            'name' => $data['name'],
            'icon' => $data['icon'] ?? null,
        ]);
    }

    public function updateCategory($id, array $data)
    {
        $this->validateData($data, $id);

        $category = FaqCategory::findOrFail($id);
        $category->update([
            'name' => $data['name'],
            'icon' => $data['icon'] ?? null,
        ]);

        return $category;
    }

    public function deleteCategory($id)
    {
        $category = FaqCategory::findOrFail($id);
        $category->delete();
        return $category;
    }

    protected function validateData(array $data, $id = null)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:faq_categories,name',
            'icon' => 'nullable|string|max:255',
        ];

        if ($id) {
            $rules['name'] .= ',' . $id;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return true;
    }
}