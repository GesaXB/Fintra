<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;



class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(Categories::all());
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:50'
        ]);

        // Buat kategori baru
        $category = Categories::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }


    public function show($id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }



    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'sometimes|string|max:50',
            'type' => 'sometimes|in:income,expense',
        ]);

        $category->update($request->all());

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
