@extends('layouts.master')
@section('style')
    @parent
    <style>

    </style>
@endsection
@section('content')
<div class="content">
    <div class="title">Создание товара</div>
    <div class="error">
        {{ $error_message }}
    </div>
    <div class="title">
        <form method="POST" action="{{ route('product.store') }}">
            {{ csrf_field() }}
            <div>
                <label for="name">Наименование товара</label>
                <input type="text" id="name" name="name">
            </div>
            <div style="display: grid;">
                <label for="description">Краткое описание товара</label>
                <textarea name="description" max="255" maxlength="255" id="description" cols="30" rows="2" style="width: 50%;">
                </textarea>
            </div>
            <div>
                <label for="price">Цена</label>
                <input type="number" id="price" name="price">
            </div>
            @foreach($categoriesAll as $category)
                <div>
                    <input id="{{ $category->id }}"
                           name="category[]" type="checkbox" value="{{ $category->id }}">
                    <label for="category">{{ $category->name }}</label>
                </div>
            @endforeach
            <button type="submit">Создать</button>
        </form>
    </div>
</div>
@endsection
