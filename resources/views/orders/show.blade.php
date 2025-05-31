@extends('layouts.app')
@section('content')
    <div class="w-75 mx-auto mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Детали заказа</h2>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-info btn-sm">Назад</a>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <strong>Заказ #{{ $order->id }}</strong>
                </span>
                <div>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-warning btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Вы уверены, что хотите удалить заказ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Удалить">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="d-flex justify-content-between"><strong>ФИО:</strong> {{ $order->full_name }}</p>
                <p class="d-flex justify-content-between align-items-center"><strong>Статус:</strong>
                    <span class="badge rounded-pill text-bg-info">{{ $order->status === 'new' ? 'Новый' : 'Выполнен' }}</span>
                </p>
                <p class="d-flex justify-content-between"><strong>Товар:</strong> {{ $order->product->name }}</p>
                <p class="d-flex justify-content-between"><strong>Цена за единицу:</strong> {{ $order->product->price_rub }}</p>
                <p class="d-flex justify-content-between"><strong>Количество:</strong> {{ $order->product_amount }}</p>
                <p class="d-flex justify-content-between"><strong>Итоговая цена:</strong> {{ $order->total_price }}</p>
                <p><strong>Комментарий:</strong></p>
                <p>{{ $order->comment ?? '—' }}</p>
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Добавлено: {{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}
                    </div>

                    {{-- Кнопка обновления статуса --}}
                    @if($order->status === 'new')
                        <form action="{{ route('orders.complete', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Завершить заказ</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
