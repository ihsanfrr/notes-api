<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::all();

        return ResponseFormatter::success([
            'subcategories' => $subcategories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required'
        ]);

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        return ResponseFormatter::success(null, 'Subcategory successfully created');
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required'
        ]);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        return ResponseFormatter::success($subcategory, 'Subcategory successfully updated');
    }
    
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return ResponseFormatter::success(null, 'Subcategory successfully deleted');
    }
}
