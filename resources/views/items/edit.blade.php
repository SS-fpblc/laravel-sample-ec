@extends('layouts.default')

@section('content')
<div id="item_edit" class="container">
    <form method="POST" action="{{ route('item.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <h2>{{ $title }}</h2>
        <div>
            <label for="name" class="col-12 form-label">商品名:</label>
            <input id="name" class="col-12 form-control" name="name" type="text" value="{{ $item->name }}">
        </div>
        <div>
            <label for="description" class="col-12 form-label">商品説明:</label>
            <textarea id="description" class="col-12 form-control" name="description" rows="5">{{ $item->description }}</textarea>
        </div>
        <div class="row">
            <div class="col">
                <label for="price" class="col-12 form-label">価格:</label>
                <input id="price" class="col-12 text-end form-control" type="number" name="price" value="{{ $item->price }}">
            </div>
            <div class="col">
                <label for="stock" class="col-12 form-label">在庫数:</label>
                <input id="stock" class="col-12 text-end form-control" type="number" name="stock" value="{{ $item->stock }}">
            </div>
            <div class="col">
                <label class="col-12 form-label">カテゴリー:</label>
                <select class="col-12 form-select" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if($category->id === $item->category_id)
                                    selected
                                @endif
                                >{{ $category->name }}
                            </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="iamge" class="col-12 form-label">画像を選択:</label>
            <input id="image" class="form-control" type="file" name="image">
        </div>
        <div class="text-end pt-3">
            <button class="button btn_green" type="submit">更新</button>
        </div>
    </form>
    <div class="text-end mt-3">
        <a href="{{ route('dashboard.item') }}">
            <button class="button btn_gray">ダッシュボードに戻る</button>
        </a>
    </div>
</div>
@endsection
