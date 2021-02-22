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
        td {
            border: 1px solid;
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="title">
        <table>
            <tr>
                <td></td>
                @foreach($categories as $category)
                    <td>{{ $category->name }}</td>
                @endforeach
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    @php
                        $categoryProduct = $product->categories;
                    @endphp
                    @foreach($categories as $category)
                        <td>{!! $categoryProduct->where('id', $category->id)->first() ? '&#10004;' : '&nbsp;' !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
