<?php

namespace App\Http\Controllers;

use Faker\Factory as Faker;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # Сортировка заказов сначала по статусу(Новые) потом по дате создания(Последние)
        $orders = Order::with(['product'])
            ->orderByDesc('status')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255|min:3',
            'product_id' => 'required|exists:products,id',
            'product_amount' => 'required|integer|min:1',
            'comment' => 'nullable|string|min:7',
        ]);

        # Ставим по дефолту статус "Новый"
        $validated['status'] = 'new';
        $validated['created_at'] = now();

        # Добавляем ID пользователя если авторизован
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Заказ создан.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        # Загружаем связь с Товаром
        $order->load('product');
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255|min:3',
            'product_id' => 'required|exists:products,id',
            'product_amount' => 'required|integer|min:1',
            'comment' => 'nullable|string|min:7',
            'status' => 'in:new,completed',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)->with('success', 'Заказ обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удалён.');
    }

    /**
     * Функция обновления статуса.
     */
    public function complete(Order $order)
    {
        $order->status = 'completed';
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Статус заказа обновлён на "Выполнен".');
    }
}
