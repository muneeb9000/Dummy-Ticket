<?php

namespace App\Services;

use App\Models\Snippet;

class SnippetService
{
    public function store(array $data): Snippet
    {
        return Snippet::create($data);
    }

    public function update(Snippet $snippet, array $data): Snippet
    {
        $snippet->update($data);
        return $snippet;
    }
}
