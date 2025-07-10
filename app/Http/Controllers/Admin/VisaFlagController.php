<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisaFlagRequest;
use App\Services\VisaFlagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisaFlagController extends Controller
{
    protected $visaFlagService;

    public function __construct(VisaFlagService $visaFlagService)
    {
        $this->visaFlagService = $visaFlagService;
    }

    public function index()
    {

        if (!Auth::user()->can('visa-flags.view')) {
        abort(403, 'Unauthorized Access');
        }
        $flags = $this->visaFlagService->all();
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $flags->items(),
            ]);
        }
        
        return view('admin.pages.flags.index', compact('flags'));
    }

    public function store(VisaFlagRequest $request)
    {
         if (!Auth::user()->can('visa-flags.create')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $this->visaFlagService->store($request->validated(), $request->file('image'));
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Visa flag created successfully.'
                ]);
            }
            
            return redirect()->route('admin.flags.index')->with('success', 'Visa flag created successfully.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating visa flag: ' . $e->getMessage()
                ], 422);
            }
            
            return redirect()->back()->withErrors(['error' => 'Error creating visa flag: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        try {
            $flag = $this->visaFlagService->find($id);
            
            return response()->json([
                'success' => true,
                'data' => $flag
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Flag not found'
            ], 404);
        }
    }

    public function edit($id)
    {
         if (!Auth::user()->can('visa-flags.edit')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $flag = $this->visaFlagService->find($id);
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => $flag
                ]);
            }
            
            return view('admin.pages.flags.edit', compact('flag'));
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Flag not found'
                ], 404);
            }
            
            return redirect()->route('admin.flags.index')->with('error', 'Flag not found');
        }
    }

    public function update(VisaFlagRequest $request, $id)
    {
         if (!Auth::user()->can('visa-flags.edit')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $this->visaFlagService->update($id, $request->validated(), $request->file('image'));
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Visa flag updated successfully.'
                ]);
            }
            
            return redirect()->route('admin.flags.index')->with('success', 'Visa flag updated successfully.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating visa flag: ' . $e->getMessage()
                ], 422);
            }
            
            return redirect()->back()->withErrors(['error' => 'Error updating visa flag: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
         if (!Auth::user()->can('visa-flags.delete')) {
        abort(403, 'Unauthorized Access');
    }
        try {
            $this->visaFlagService->delete($id);
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Visa flag deleted successfully.'
                ]);
            }
            
            return redirect()->route('admin.flags.index')->with('success', 'Visa flag deleted successfully.');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting visa flag: ' . $e->getMessage()
                ], 422);
            }
            
            return redirect()->back()->withErrors(['error' => 'Error deleting visa flag: ' . $e->getMessage()]);
        }
    }
}