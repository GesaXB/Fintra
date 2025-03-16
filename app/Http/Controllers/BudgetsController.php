<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgets;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Budgets::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $budget = Budgets::create($request->all());

        return response()->json([
            'message' => 'Budget created successfully',
            'data' => $budget
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Budgets $Budget)
    {
        return response()->json($Budget);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budgets $budget)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'category_id' => 'sometimes|exists:categories,id',
            'amount' => 'sometimes|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $budget->update($request->all());

        return response()->json([
            'message' => 'Budget updated successfully',
            'data' => $budget
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budgets $budget)
    {
        $budget->delete();
        return response()->json(['message'=> 'Budget deleted successfully'],204);
    }
}
