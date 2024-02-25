@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>マイページ</h1>
        <div id="user_watchlist" class="section">
            <h2>あなたのウォッチリスト</h2>
            @include('components.display', [
				'items' => $watches,
			])
        </div>
        <div class="paginator pt-3">
            {{ $watches->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection