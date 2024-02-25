@extends('layouts.default')

@section('content')
    <div class="container">
        <div id="item_detail" class="section">
            <div class="w-100">
                <h5 class="">{{ $item->category->name }}</h5>
                <h2 class="border-bottom border-red p-2">{{ $item->name }}</h2>
            </div>
            <div class="mt-4 row">
                <div class="text-center col-3">
                    @if($item->image !== '')
                        <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/' . $item->image) }}">
                    @else
                        <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/images/common/no_image.jpg') }}">
                    @endif
                    @if(\Auth::check())
                        <div>
                            <a class="tobbleWatch">
                                @if($item->isWatchedBy(\Auth::user()->id))
                                    <button class="button btn_blue fnt_min">ウォッチリストから削除する</button>
                                @else
                                    <button class="button btn_outline_blue fnt_min">ウォッチリストに追加する</button>
                                @endif
                            </a>
                            <form class="" method="post" action="{{ route('user.tobbleWatch', $item) }}">
                                @csrf
                                @method('patch')
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col">
                    <div class="pre_wrap">
                        <p>{{ $item->description }}</p>
                    </div>
                    <div class="text-end">
                        <h3>{{ $item->price }}円</h3>
                        @if(!$item->stock > 0)
                            <h4 class="text-end fnt_red">Sorry, Out of Stock.</h4>
                        @else
                            <h5 class="fnt_min">
                                在庫状況：
                                @if( $item->stock > 10 )
                                    <span>有り</span>
                                @elseif( $item->stock == 0 )
                                    <span class="fnt_red">売り切れ</span>
                                @else
                                    <span class="fnt_red">残り僅か</span>
                                @endif
                            </h5>
                            <form method="POST" action="{{ route('basket.add', $item) }}">
                                @csrf
                                @method('patch')
                                個数：<input type="number" name="form_quantity" value="1" min="1" max="99" required><br>
                                <button class="mt-4 button btn_red" type="submit">バスケットに追加する</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection