<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewService
{
    /**
     * Fetch paginated reviews
     * 
     *tor
     */
    public function getAll()
    {
       return Review::orderBy('created_at', 'desc')->get();

    }

    /**
     * Store a new review
     * 
     * @param array $data
     * @return Review
     */
    public function store(array $data): Review
    {
        return Review::create([
            'title'  => $data['title'] ?? null,
            'review' => $data['review'] ?? null,
            'rating' => $data['rating'],
            'name'   => $data['name'],
            'email'  => $data['email'],
            'status' => $data['status'] ?? false,
        ]);
    }

    /**
     * Approve a review
     * 
     * @param int $id
     * @return Review
     * @throws ModelNotFoundException
     */
    public function approve(int $id): Review
    {
        
        $review = Review::findOrFail($id);
        $review->update(['status' => true]);
        return $review;
    }

    /**
     * Update an existing review
     * 
     * @param Review $review
     * @param array $data
     * @return bool
     */
    public function update(Review $review, array $data): bool
    {
      
        return $review->update($data);
    }

    /**
     * Delete a review
     * 
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        $review = Review::findOrFail($id);
        return $review->delete();
    }

    /**
     * Find a review by ID
     * 
     * @param int $id
     * @return Review
     * @throws ModelNotFoundException
     */
    public function findById(int $id): Review
    {
        return Review::findOrFail($id);
    }
}
