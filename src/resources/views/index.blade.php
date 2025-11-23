@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__content">
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <form action="/todos" class="create-form" method="post">
        @csrf
        <div class="create-form">
            <input type="text" class="create-form__item-input" name="content" value="{{ old('content') }}">
            <select name="category_id" class="create-form__item-select">
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name']}}</option>
                @endforeach
            </select>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">作成</button>
            </div>
        </div>
    </form>
    <div class="section__title">
        <h2>Todo検索</h2>
    </div>
    <form action="/todos/search" method="get" class="search-form">
        @csrf
        <div class="search-form__input">
            <input type="text" name="keyword" class="search-form__item-input" value="{{ old('keyword') }}">
            <select name="category_id" class="search-form__item-select">
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="search-form__button">
            <button type="submit" class="search-form__button-submit">検索</button>
        </div>
    </form>
    <table class="todo-table">
        <div class="todo-table__inner">

        </div>
    </table>
</div>
@endsectiona