<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $blog; // 1. Add property

    // 2. Accept in constructor
    public function __construct($blog = null)
    {
        $this->blog = $blog;
    }

    // 3. Pass to view
    public function render(): View
    {
        return view('layouts.app', [
            'blog' => $this->blog,
        ]);
    }
}
