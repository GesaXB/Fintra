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
        $budget = Budgets::create($request->all());

        return response()->json([
            'message' => 'Budget created successfully',
            'data' => $budget
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $budget = Budgets::find($id);

        if (!$budget) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $budget
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budgets $budget)
    {

        $budget->update($request->all());

        return response()->json([
            'message' => 'Budget updated successfully',
            'data' => $budget
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $budget = Budgets::find($id);

        if (!$budget) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $budget->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
