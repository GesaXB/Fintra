<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $transactions = Transactions::with(['category', 'user'])
                ->forUser(Auth::id())
                ->orderBy('transaction_date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $transactions
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error loading transactions: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load transactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get categories for transaction form
     */
    public function getCategories()
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $categories = Categories::where('user_id', Auth::id())
                ->select('id', 'name', 'type')
                ->orderBy('name')
                ->get();

            if ($categories->isEmpty()) {
                Log::warning('No categories found for user: ' . Auth::id());
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'No categories found for this user'
                ], 200);
            }

            return response()->json([
                'success' => true,
                'data' => $categories
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading categories: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get categories by type
     */
    public function getCategoriesByType($type)
    {
        try {
            if (!in_array($type, ['income', 'expense'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid category type'
                ], 400);
            }

            $categories = Categories::where('user_id', Auth::id())
                ->where('type', $type)
                ->select('id', 'name', 'type')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $categories
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading categories by type: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load categories by type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|exists:categories,id',
                'amount' => 'required|numeric|min:0.01',
                'transaction_date' => 'required|date',
                'description' => 'required|string|max:1000',
                'type' => 'required|in:income,expense'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Pastikan category milik user yang login
            $category = Categories::where('id', $request->category_id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found or not authorized'
                ], 404);
            }

            // Pastikan type transaction sesuai dengan type category
            if ($category->type !== $request->type) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction type must match category type'
                ], 422);
            }

            $transaction = Transactions::create([
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'amount' => $request->amount,
                'transaction_date' => $request->transaction_date,
                'description' => $request->description,
                'type' => $request->type
            ]);

            $transaction->load(['category', 'user']);

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
                'data' => $transaction
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error creating transaction: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create transaction',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        $transaction = Transactions::with(['category', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transactions::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|exists:categories,id',
            'amount' => 'sometimes|numeric|min:0.01',
            'transaction_date' => 'sometimes|date',
            'description' => 'sometimes|string|max:1000',
            'type' => 'sometimes|in:income,expense'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Jika category_id diupdate, pastikan milik user
        if ($request->has('category_id')) {
            $category = Categories::where('id', $request->category_id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found or not authorized'
                ], 404);
            }

            // Pastikan type sesuai
            $type = $request->type ?? $transaction->type;
            if ($category->type !== $type) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction type must match category type'
                ], 422);
            }
        }

        $transaction->update($request->only([
            'category_id', 'amount', 'transaction_date', 'description', 'type'
        ]));

        $transaction->load(['category', 'user']);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transactions::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }

    /**
     * Get transaction summary
     */
    public function summary()
    {
        $userId = Auth::id();
        
        $totalIncome = Transactions::forUser($userId)
            ->income()
            ->sum('amount');
            
        $totalExpense = Transactions::forUser($userId)
            ->expense()
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;

        return response()->json([
            'success' => true,
            'data' => [
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $balance
            ]
        ], 200);
    }
}