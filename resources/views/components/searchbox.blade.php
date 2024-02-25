<form class="search" method="get" action="{{ route('item.result') }}">
	<div class="input-group">
		<input class="form-control" type="text" name="keyword" placeholder="商品名の一部を入れて検索" required>
		<span class="input-group-append">
			<input class="btn btn-outline-secondary" type="submit" value="検索" >
		</span>
	</div>
</form>