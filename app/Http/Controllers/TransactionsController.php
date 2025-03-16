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
        return response()->json($transaction, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transaction)
    {
        return response()->json($transaction);
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
    public function destroy(Transactions $transaction)
    {
        $transaction->delete();
        return response()->json(null,204);
    }
}
