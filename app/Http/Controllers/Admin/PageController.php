<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function seo($id)
    {

        $page = Page::findOrFail($id);
        return response()->json([
            'success' => true,
            'seo' => $page->seo // Assuming relation
        ]);
    }

    public function index(Request $request)
    {
          if (!Auth::user()->can('seo.view')) {
        abort(403, 'Unauthorized Access');
    }


        if ($request->ajax()) {
            $pages = Page::select(['id', 'url', 'title', 'created_at'])->get();
            return response()->json(['data' => $pages]);
        }

        return view('admin.pages.seo_pages.index'); // Blade view for table
    }
      public function store(Request $request)
    {
          if (!Auth::user()->can('seo.store')) {
        abort(403, 'Unauthorized Access');
    }

        $validated = $request->validate([
            'url' => 'required|string|max:255|unique:pages,url',
            'title' => 'nullable|string|max:255',
        ]);

        $page = \App\Models\Page::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Page created successfully!',
            'page' => $page,
        ]);
    }

    public function seoStore(Request $request)
    {
          if (!Auth::user()->can('seo.store')) {
        abort(403, 'Unauthorized Access');
        }

        $id = $request->page_id;
        $seoData = $request->only(['meta_title', 'meta_description', 'meta_keywords', 'robots', 'meta_image']);
        $page=Page::findOrFail($id);
        $page->seo()->updateOrCreate(
            [],
            [
                'title'       => $seoData['meta_title'] ?? $page->title,
                'description' => $seoData['meta_description'] ?? '',
                'keywords'    => $seoData['meta_keywords'] ?? '',
                'robots'      => $seoData['robots'] ?? '',
                'image'       => $seoData['meta_image'] ?? '',
                'author'      => 'FIFV Travels',
                'canonical_url' =>url($page->url)."/",
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Seo created successfully!',
            'page' => $page->seo,
        ]);
    }

    public function edit(\App\Models\Page $page)
    {
          if (!Auth::user()->can('seo.edit')) {
        abort(403, 'Unauthorized Access');
    }

        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }
    public function update(Request $request, \App\Models\Page $page)
    {
          if (!Auth::user()->can('seo.edit')) {
        abort(403, 'Unauthorized Access');
    }
        $validated = $request->validate([
            'url' => 'required|string|max:255|unique:pages,url,' . $page->id,
            'title' => 'nullable|string|max:255',
        ]);

        $page->update($validated);

        	 $page->seo()->updateOrCreate(
            [],
            [
                'canonical_url' =>url($page->url)."/",
            ]   );

        return response()->json([
            'success' => true,
            'message' => 'Page updated successfully!',
            'page' => $page,
        ]);
    }
    public function destroy(\App\Models\Page $page)
    {

          if (!Auth::user()->can('seo.delete')) {
        abort(403, 'Unauthorized Access');
    }
        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Page deleted successfully!',
        ]);
    }
}
