<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * Display a listing of reviews.
     */
    public function index(): View
    {
        if (!Auth::user()->can('reviews.view')) {
        abort(403, 'Unauthorized Access');
    }
        $reviews = $this->reviewService->getAll();
        return view('admin.pages.reviews.index', compact('reviews'));
    }

    /**
     * Store a newly created review.
     */
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $this->reviewService->store($request->validated());
        return redirect()->back()->with('success', 'Your review has been submitted and will be public after approval.');
    }

    /**
     * Approve a review.
     */
    public function approve(Request $request, int $id): RedirectResponse
    {
         if (!Auth::user()->can('reviews.edit')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $this->reviewService->approve($id);
            return redirect()->route('admin.reviews.index')
                ->with('success', 'Review approved successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reviews.index')
                ->with('error', $e->getMessage());
        }
    }

    public function update(UpdateReviewRequest $request, $id): RedirectResponse
    {
        if (!Auth::user()->can('reviews.edit')) {
            abort(403, 'Unauthorized Access');
        }
       
        try {
            $review = $this->reviewService->findById($id);
            $this->reviewService->update($review, $request->validated());
            
            return redirect()->route('admin.reviews.index')
                ->with('success', 'Review updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reviews.index')
                ->with('error', $e->getMessage());
        }
    }


    /**
     * Delete a review.
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
         if (!Auth::user()->can('reviews.delete')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $this->reviewService->delete($id);
            return redirect()->route('admin.reviews.index')
                ->with('success', 'Review deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reviews.index')
                ->with('error', $e->getMessage());
        }
    }
}
