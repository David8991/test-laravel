<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # Получаем Товары и загружаем связь с категориями
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategories::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'nullable|string|min:7',
            'price' => 'required|integer|min:0',
            'amount' => 'nullable',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Товар добавлен.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategories::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'nullable|string|min:7',
            'price' => 'required|integer|min:0',
            'amount' => 'nullable',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Товар обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар удалён.');
    }
}
