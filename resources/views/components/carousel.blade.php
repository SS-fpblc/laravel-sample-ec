<div id="{{ 'carousel_' . $unique . $id }}" class="carousel slide" data-ride="carousel">
    <!-- スライドさせる画像の設定 -->
    <div class="carousel-inner">
        @foreach($array as $item)
            <div class="carousel-item {{ $item === $array->first() ? 'active' : '' }}">
                <a>
                    <div class="item-catalogue">
    				    @if($item->image !== '')
    	                    <img class="" src="{{ secure_asset('storage/' . $item->image) }}">
    	                @else
    	                    <img class="" src="{{ secure_asset('storage/images/common/no_image.jpg') }}">
    	                @endif
    	                <div>
    	                    <h3>{{ $item->name }}</h3>
    	                </div>
                    </div>
                </a>
            </div>
        @endforeach
    <!-- /.carousel -->
    </div>
    <!-- /.carousel-inner -->
    <!-- スライドコントロールの設定 -->
    <a class="carousel-control-prev" href="#{{ 'carousel_' . $unique . $id }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ 'carousel_' . $unique . $id }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>




<div class="cnt_random_display">
	@foreach($random_items_array as $array)
		<div class="cmp_carousel">
			@include('components.carousel', [
				'unique' => 'random_display',
				'id' => $array['category_id'],
				'array' => $array['random_items'],
		    ])
		</div>
	@endforeach
</div>