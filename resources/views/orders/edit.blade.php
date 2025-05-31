@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Редактировать заказ</h2>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-info btn-sm">Назад</a>
        </div>
        <div class="container card p-3">
            <form class="gap-4 d-flex flex-column" method="post" action="{{ route('orders.update', $order->id) }}">
                @csrf
                @method('PUT')
                <div class="row gap-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $order->full_name) }}" placeholder="Иванов Иван Иванович">
                            <label for="full_name">ФИО покупателя</label>
                        </div>
                        @error('full_name')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row gap-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="products" name="product_id">
                                <option value="">-- Выбрать --</option>
                                @foreach($products as $product)
                                    <option
                                        @selected($product->id === $order->product_id)
                                        value="{{ $product->id }}"
                                    >
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="products">Выберите товар</label>
                        </div>
                        @error('product_id')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input name="product_amount" value="{{ old('product_amount', $order->product_amount) }}" type="number" class="form-control" id="product_amount" placeholder="100" step="1" min="0">
                            <label for="product_amount">Количество</label>
                        </div>
                        @error('product_amount')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="status" name="status">
                                <option value="new" @selected($order->status == 'new')>Новый</option>
                                <option value="completed" @selected($order->status == 'completed')>Выполнен</option>
                            </select>
                            <label for="status">Статус</label>
                        </div>
                        @error('status')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row gap-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea class="form-control" name="comment" placeholder="Комментарий к товару" id="comment" style="height: 100px">{{ old('comment', $order->comment) }}</textarea>
                            <label for="comment">Комментарий</label>
                        </div>
                        @error('comment')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
