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
        <div class="create-form__item">
            <input type="text" class="create-form__item-input" name="content" value="{{ old('content') }}">
            <select name="category_id" class="create-form__item-select">
                @foreach ($categories ?? [] as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] ?? '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button type="submit" class="create-form__button-submit">作成</button>
        </div>
    </form>
    <div class="section__title">
        <h2>Todo検索</h2>
    </div>
    <form action="/todos/search" method="get" class="search-form">
        @csrf
        <div class="search-form__item">
            <input type="text" name="keyword" class="search-form__item-input" value="{{ old('keyword') }}">
            <select name="category_id" class="search-form__item-select">
                @foreach ($categories ?? [] as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] ?? '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-form__button">
            <button type="submit" class="search-form__button-submit">検索</button>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">
                    <span class="todo-table__header-span">Todo</span>
                    <span class="todo-table__header-span">カテゴリ</span>
                </th>
            </tr>
            @foreach ($todos ?? [] as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__-tem">
                    <form action="/todos/update" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input type="text" class="update-form__item-input" name="content" value="{{ $todo['content'] }}">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form__item">
                            <p class="update-form__item-p">{{ $todo['category']['name'] ?? '' }}</p>
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="/todos/delete" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection