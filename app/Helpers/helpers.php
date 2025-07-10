<?php

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

if (!function_exists('handleDelete')) {
    function handleDelete($model)
    {
        try {
            $model->delete();
            Session::flash('success', 'Record deleted successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                Session::flash('error', 'Record is used somewhere.');
            } else {
                Session::flash('error', 'Something went wrong.');
            }
        }
        return redirect()->back(); 
    
    }
}

function extractHeadingsFromHtml($html)
{
    $dom = new \DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $headings = [];
    
    foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as $tag) {
        $nodes = $dom->getElementsByTagName($tag);
        foreach ($nodes as $node) {
            $text = $node->textContent;
            $slug = \Str::slug($text);
            $node->setAttribute('id', $slug);
            
            $headings[] = [
                'tag' => $tag,
                'text' => $text,
                'slug' => $slug
            ];
        }
    }
    
    $body = $dom->getElementsByTagName('body')->item(0);
    $modifiedHtml = '';
    if ($body) {
        foreach ($body->childNodes as $child) {
            $modifiedHtml .= $dom->saveHTML($child);
        }
    }
    
    return [
        'headings' => $headings,
        'html' => $modifiedHtml
    ];
}
