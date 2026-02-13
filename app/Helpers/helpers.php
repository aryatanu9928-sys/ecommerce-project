<?php

use App\Models\Category;

if (!function_exists('getCategories')) {
    function getCategories()
    {
        return Category::where('status', 1)
            ->whereNull('parent_id')
            ->get();
    }
}
