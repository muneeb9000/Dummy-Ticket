<?php

namespace App\Services;

use App\Models\VisaFlag;
use Illuminate\Support\Facades\Storage;

class VisaFlagService
{
    public function all()
    {
        return VisaFlag::paginate('15');
    }

    public function find($id)
    {
        return VisaFlag::findOrFail($id);
    }

    public function store(array $data, $image = null)
    {
        if ($image) {
            $data['image'] = $image->store('visa_flags', 'public');
        }
        return VisaFlag::create($data);
    }

    public function update($id, array $data, $image = null)
    {
        $visaFlag = $this->find($id);

        if ($image) {
            if ($visaFlag->image && Storage::disk('public')->exists($visaFlag->image)) {
                Storage::disk('public')->delete($visaFlag->image);
            }
            $data['image'] = $image->store('visa_flags', 'public');
        }

        $visaFlag->update($data);
        return $visaFlag;
    }

    public function delete($id)
    {
        $visaFlag = $this->find($id);

        if ($visaFlag->image && Storage::disk('public')->exists($visaFlag->image)) {
            Storage::disk('public')->delete($visaFlag->image);
        }

        return $visaFlag->delete();
    }
}
