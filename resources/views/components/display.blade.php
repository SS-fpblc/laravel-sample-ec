<ul class="mx-auto justify-content-start g-3 row">
	@forelse($items as $item)
		<li class="col-4">
			<a href="{{ route('item.show', $item) }}">
				<div class="border">
					<div class="px-3">
					    @if($item->image !== '')
		                    <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/' . $item->image) }}">
		                @else
		                    <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/images/common/no_image.jpg') }}">
		                @endif
					</div>
					<div class="p-3 border-top border-red">
						<h4 class="fnt_black">{{ $item->name }}</h4>
						@if(!$item->stock > 0)
							<h4 class="text-end fnt_red">Sorry, Out of Stock.</h4>
						@else
							<h5 class="text-end fnt_black">{{ $item->price }}円</h5>
						@endif
					</div>
				</div>
			</a>
		</li>
	@empty
		<p>見つかりませんでした。</p>
	@endforelse
</ul>