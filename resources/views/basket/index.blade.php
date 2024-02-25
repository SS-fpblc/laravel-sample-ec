@extends('layouts.default')

@section('content')
    <div class="container">
        <div id="user_basketlist" class="section">
            <h2>現在のバスケット</h2>
            <ul class="container basket_row">
                @forelse($basket_items_detail as $row)
                    <li class="row align-items-center border-bottom border-red {{ $row['quantity'] - $row["item"]->stock > 0 ? 'oos' : '' }}">
                        @if($row['quantity'] - $row["item"]->stock > 0)
                            <h3 class="col-1 fnt_bold fnt_tall fnt_red"> ! </h3>
                        @else
                            <h3 class="col-1 fnt_bold fnt_tall">{{ $loop->iteration }}</h3>
                        @endif
                        <div class="col-3">
                            @if($row["item"]->image !== '')
                                <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/' . $row["item"]->image) }}">
                            @else
                                <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/images/common/no_image.jpg') }}">
                            @endif
                        </div>
                        <div class="col">
                            <p class="text-start">{{ $row["item"]->name }}</p>
                        </div>
                        <div class="col-2 text-end">
                            @if($row['quantity'] - $row["item"]->stock > 0)
                                <p class="fnt_bold fnt_tall fnt_red">Out of Stock</p>
                            @else
                                <p class="fnt_bold fnt_mid">￥{{ $row["item"]->price }}</p>
                                <p class="fnt_mid"><span class="fnt_min">個数： x </span><span class="fnt_bold">{{ $row['quantity'] }}</span></p>
                                <p class="fnt_mid"><span class="fnt_min">小計： </span><span class="fnt_bold">￥ {{ $row['subtotal'] }}</span></p>
                            @endif
                        </div>
                        <div class="col-1">
                            <form class="bl_remove" method="POST" action="{{ route('basket.remove', $loop->index) }}">
                                @csrf
                                @method('delete')
                                <button class="button btn_outline_red" type="submit">削除</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <p>バスケットは空です。</p>
                @endforelse
            </ul>
            @if($basket_items_detail && !$has_shortage)
                <div id="basket_settle_modal" class="section basket-settle w-50 mx-auto">
                    <p class="text-center fnt_bold fnt_tall d-block w-75 mx-auto pb-2 border-bottom border-2 border-red">合計： ￥{{ $total }}</p>
                    <div class="text-center w-75 mx-auto">
                        @include('components.modal', [
                            'modal_unique' => 'basket',
                            'button_class' => 'btn_red',
                            'button_txt' => 'ご購入手続へ',
                            'modal_title' => 'ご購入手続',
                            'modal_body' => 'basket.purchase',
                            'modal_body_arg' => ['basket_items_detail' => $basket_items_detail, 'total' => $total,],
                        ])
                    </div>
                </div>
            @elseif($has_shortage)
                <p class="error fnt_bold fnt_mid text-center">在庫が不足している商品がバスケットにありました。<br>一度、該当の商品をバスケットから削除して改めてバスケットに追加してみてください。</p>
            @endif
        </div>
    </div>
@endsection