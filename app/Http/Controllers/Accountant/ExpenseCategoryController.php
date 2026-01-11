<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of expense categories.
     */
    public function index()
    {
        $categories = ExpenseCategory::withCount('expenses')
            ->withSum(['expenses as total_amount' => function ($query) {
                $query->whereIn('status', ['approved', 'paid']);
            }], 'amount_cents')
            ->ordered()
            ->paginate(20);

        return view('accountant.expense-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new expense category.
     */
    public function create()
    {
        return view('accountant.expense-categories.create');
    }

    /**
     * Store a newly created expense category.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:expense_categories,name'],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:7'],
            'icon' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        $data['is_active'] = $data['is_active'] ?? true;
        $data['color'] = $data['color'] ?? '#6B7280';

        ExpenseCategory::create($data);

        return redirect()->route('accountant.expense-categories.index')
            ->with('success', 'Expense category created successfully.');
    }

    /**
     * Display the specified expense category.
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->loadCount('expenses');
        $expenses = $expenseCategory->expenses()
            ->with(['branch', 'user'])
            ->latest('expense_date')
            ->paginate(20);

        return view('accountant.expense-categories.show', compact('expenseCategory', 'expenses'));
    }

    /**
     * Show the form for editing the specified expense category.
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('accountant.expense-categories.edit', compact('expenseCategory'));
    }

    /**
     * Update the specified expense category.
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('expense_categories', 'name')->ignore($expenseCategory->id)],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:7'],
            'icon' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        $expenseCategory->update($data);

        return redirect()->route('accountant.expense-categories.index')
            ->with('success', 'Expense category updated successfully.');
    }

    /**
     * Remove the specified expense category.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        // Check if category has expenses
        if ($expenseCategory->expenses()->exists()) {
            return redirect()->route('accountant.expense-categories.index')
                ->with('error', 'Cannot delete category with existing expenses. Please reassign expenses first.');
        }

        $expenseCategory->delete();

        return redirect()->route('accountant.expense-categories.index')
            ->with('success', 'Expense category deleted successfully.');
    }
}
