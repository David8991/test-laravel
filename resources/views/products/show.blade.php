@extends('layouts.app')
@section('content')
    <div class="w-75 mx-auto mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Информация о товаре</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-sm">Назад</a>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $product->name }}</strong>
                </span>
                <div>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Удалить">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="d-flex justify-content-between"><strong>Категория:</strong> {{ $product->category->name }}</p>
                <p class="d-flex justify-content-between"><strong>Цена:</strong> {{ $product->priceRub }}</p>
                <p class="d-flex justify-content-between"><strong>Количество:</strong> {{ $product->amount }}</p>
                <p><strong>Описание:</strong></p>
                <p>{{ $product->description ?? '—' }}</p>
            </div>
            <div class="card-footer text-muted">
                Добавлено: {{ $product->created_at->format('d.m.Y H:i') }}
            </div>
        </div>
    </div>
@endsection
