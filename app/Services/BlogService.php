<?php


namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateBlogRequest;

class BlogService
{
    public function store(array $data)
    {
        if (empty($data['slug'])) {
            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $i = 1;
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        $seoFields = [
            'meta_title',
            'meta_description',
            'meta_keywords',
            'focus_keyword',
            'meta_image',
            'robots',
        ];
        $seoData = [];
        foreach ($seoFields as $field) {
            $seoData[$field] = $data[$field] ?? null;
            unset($data[$field]);
        }

        $blog = Blog::create($data);
        $blog->seo()->updateOrCreate(
            [],
            [
                'title'       => $seoData['meta_title'] ?? $blog->title,
                'description' => $seoData['meta_description'] ?? '',
                'keywords'    => $seoData['meta_keywords'] ?? '',
                'robots'      => $seoData['robots'] ?? '',
                'image'       => $seoData['meta_image'] ?? ($blog->media->image_url),
                'focus_keyword'      => $seoData['focus_keyword'] ?? '',
                'author' =>'FIFV Travels',
                'canonical_url'=>url($blog->slug),
            ]
        );
        return $blog;
    }

    public function update(Blog $blog, UpdateBlogRequest $data)
    {
        $blogData =  $data->validated();
        $data = $data->all();
         if (empty($blogData['slug'])) {
            $slug = Str::slug($blogData['title']);
            $originalSlug = $slug;
            $i = 1;
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            $blogData['slug'] = $slug;
        }
        
        $blog->update($blogData);
        
        $seoFields = [
            'meta_title',
            'meta_description',
            'meta_keywords',
            'focus_keyword',
            'meta_image',
            'robots',
        ];
        $seoData = [];
        foreach ($seoFields as $field) {
            $seoData[$field] = $data[$field] ?? null;
            unset($data[$field]);
        }
        $blog->seo()->updateOrCreate(
        [],
        [
            'title'       => $seoData['meta_title'] ?? $blog->title,
            'description' => $seoData['meta_description'] ?? '',
            'keywords'    => $seoData['meta_keywords'] ?? '',
            'robots'      => $seoData['robots'] ?? '',
            'image'       => $seoData['meta_image'] ?? ($blog->media->image_url),
            'focus_keyword'      => $seoData['focus_keyword'] ?? '',
            'author' =>'FIFV Travels',
            'canonical_url'=>url($blog->slug),
        ]
    );
        return $blog;
    }
}
