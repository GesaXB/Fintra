<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Budgets;

class BudgetsController extends Controller
{
    public function index()
    {
        try {
            $budgets = Budgets::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
            return response()->json([
                'success' => true,
                'data' => $budgets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch budgets'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:0',
                'description' => 'nullable|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ]);

            $budget = Budgets::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Budget created successfully',
                'data' => $budget
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
                'message' => 'Failed to create budget'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $budget = Budgets::where('id', $id)->where('user_id', Auth::id())->first();

            if (!$budget) {
                return response()->json([
                    'success' => false,
                    'message' => 'Budget not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $budget
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch budget'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $budget = Budgets::where('id', $id)->where('user_id', Auth::id())->first();

            if (!$budget) {
                return response()->json([
                    'success' => false,
                    'message' => 'Budget not found'
                ], 404);
            }

            $validated = $request->validate([
                'amount' => 'sometimes|numeric|min:0',
                'description' => 'nullable|string|max:255',
                'start_date' => 'sometimes|date',
                'end_date' => 'sometimes|date|after_or_equal:start_date'
            ]);

            $budget->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Budget updated successfully',
                'data' => $budget
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
                'message' => 'Failed to update budget'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $budget = Budgets::where('id', $id)->where('user_id', Auth::id())->first();

            if (!$budget) {
                return response()->json([
                    'success' => false,
                    'message' => 'Budget not found'
                ], 404);
            }

            $budget->delete();

            return response()->json([
                'success' => true,
                'message' => 'Budget deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete budget'
            ], 500);
        }
    }

    public function stats()
    {
        try {
            $userId = Auth::id();

            $total = Budgets::where('user_id', $userId)->count();
            $totalAmount = Budgets::where('user_id', $userId)->sum('amount');

            return response()->json([
                'success' => true,
                'data' => [
                    'total_budgets' => $total,
                    'total_amount' => $totalAmount
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch budget stats'
            ], 500);
        }
    }
}
