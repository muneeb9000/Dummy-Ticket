<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryController extends Controller
{
   
    public function index(Request $request)
    {
        if (!Auth::user()->can('media.view')) {
            abort(403, 'Unauthorized Access');
        }
        $query = Gallery::query();
        if ($request->has('search') && $request->search !== '') {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }
        $media = $query->latest()->paginate(12);
        if ($request->ajax()) {
            $data = $media->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'image_url' => $item->image_url,
                    'caption' => $item->caption ?? '',
                    'status' =>$item->status,
                ];
            });
            $html = view('admin.pages.media.partials.gallery', compact('media'))->render();
            return response()->json(['html' => $html, 'media' => $data]);
        }
        return view('admin.pages.media.index', compact('media'));
    }

   public function store(Request $request)
    {
        if (!Auth::user()->can('media.create')) {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/gallery', $fileName, 'public');
            $gallery = Gallery::create([
                'title' => $request->title,
                'caption' => $request->caption,
                'alt_text' => $request->alt_text,
                'description' => $request->description,
                'image' => 'storage/' . $path,
            ]);
            return redirect()->back()->with('success', 'Image Uploaded Successfully');
        }

        return redirect()->back()->with('error', 'Image upload failed');
    }

    public function upload(Request $request)
    {
        if (!Auth::user()->can('media.create')) {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/gallery', $fileName, 'public');
            $gallery = Gallery::create([
                'title' => $request->title,
                'caption' => $request->caption,
                'alt_text' => $request->alt_text,
                'description' => $request->description,
                'image' => 'storage/' .  $path, 
            ]);
            $image_url = asset('storage/' . $path);
            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully.',
                'image_url' => $image_url,
                'id' => $gallery->id,
                'title' => $gallery->title,
                'caption' => $gallery->caption,
                'alt_text' => $gallery->alt_text,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image upload failed.',
        ], 400);
    }

   public function update(Request $request, Gallery $media)
    {
 
        if (!Auth::user()->can('media.edit')) {
            abort(403, 'Unauthorized Access');
        }
        
        if ($request->ajax() && $request->has('field') && $request->has('value')) {
            $field = $request->input('field');
            $value = $request->input('value');
            $allowedFields = ['title', 'caption', 'alt_text', 'description', 'status'];
            if (!in_array($field, $allowedFields)) {
                return response()->json(['error' => 'Invalid field'], 400);
            }
            $rules = [
                'title' => 'nullable|string|max:255',
                'caption' => 'nullable|string|max:255',
                'alt_text' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'nullable|boolean',
            ];
            $validator = Validator::make([$field => $value], [$field => $rules[$field]]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }
            $media->update([$field => $value]);
            
            return response()->json([
                'success' => true,
                'message' => ucfirst(str_replace('_', ' ', $field)) . ' updated successfully',
                'field' => $field,
                'value' => $value
            ]);
        }
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);
        
        $media->update($validated);
        
        return redirect()->route('admin.media.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    { 
        
        if (!Auth::user()->can('media.delete')) {
        abort(403, 'Unauthorized Access');
        } 
        $media = Gallery::findOrFail($id);
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Image deleted successfully.');
    }

    public function deleteMedia($id)
    {
       
        try {
            $media = Gallery::findOrFail($id);
            $media->delete();
            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

}
