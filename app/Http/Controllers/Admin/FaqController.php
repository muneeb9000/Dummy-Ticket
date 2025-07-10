<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Services\FaqService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
           if (!Auth::user()->can('faqs.view')) {
        abort(403, 'Unauthorized Access');
    }
        if ($request->ajax()) {
            $faqs = Faq::with('category')->latest()->get();
            
            return response()->json([
                'data' => $faqs,
            ]);
        }

        

        $categories = FaqCategory::all();
        return view('admin.pages.faqs.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {

          if (!Auth::user()->can('faqs.create')) {
        abort(403, 'Unauthorized Access');
    }
        if ($this->faqService->store($request->validated())) {
            return response()->json([
                'success' => true,
                'message' => 'FAQ created successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create FAQ.'
        ], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
          if (!Auth::user()->can('faqs.edit')) {
        abort(403, 'Unauthorized Access');
    }
        if ($this->faqService->update($faq, $request->validated())) {
            return response()->json([
                'success' => true,
                'message' => 'FAQ updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update FAQ.'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
          if (!Auth::user()->can('faqs.delete')) {
        abort(403, 'Unauthorized Access');
    }
        if ($this->faqService->destroy($faq)) {
            return response()->json([
                'success' => true,
                'message' => 'FAQ deleted successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to delete FAQ.'
        ], 500);
    }
}