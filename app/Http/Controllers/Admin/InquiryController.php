<?php

namespace App\Http\Controllers\Admin;

use App\Events\InquirySubmitted;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;
use App\Services\InquiryService;
use App\Http\Requests\InquiryRequest;

class InquiryController extends Controller
{
    protected $inquiryService;

    public function __construct(InquiryService $inquiryService)
    {
        $this->inquiryService = $inquiryService;
    }

    public function index()
    {
        if (!Auth::user()->can('inquiries.view')) {
        abort(403, 'Unauthorized Access');
    }

        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        return view('admin.pages.inquiries.index', compact('inquiries'));
    }

    public function store(InquiryRequest $request)
    {

        $this->inquiryService->create($request->validated());

         event(new InquirySubmitted($request->all()));
        return redirect()->back()->with('success', 'Inquiry created successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
         if (!Auth::user()->can('inquiries.delete')) {
        abort(403, 'Unauthorized Access');
    }
        $this->inquiryService->delete($inquiry);
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
