@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Редактировать товар</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-sm">Назад</a>
        </div>
        <div class="container card p-3">
            <form class="gap-4 d-flex flex-column" method="post" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="row gap-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Хлеб">
                            <label for="name">Название</label>

                        </div>
                        @error('name')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="categories" name="category_id">
                                @foreach($categories as $category)
                                    <option
                                        @selected($product->category_id === $category->id)
                                        value="{{ $category->id }}"
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="categories">Выбрать категорию</label>
                        </div>
                        @error('category_id')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row gap-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Комментарий к товару" id="description" style="height: 100px">{{ old('description', $product->description) }}</textarea>
                            <label for="description">Комментарий</label>
                        </div>
                        @error('description')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row gap-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input name="price" value="{{ old('price', $product->price) }}" type="number" class="form-control" id="price" placeholder="9999.99" step="1" min="0">
                            <label for="price">Цена</label>
                        </div>
                        @error('price')
                            <div class="alert text-danger p-2 m-0">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input name="amount" value="{{ old('amount', $product->amount) }}" type="number" class="form-control" id="amount" placeholder="100" step="1" min="0">
                            <label for="amount">Количество</label>
                        </div>
                        @error('amount')
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
