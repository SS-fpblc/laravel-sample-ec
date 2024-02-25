@extends('layouts.default')

@section('content')
	<div class="container">
		<div id="item_categorized_display" class="container section">
			<h1>{{ $title }}</h1>
			@include('components.display', [
				'items' => $items,
			])
			<div class="paginator pt-3">
				{{ $items->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
@endsection