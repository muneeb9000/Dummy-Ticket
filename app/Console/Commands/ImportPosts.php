<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\BlogCategory;

class ImportPosts extends Command
{
    protected $signature = 'import:posts';
    protected $description = 'Import posts from WordPress API into blogs table';

    public function handle()
    {
        $this->info('Fetching posts from WordPress...');

        $page = 1;
        $importedCount = 0;

        do {
            $response = Http::get('https://flightitineraryforvisa.com/wp-json/wp/v2/posts', [
                '_embed' => true,
                'per_page' => 100,
                'page' => $page,
            ]);

            if (!$response->ok()) {
                dd($response);
                $this->error("Failed to fetch page $page.");
                return 1;
            }

            $posts = $response->json();

            if (empty($posts)) break;

            foreach ($posts as $post) {
                $slug = $post['slug'];

                // Prevent duplicate imports
                if (Blog::where('slug', $slug)->exists()) {
                    $this->info("Skipping existing post: $slug");
                    continue;
                }

                $categoryData = $post['_embedded']['wp:term'][0][0] ?? null;

                $categoryName = $categoryData['name'] ?? 'Uncategorized';
                $categorySlug = $categoryData['slug'] ?? \Str::slug($categoryName);

                $category = BlogCategory::firstOrCreate(
                    ['slug' => $categorySlug],
                    ['name' => $categoryName]
                );

                // Get featured image
                $imageUrl = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? null;

                // Extract image filename from URL
                $imagePath = $imageUrl ? parse_url($imageUrl, PHP_URL_PATH) : null;
                $image = $imagePath ? ltrim($imagePath, '/') : null;

                // Create Gallery record
                $media = null;
                if ($image) {
                    $media = Gallery::create([
                        'title' => html_entity_decode($post['title']['rendered']),
                        'caption' => '',
                        'alt_text' => $post['_embedded']['wp:featuredmedia'][0]['alt_text'] ?? '',
                        'description' => '',
                        'status' => 1,
                        'image' => $image,
                    ]);
                }

                // Clean content: remove the ez-toc container div
                $rawContent = $post['content']['rendered'];
                $cleanContent = preg_replace('/<div id="ez-toc-container"[\\s\\S]*?<\/div>/', '', $rawContent);

                // Create Blog
                $blog = Blog::create([
                    'title'       => html_entity_decode(strip_tags($post['title']['rendered'])),
                    'slug'        => $slug,
                    'content'     => $cleanContent,
                    'image'       => $image,
                    'media_id'    => $media ? $media->id : null,
                    'category_id' => $category->id,
                ]);
                $blog->created_at= \Carbon\Carbon::parse($post['date']);
                $blog->updated_at= \Carbon\Carbon::parse($post['modified']);
                $blog->save();
                // SEO from yoast_head_json
                $yoast = $post['yoast_head_json'] ?? [];

                $blog->seo()->updateOrCreate([], [
                    'title'         => html_entity_decode($yoast['title'] ?? $blog->title),
                    'description'   => $yoast['description'] ?? '',
                    'keywords'      => $yoast['keywords'] ?? '',
                    'robots'        => 'noindex, nofollow',
                    'image'         => $image ? 'https://flightitineraryforvisa.com/' . $image : '',
                    'focus_keyword' => '',
                    'author'        => 'FIFV Travels',
                    'canonical_url' => 'https://flightitineraryforvisa.com/' . $slug . '/',
                ]);

                $this->info("Imported: {$blog->title}");
                $importedCount++;
            }

            $page++;
        } while (count($posts) >= 100);

        $this->info("Import complete. Total posts imported/skipped: $importedCount");
        return 0;
    }
}
