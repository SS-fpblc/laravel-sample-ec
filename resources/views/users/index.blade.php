@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>マイページ</h1>
        <div id="user_orderhistory" class="section">
            <h2>あなたの購入履歴（最新3件）</h2>
            <div>
                @forelse($orders as $order)
                    <h3>注文ID：{{ $order->id }}</h3>
                    <table class="user-orderhistory m-3">
                        <thead>
                            <tr>
                                <th class="col-6">商品名</th>
                                <th class="col-2">単価</th>
                                <th class="col-2">個数</th>
                                <th class="col-2 text-end">小計</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($order->detail as $row)
                            <tr>
                                <td class="col-6">{{ $row->item->name }}</td>
                                <td class="col-2">{{ $row->item->price }}</td>
                                <td class="col-2">{{ $row->quantity }}</td>
                                <td class="col-2 text-end">￥ {{ $row->item->price * $row->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h4 class="text-end">合計金額： ￥ {{ $order->amount }}</h4>
                @empty
                    <p>購入履歴はありません。</p>
                @endforelse
            </div>
            <a href="{{ route('user.history') }}">全ての履歴</a>
        </div>
        <div id="user_watchlist" class="section">
            <h2>あなたのウォッチリスト（最新3件）</h2>
            @include('components.display', [
				'items' => $watches,
			])
			<a href="{{ route('user.watchlist') }}">全てのウォッチリスト</a>
        </div>
    </div>
@endsection
