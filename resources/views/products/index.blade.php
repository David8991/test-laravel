@extends('layouts.app')
@section('content')
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Товары</h2>
            <a href="{{ route('products.create') }}" class="btn btn-outline-info btn-sm">Добавить</a>
        </div>
        <div class="container card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->priceRub }}</td>
                            <td>
                                <span>
                                    <div class="flex justify-center space-x-2">
                                        <!-- Кнопка "Просмотр" -->
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm" title="Просмотр">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <!-- Кнопка "Редактировать" -->
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm" title="Редактировать">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Кнопка "Удалить" -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Удалить" onclick="return confirm('Вы уверены, что хотите удалить этот товар?')">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{ $products->links() }}</div>
        </div>
    </div>
@endsection
