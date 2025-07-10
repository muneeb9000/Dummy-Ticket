<?php 

namespace App\Services;

use App\Models\Faq;
use Illuminate\Support\Facades\Log;
use Exception;

class FaqService
{
    public function store(array $data): bool
    {
        try {
            Faq::create($data);
            return true;
        } catch (Exception $e) {
            Log::error('Faq Store Error: ' . $e->getMessage());
            return false;
        }
    }

    public function update(Faq $faq, array $data): bool
    {
        try {
            return $faq->update($data);
        } catch (Exception $e) {
            Log::error('Faq Update Error: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy(Faq $faq): bool
    {
        try {
            return $faq->delete();
        } catch (Exception $e) {
            Log::error('Faq Delete Error: ' . $e->getMessage());
            return false;
        }
    }
}