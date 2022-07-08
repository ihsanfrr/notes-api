<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['subcategory'])->get();

        return ResponseFormatter::success([
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return ResponseFormatter::success(null, 'Category successfully created');
    }

    public function update(Request $request, Category $category)
    {
        if ($category) {
            $request->validate([
                'name' => 'required'
            ]);
    
            $category->update([
                'name' => $request->name,
            ]);
    
            return ResponseFormatter::success($category, 'Category successfully updated');
        } else {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
            ], 
            'Please contact developer', 401);
        }
    }
    
    public function destroy(Category $category)
    {
        $category->delete();

        return ResponseFormatter::success(null, 'Category successfully deleted');
    }
}
