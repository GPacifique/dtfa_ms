<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of income categories.
     */
    public function index()
    {
        $categories = IncomeCategory::withCount('incomes')
            ->withSum('incomes as total_amount', 'amount_cents')
            ->ordered()
            ->paginate(20);

        return view('accountant.income-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new income category.
     */
    public function create()
    {
        return view('accountant.income-categories.create');
    }

    /**
     * Store a newly created income category.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:income_categories,name'],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:7'],
            'icon' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        $data['is_active'] = $data['is_active'] ?? true;
        $data['color'] = $data['color'] ?? '#10B981';

        IncomeCategory::create($data);

        return redirect()->route('accountant.income-categories.index')
            ->with('success', 'Income category created successfully.');
    }

    /**
     * Display the specified income category.
     */
    public function show(IncomeCategory $incomeCategory)
    {
        $incomeCategory->loadCount('incomes');
        $incomes = $incomeCategory->incomes()
            ->with(['branch', 'recordedBy'])
            ->latest('received_at')
            ->paginate(20);

        return view('accountant.income-categories.show', compact('incomeCategory', 'incomes'));
    }

    /**
     * Show the form for editing the specified income category.
     */
    public function edit(IncomeCategory $incomeCategory)
    {
        return view('accountant.income-categories.edit', compact('incomeCategory'));
    }

    /**
     * Update the specified income category.
     */
    public function update(Request $request, IncomeCategory $incomeCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('income_categories', 'name')->ignore($incomeCategory->id)],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:7'],
            'icon' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        $incomeCategory->update($data);

        return redirect()->route('accountant.income-categories.index')
            ->with('success', 'Income category updated successfully.');
    }

    /**
     * Remove the specified income category.
     */
    public function destroy(IncomeCategory $incomeCategory)
    {
        // Check if category has incomes
        if ($incomeCategory->incomes()->exists()) {
            return redirect()->route('accountant.income-categories.index')
                ->with('error', 'Cannot delete category with existing incomes. Please reassign incomes first.');
        }

        $incomeCategory->delete();

        return redirect()->route('accountant.income-categories.index')
            ->with('success', 'Income category deleted successfully.');
    }
}
