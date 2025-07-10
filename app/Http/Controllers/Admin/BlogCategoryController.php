<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use App\Services\BlogCategoryService;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    protected $service;

    public function __construct(BlogCategoryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {

    if (!Auth::user()->can('blog-categories.view')) {
        abort(403, 'Unauthorized Access');
    }
        if ($request->ajax()) {
            $categories = $this->service->getAll();
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        }

        return view('admin.pages.blog_categories.index');
    }

    public function store(BlogCategoryRequest $request)
    {
          if (!Auth::user()->can('blog-categories.create')) {
        abort(403, 'Unauthorized Access');
    }
        $category = $this->service->create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ]);
    }

    public function update(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
         if (!Auth::user()->can('blog-categories.edit')) {
        abort(403, 'Unauthorized Access');
    }
        $category = $this->service->update($blog_category, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function destroy(BlogCategory $blog_category)
    {
          if (!Auth::user()->can('blog-categories.delete')) {
        abort(403, 'Unauthorized Access');
    }
        $this->service->delete($blog_category);
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }

     public function seo($id)
    {
        $page = BlogCategory::findOrFail($id);
        return response()->json([
            'success' => true,
            'seo' => $page->seo
        ]);
    }

     public function seoStore(Request $request)
    {
        $id = $request->page_id;
        $seoData = $request->only(['meta_title', 'meta_description', 'meta_keywords', 'robots', 'meta_image']);
        $page = BlogCategory::findOrFail($id);
        $canonicalUrl = $page->slug ? url('/category-blogs/' . $page->slug) : url('/');

        $page->seo()->updateOrCreate(
            [],
            [
                'title'       => $seoData['meta_title'] ?? $page->title,
                'description' => $seoData['meta_description'] ?? '',
                'keywords'    => $seoData['meta_keywords'] ?? '',
                'robots'      => $seoData['robots'] ?? '',
                'image'       => $seoData['meta_image'] ?? '',
                'author'      => 'FIFV Travels',
                'canonical_url' => $canonicalUrl,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Seo created successfully!',
            'page' => $page->seo,
        ]);
    }

}
