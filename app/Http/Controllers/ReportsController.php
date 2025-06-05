<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Categories;
use App\Models\Budgets;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'category', 'budget', 'transaction'])->get();
        return response()->json($reports);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'category_id' => 'required|exists:categories,category_id',
            'budget_id' => 'required|exists:budgets,budget_id',
            'transaction_id' => 'required|exists:transactions,transaction_id',
        ]);

        $report = Report::create($validated);
        return response()->json($report, 201);
    }

    public function show($id)
    {
        $report = Report::with(['user', 'category', 'budget', 'transaction'])->findOrFail($id);
        return response()->json($report);
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,user_id',
            'category_id' => 'sometimes|required|exists:categories,category_id',
            'budget_id' => 'sometimes|required|exists:budgets,budget_id',
            'transaction_id' => 'sometimes|required|exists:transactions,transaction_id',
        ]);

        $report->update($validated);
        return response()->json($report);
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return response()->json(null, 204);
    }
}
