@extends('layouts.logged_in')

@section('content')
	<div class="container contents">
		<div class="row">
			<div class="col-3">
				<h2>メニュー</h2>
				<p>ここに各種メニューを追加してください。</p>
			</div>
			<div class="col-9">
			  @forelse($items as $item)
				  <div class="card item">
					<div class="row item_row">
						<div class="col-6 item_figure">
						    @if($item->image !== '')
			                    <img class="img-fluid" src="{{ secure_asset('storage/' . $item->image) }}">
			                @else
			                    <img src="{{ secure_asset('images/no_image.png') }}">
			                @endif
						</div>
						<div class="col-6 item_description">
							<h2 class="item_title">
								<a href="{{ route('items.show', $item) }}">
									{{ $item->name }}:
								</a>
							</h2>
							@if($item->stock > 0)
								<div>{{ $item->price }}円</div>
							@else
								<div>売り切れ</div>
							@endif
							<div>{{ $item->description }}</div>
						</div>
					</div>
				</div>
				@empty
					<p>出品商品はありません。</p>
				@endforelse
			</div>
		</div>
	</div>
	
	<footer class="text-center">
		<p><small>&copy;CodeCamp All Rights Reserved.</small></p>
	</footer>
@endsection
