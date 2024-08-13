<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function openCategoriesPage()
    {
        $categories = Category::all();
        return view('auth.categories.index', compact('categories'));
    }
}
