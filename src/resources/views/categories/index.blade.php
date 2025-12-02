@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__content">
    <form action="/categories" method="POST" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" class="create-form__item-input" name="name" value="{{ old('name') }}">
        </div>
        <div class="create-form__button">
            <button type="submit" class="create-form__button-submit">作成</button>
        </div>
    </form>
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">category</th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <form action="/categories/{{ $category['id'] }}" method="POST" class="update-form">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input type="text" class="update-form__item-input" name="name" value="{{ $category['name'] }}">
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                        </div>
                        <div class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category-table__item">
                    <form action="/categories/{{ $category['id'] }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                        <div class="delete-form__button">
                            <button type="submit" class="delete-form__button-submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection