@extends('layouts.master')
@section('style')
    @parent
    <style>

    </style>
@endsection
@section('content')
<div class="content">
    <div class="title">Редактирование категории</div>
    <div class="error">
        {{ $error_message }}
    </div>
    <div class="title">
        <form method="POST" action="{{ route('category.update', $category->id) }}">
            @method('PATCH')
            {{ csrf_field() }}
            <label for="name">Наименование категории</label>
            <input type="text" id="name" name="name" value="{{ $category->name }}">
            <input type="submit" value="Сохранить">
        </form>
    </div>
</div>
@endsection
