@extends('layouts.default')

@section('content')
	<div class="container">
		<div id="item_category_menu" class="container section">
			<h2>カテゴリー</h2>
			<ul class="row">
				@foreach($categories as $category)
					<li class="col"><a class="text-center w-100 button btn_outline_red fnt_bold fnt_tall" href="{{ route('item.category', $category->name) }}">{{ $category->name }}</a></li>
				@endforeach
			</ul>
		</div>
		<div id="item_random_display" class="container section">
			<h2>Pick Up !</h2>
			@forelse($categories as $category)
				<div>
					<h3>from {{ $category->name }}:</h3>
					@include('components.display', [
						'items' => $category->item->take(3),
					])
				</div>
			@empty
			@endforelse
		</div>
	</div>
@endsection
