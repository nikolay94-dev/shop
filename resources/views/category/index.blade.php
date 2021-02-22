@extends('layouts.master')
@section('style')
    @parent
    <style>
        .flex-block {
            display: flex;
        }

        .field {
            width: 15%;
        }
        .title {
            font-size: 17px !important;
        }
        .centered-text {
            text-align: center;
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="title" style="margin-bottom: 10px;">
        <a href="{{ route('category.create') }}">Создать категорию</a>
    </div>
    <div class="error">
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
       {{-- {{ $error_message ?? null }}--}}
    </div>
    <div class="title">
        <table>
            <thead>
                <tr>
                    <td>Название категории</td>
                    <td>Количество товаров данной категории</td>
                    <td>Минимальная цена в категории</td>
                    <td>Максимальная цена в категории</td>
                </tr>
            </thead>
        @foreach($categories as $category)
            <tr>
                <td class="field">
                    <a href="{{ route('category.edit', $category['category_id'] ) }}">
                        {{ $category['category_name'] }}
                    </a>
                </td>
                <td class="field centered-text">
                    {{ $category['product_count'] }}
                </td>
                <td class="field centered-text">
                    {{ $category['min_price_product'] }}
                </td>
                <td class="field centered-text">
                    {{ $category['max_price_product'] }}
                </td>
                <td class="field">
                    <form action="{{ route('category.edit', $category['category_id'] ) }}">
                        <button type="submit">Редактировать</button>
                    </form>
                    <form method="POST" action="{{ route('category.delete', $category['category_id'] ) }}">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>
    </div>
</div>
@endsection
