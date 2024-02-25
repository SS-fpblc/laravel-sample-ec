@extends('layouts.kernel')

@section('content')
    <div class="container">
        <h1>管理ダッシュボード</h1>
        
        @include('components.tab', [
            'manage_item' => 'active',
            'manage_user' => '',
        ])
        
        <div id="item_create_modal" class="section">
            <h2>商品を登録する</h2>
            @include('components.modal', [
                'modal_unique' => 'dashboard',
                'button_class' => 'btn_green',
                'button_txt' => '登録フォームを開く',
                'modal_title' => '商品追加フォーム',
                'modal_body' => 'items.create',
                'modal_body_arg' => ['categoies' => $categories,],
            ])
        </div>
        
        <div id="item_table" class="section">
            <h2>カテゴリーごとの商品一覧</h2>
            <div class="accordion" id="item_accordion">
                @forelse($categories as $category)
                    <div class="card item-{{ $category->name }}-table">
                        <div class="card-header" id="item-{{ $category->name }}-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#item-{{ $category->name }}-collapse" aria-expanded="true" aria-controls="item-{{ $category->name }}-collapse">
                                    カテゴリー：{{ $category->name }}
                                </button>
                            </h5>
                        </div>
                        <div id="item-{{ $category->name }}-collapse" class="collapse" aria-labelledby="item-{{ $category->name }}-header" data-bs-parent="#item_accordion">
                            <div class="card-body">
            					<table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-1 text-center" scope="col">商品ID</th>
                                            <th class="col-2 text-center" scope="col">商品画像</th>
                                            <th class="" scope="col">
                                                商品名称<br>
                                                商品詳細
                                            </th>
                                            <th class="col-1 text-center" scope="col">商品価格</th>
                                            <th class="col-1 text-center" scope="col">在庫数</th>
                                            <th class="col-2 text-center" scope="col">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($category->item as $item)
                                            <tr>
                                                <th class="text-center" scope="row">{{ $item->id }}</th>
                                                <td class="text-center">
                                                    @if($item->image !== '')
                            		                    <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/' . $item->image) }}">
                            		                @else
                            		                    <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/images/common/no_image.jpg') }}">
                            		                @endif
                                                </td>
                                                <td>
                                                    <h4 class="item-name">{{ $item->name }}</h4>
                                                    <p>{{ $item->description }}</p>
                                                </td>
                                                <td class="text-center">{{ $item->price }}</td>
                                                <td class="text-center">{{ $item->stock }}</td>
                                                <td class="text-center v-center">
                                                    <a class="w-75 button btn_green" href="{{ route('item.edit', $item) }}">編集</a>
                                    				<form method="POST" action="{{ route('item.destroy', $item) }}">
                                    					@csrf
                                            			@method('delete')
                                                        <input class="w-75 button btn_outline_red delete" type="submit" value="削除">
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>登録商品はありません。</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection