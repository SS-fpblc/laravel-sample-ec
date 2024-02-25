<header class="container">
    <ul class="navi row align-items-center p-2 gap-2">
        <li class="logo col-auto me-auto order-0 text-center">
            <a class="logo_small" href="{{ route('top') }}">CodeCamp Market</a>
        </li>
        <li class="col-12 col-lg order-3 order-lg-1">
            <form class="search" method="get" action="{{ route('item.result') }}">
            	<div class="input-group">
            		<input class="form-control" type="text" name="keyword" placeholder="商品名の一部を入れて検索" required>
            		<span class="input-group-append">
            			<input class="btn btn-outline-secondary" type="submit" value="検索" >
            		</span>
            	</div>
            </form>
        </li>
        @auth
            @if(Auth::user()->email !== 'admin@admin.com')
                <li class="col-auto order-2">
                    <a class="button btn_outline_red" href="{{ route('user.index') }}">マイページ</a>
                </li>
                <li class="col-auto basket order-2">
                    <a class="button btn_outline_red" href="{{ route('basket.index') }}"><img class="basket_icon" src="{{ secure_asset('storage/images/common/basket.png') }}" alt="バスケット"></a>
                </li>
            @endif
            <li class="col-auto order-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input class="button btn_red" type="submit" value="ログアウト">
                </form>
            </li>
        @endauth
        @guest
            <li class="col-auto order-2">
                <a class="button btn_red" href="{{ route('login') }}">ログイン</a>
            </li>
        @endguest
    </ul>
</header>