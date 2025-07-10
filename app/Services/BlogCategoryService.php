<?php

namespace App\Services;

use App\Models\BlogCategory;

class BlogCategoryService
{
    public function getAll()
    {
        return BlogCategory::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        if (empty($data['slug'])) {
            $slug = Str::slug($data['name']); 
            $originalSlug = $slug;
            $i = 1;
            
            while (BlogCategory::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            $data['slug'] = $slug;
        }
        return BlogCategory::create($data);
    }

    public function update(BlogCategory $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(BlogCategory $category)
    {
        return $category->delete();
    }
}
