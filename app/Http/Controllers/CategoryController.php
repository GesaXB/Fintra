<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories for the authenticated user
     */
    public function index()
    {
        try {
            // Hanya menampilkan kategori milik user yang sedang login
            $categories = Categories::where('user_id', Auth::id())
                                  ->orderBy('created_at', 'desc')
                                  ->get();
            
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories'
            ], 500);
        }
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    })
                ],
                'type' => 'required|in:income,expense',
            ]);

            $category = Categories::create([
                'user_id' => Auth::id(), // Menggunakan user yang sedang login
                'name' => $request->name,
                'type' => $request->type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category'
            ], 500);
        }
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        try {
            // Hanya menampilkan kategori milik user yang sedang login
            $category = Categories::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->first();

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

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch category'
            ], 500);
        }
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari kategori berdasarkan ID dan user yang sedang login
            $category = Categories::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->first();

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')->where(function ($query) use ($id) {
                        return $query->where('user_id', Auth::id())
                                   ->where('id', '!=', $id);
                    })
                ],
                'type' => 'required|in:income,expense',
            ]);

            $category->update([
                'name' => $request->name,
                'type' => $request->type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category'
            ], 500);
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        try {
            // Hanya menghapus kategori milik user yang sedang login
            $category = Categories::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->first();

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            // Optional: Check if category is being used in transactions
            // if ($category->transactions()->count() > 0) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Cannot delete category that has transactions'
            //     ], 400);
            // }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category'
            ], 500);
        }
    }

    /**
     * Get category statistics for the authenticated user
     */
    public function stats()
    {
        try {
            $userId = Auth::id();
            
            $totalCategories = Categories::where('user_id', $userId)->count();
            $incomeCategories = Categories::where('user_id', $userId)
                                        ->where('type', 'income')
                                        ->count();
            $expenseCategories = Categories::where('user_id', $userId)
                                         ->where('type', 'expense')
                                         ->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total' => $totalCategories,
                    'income' => $incomeCategories,
                    'expense' => $expenseCategories
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics'
            ], 500);
        }
    }
}