<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Branch;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Income::with('branch')->orderByDesc('received_at');

        // Filter by branch
        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->get('branch_id'));
        }

        // Filter by month
        if ($request->filled('month')) {
            $month = $request->get('month');
            if ($month === 'all') {
                // No filter
            } else {
                $date = \Carbon\Carbon::parse($month . '-01');
                $query->whereBetween('received_at', [
                    $date->copy()->startOfMonth(),
                    $date->copy()->endOfMonth()
                ]);
            }
        } else {
            // Default to current month
            $query->whereBetween('received_at', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ]);
        }

        $incomes = $query->paginate(20)->appends($request->query());
        $branches = Branch::orderBy('name')->get();

        // Generate months for dropdown (last 24 months)
        $months = [];
        for ($i = 0; $i < 24; $i++) {
            $date = now()->subMonths($i);
            $months[] = [
                'value' => $date->format('Y-m'),
                'label' => $date->format('F Y')
            ];
        }

        return view('admin.incomes.index', compact('incomes', 'branches', 'months'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        return view('admin.incomes.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'branch_id' => ['nullable', 'exists:branches,id'],
            'amount' => ['required'],
            'currency' => ['nullable', 'string', 'max:3'],
            'category' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'received_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $amountCents = (int) round(floatval(str_replace(',', '', $data['amount'])));

        $income = Income::create([
            'branch_id' => $data['branch_id'] ?? null,
            'amount_cents' => $amountCents,
            'currency' => $data['currency'] ?? 'RWF',
            'category' => $data['category'] ?? null,
            'source' => $data['source'] ?? null,
            'received_at' => $data['received_at'] ?? now(),
            'notes' => $data['notes'] ?? null,
            'recorded_by_user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.incomes.index')->with('status', 'Income recorded.');
    }

    public function show(Income $income)
    {
        $income->load('branch', 'recordedBy');
        return view('admin.incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $branches = Branch::orderBy('name')->get();
        return view('admin.incomes.edit', compact('income', 'branches'));
    }

    public function update(Request $request, Income $income)
    {
        $data = $request->validate([
            'branch_id' => ['nullable', 'exists:branches,id'],
            'amount' => ['required'],
            'currency' => ['nullable', 'string', 'max:3'],
            'category' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'received_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $amountCents = (int) round(floatval(str_replace(',', '', $data['amount'])));

        $income->update([
            'branch_id' => $data['branch_id'] ?? null,
            'amount_cents' => $amountCents,
            'currency' => $data['currency'] ?? 'RWF',
            'category' => $data['category'] ?? null,
            'source' => $data['source'] ?? null,
            'received_at' => $data['received_at'] ?? now(),
            'notes' => $data['notes'] ?? null,
        ]);

        return redirect()->route('admin.incomes.index')->with('status', 'Income updated.');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('admin.incomes.index')->with('status', 'Income deleted.');
    }
}
