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

        table {
            width: 100%;
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="title" style="margin-bottom: 10px;">
        <a href="{{ route('product.create') }}">Создать товар</a>
    </div>
    <div class="error">
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="title">
        <table>
            <thead>
                <tr>
                    <td style="width: 43%;">Название товара</td>
                    <td>Цена</td>
                    <td>Категории</td>
                </tr>
            </thead>
        @foreach($products as $product)
            <tr>
                <td class="field">
                    {{ $product['product_name'] }}
                </td>
                <td class="field">
                    {{ $product['product_price'] }}
                </td>
                <td class="field">
                    {{ $product['categories'] }}
                </td>
                <td class="field">
                    <form action="{{ route('product.edit', $product['product_id'] ) }}">
                        <button type="submit">Редактировать</button>
                    </form>
                    <form method="POST" action="{{ route('product.delete', $product['product_id'] ) }}">
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
