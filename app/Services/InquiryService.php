<?php

namespace App\Services;

use App\Models\Inquiry;

class InquiryService
{
    public function create(array $data)
    {
        return Inquiry::create($data);
    }

    public function update(Inquiry $inquiry, array $data)
    {
        $inquiry->update($data);
        return $inquiry;
    }

    public function delete(Inquiry $inquiry)
    {
        return $inquiry->delete();
    }
}
