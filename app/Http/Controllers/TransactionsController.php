<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use function Termwind\renderUsing;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Transactions::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaction = Transactions::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $transaction
        ], 201);;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction= Transactions::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
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
    public function update(Request $request, Transactions $transaction)
    {
        $transaction->update($request->all());
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transactions::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
