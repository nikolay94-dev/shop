@extends('layouts.master')
@section('style')
    @parent
    <style>

    </style>
@endsection
@section('content')
<div class="content">
    <div class="title">Редактирование товара</div>
    <div class="error">
        {{ $error_message ?? '' }}
    </div>
    <div class="title">
        <form method="POST" action="{{ route('product.update', $product->id) }}">
            @method('PATCH')
            {{ csrf_field() }}
            <div>
                <label for="name">Наименование товара</label>
                <input type="text" id="name" name="name"
                       value="{{ $product->name }}">
            </div>
            <div style="display: grid;">
                <label for="name">Краткое описание товара</label>
                <textarea name="description" max="255" maxlength="255" id="description" cols="30" rows="2" style="width: 50%;">
                    {{ $product->description }}
                </textarea>
            </div>
            <div>
                <label for="name">Цена</label>
                <input type="text" id="price" name="price" value="{{ $product->price }}">
            </div>
            @foreach($categoriesAll as $category)
                <div>

                    <input id="{{ $category->id }}"
                           @if(in_array($category->id, $categories))
                                checked="checked"
                           @endif
                           name="category[]" type="checkbox" value="{{ $category->id }}">
                    <label for="category">{{ $category->name }}</label>
                </div>
            @endforeach
            <input type="submit" value="Сохранить">
        </form>
    </div>
</div>
@endsection
