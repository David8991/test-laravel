@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Заказы</h2>
            <a href="{{ route('orders.create') }}" class="btn btn-outline-info btn-sm">Создать</a>
        </div>
        <div class="container card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Итоговая цена</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <th>{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}</th>
                            <td>{{ $order->full_name }}</td>
                            <td>
                                <span class="badge rounded-pill text-bg-info">
                                    {{ $order->status === 'new' ? 'Новый' : 'Выполнен' }}
                                </span>
                            </td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                                <span>
                                    <div class="flex justify-center space-x-2">
                                        <!-- Кнопка "Просмотр" -->
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm" title="Просмотр">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <!-- Кнопка "Редактировать" -->
                                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-warning btn-sm" title="Редактировать">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Кнопка "Удалить" -->
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
            <div>{{ $orders->links() }}</div>
        </div>
    </div>
@endsection
