@extends('layouts.master')
@section('style')
    @parent
    <style>

    </style>
@endsection
@section('content')
<div class="content">
    <div class="title">Создание категории</div>
    <div class="error">
        {{ $error_message }}
    </div>
    <div class="title">
        <form method="POST" action="{{ route('category.store') }}">
            {{ csrf_field() }}
            <label for="name">Наименование категории</label>
            <input type="text" id="name" name="name" required>
            <input type="submit" value="Создать">
        </form>
    </div>
</div>
@endsection
