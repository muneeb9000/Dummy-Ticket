<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSnippetRequest;
use App\Http\Requests\UpdateSnippetRequest;
use App\Models\Snippet;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Services\SnippetService;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    protected $snippetService;

    public function __construct(SnippetService $snippetService)
    {
        $this->snippetService = $snippetService;
    }

    public function index(Request $request)
    {

        if (!Auth::user()->can('snippets.view')) {
        abort(403, 'Unauthorized Access');
    }
        $snippets = Snippet::latest()->get();
        


           if ($request->ajax()) {
                 return response()->json([
                'status' => true,
                'data' => $snippets
            ]);
           }
        return view('admin.pages.snippets.index');
       
    }

    public function store(StoreSnippetRequest $request)
    {
     if (!Auth::user()->can('snippets.create')) {
        abort(403, 'Unauthorized Access');
    }
        $snippet = $this->snippetService->store($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Snippet created successfully.',
            'data' => $snippet
        ], 201);
    }

    public function update(UpdateSnippetRequest $request, Snippet $snippet)
    {
       if (!Auth::user()->can('snippets.edit')) {
        abort(403, 'Unauthorized Access');
    }
        $updatedSnippet = $this->snippetService->update($snippet, $request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Snippet updated successfully.',
            'data' => $updatedSnippet
        ]);
    }

    public function destroy(Snippet $snippet)
    {
         if (!Auth::user()->can('snippets.delete')) {
        abort(403, 'Unauthorized Access');
    }
        $snippet->delete();

        return response()->json([
            'status' => true,
            'message' => 'Snippet deleted successfully.'
        ]);
    }
}
