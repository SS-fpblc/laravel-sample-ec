@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>ご購入手続が完了しました。</h1>
        <p>ご購入ありがとうございました。</p>
        <div id="purchase-complete" class="section">
            <h2>お買い物の内容</h2>
            <div>
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
            </div>
        </div>
    </div>
@endsection
