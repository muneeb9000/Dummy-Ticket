<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FaqCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqCategoryController extends Controller
{
    protected $faqCategoryService;

    public function __construct(FaqCategoryService $faqCategoryService)
    {
        $this->faqCategoryService = $faqCategoryService;
    }

    public function index()
    {

    if (!Auth::user()->can('faqs-categories.view')) {
        abort(403, 'Unauthorized Access');
    }
        $categories = $this->faqCategoryService->getAllCategories();
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        }

        $canEditFaqCategory = Auth::user()->can('faqs-categories.edit');
        $canDeleteFaqCategory = Auth::user()->can('faqs-categories.delete');
    
        return view('admin.pages.faq_categories.index', compact('categories', 'canEditFaqCategory','canDeleteFaqCategory'));
    }
    public function store(Request $request)
    {
         if (!Auth::user()->can('faqs-categories.create')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $category = $this->faqCategoryService->createCategory($request->all());

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category created successfully!',
                    'data' => $category
                ]);
            }

            return redirect()->back()->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error',
                    'errors' => $e instanceof \Illuminate\Validation\ValidationException 
                        ? 
                        : null
                ], 422);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors($e instanceof \Illuminate\Validation\ValidationException 
                    ? 
                    : null);
        }
    }

    public function update(Request $request, $id)
    {
         if (!Auth::user()->can('faqs-categories.edit')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $category = $this->faqCategoryService->updateCategory($id, $request->all());

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category updated successfully!',
                    'data' => $category
                ]);
            }

            return redirect()->back()->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error',
                    'errors' => $e instanceof \Illuminate\Validation\ValidationException 
                        ? 'Error' 
                        : null
                ], 422);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors($e instanceof \Illuminate\Validation\ValidationException 
                    ? $e->errors() 
                    : 'Error');
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->can('faqs-categories.delete')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $this->faqCategoryService->deleteCategory($id);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category deleted successfully!'
                ]);
            }

            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error'
                ], 422);
            }

            return redirect()->back()->with('error',  'Error');
        }
    }
}