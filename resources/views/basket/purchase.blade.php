<ul class="container basket_row">
    @foreach($basket_items_detail as $row)
        <li class="row align-items-center border-bottom border-red">
            <h3 class="col-1 fnt_bold fnt_tall">{{ $loop->iteration }}</h3>
            <div class="col-3">
                @if($row["item"]->image !== '')
                    <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/' . $row["item"]->image) }}">
                @else
                    <img class="w-100 p-3 object-fit-scale" src="{{ secure_asset('storage/images/common/no_image.jpg') }}">
                @endif
            </div>
            <div class="col">
                <p class="text-start">{{ $row["item"]->name }}</p>
            </div>
            <div class="col-3 text-end">
                <p class="fnt_bold fnt_mid">￥{{ $row["item"]->price }}</p>
                <p class="fnt_mid"><span class="fnt_min">個数： x </span><span class="fnt_bold">{{ $row["quantity"] }}</span></p>
                <p class="fnt_mid"><span class="fnt_min">小計： </span><span class="fnt_bold">￥ {{ $row["subtotal"] }}</span></p>
            </div>
        </li>
    @endforeach
</ul>
<div class="text-center mt-5 mx-auto mb-3">
    <p class="fnt_bold fnt_tall">合計： ￥{{ $total }}</p>
    <form method="post" action="{{ route('basket.settle') }}">
        @csrf
        <input type="hidden" name="amount" value="{{ $total }}">
        <button type="submit" class="button btn_outline_red mt-4">注文を確定し、精算する</button>
    </form>
    <button type="button" class="button btn_green mt-4" data-bs-dismiss="modal">お買い物に戻る</button>
</div>