<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Services\BlogService;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
          if (!Auth::user()->can('blogs.view')) {
        abort(403, 'Unauthorized Access');
    }
        $blogs = Blog::with('categoryRelation')->latest()->get();
        return view('admin.pages.blogs.index', compact('blogs'));
    }

   public function create()
    {
        if (!Auth::user()->can('blogs.create')) {
            abort(403, 'Unauthorized Access');
        }

        $media = Gallery::where('status', '1')->get()->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'image_url' => $item->image_url,
                'caption' => $item->caption,
                'alt_text' => $item->alt_text
            ];
        });

        $categories = BlogCategory::all();
        return view('admin.pages.blogs.create', compact('categories', 'media'));
    }

    public function store(StoreBlogRequest $request)
    {
       
        if (!Auth::user()->can('blogs.create')) {
        abort(403, 'Unauthorized Access');
    }
        $this->blogService->store($request->validated());
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {

         if (!Auth::user()->can('blogs.edit')) {
        abort(403, 'Unauthorized Access');
    }

         $media = Gallery::get()->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'image_url' => $item->image_url,
                'caption' => $item->caption,
                'alt_text' => $item->alt_text
            ];
        });
        $categories = BlogCategory::all();
        return view('admin.pages.blogs.edit', compact('blog', 'categories', 'media'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        
        if (!Auth::user()->can('blogs.edit')) {
        abort(403, 'Unauthorized Access');
    }
        $this->blogService->update($blog, $request);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if (!Auth::user()->can('blogs.delete')) {
        abort(403, 'Unauthorized Access');
    }
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        return handleDelete($blog);
    }

    public function searchAjax(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:2|max:100'
        ]);
        $searchTerm = $request->get('search');
        $blogs = Blog::with('categoryRelation')
            ->where(function($query) use ($searchTerm) {
                $query->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            })
            ->latest()
            ->limit(10) 
            ->get();
            
        $formattedBlogs = $blogs->map(function($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'excerpt' => Str::limit(strip_tags($blog->content), 100),
                'image_url' => $blog->media->image_url,
                'category' => $blog->categoryRelation->name ?? null,
                'url' => route('website.blog.show', $blog->slug), 
                'created_at' => $blog->created_at->format('M d, Y')
            ];
        });

        return response()->json([
            'success' => true,
            'blogs' => $formattedBlogs,
            'total' => $formattedBlogs->count()
        ]);
    }

}
