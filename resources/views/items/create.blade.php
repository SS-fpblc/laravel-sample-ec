<form
    class=""
    method="POST"
    action="{{ route('item.store') }}"
    enctype="multipart/form-data"
>
    @csrf
    <div>
        <label for="name" class="col-12 form-label">商品名:</label>
        <input id="id" class="col-12 form-control" type="text" name="name">
    </div>
    <div>
        <label for="description" class="col-12 form-label">商品説明:</label>
        <textarea id="description" class="col-12 form-control" name="description" rows="5"></textarea>
    </div>
    <div class="row">
        <div class="col">
            <label for="price" class="col-12 form-label">価格:</label>
            <input id="price" class="col-12 text-end form-control" type="number" name="price">
        </div>
        <div class="col">
            <label for="stock" class="col-12 form-label">在庫数:</label>
            <input id="stock" class="col-12 text-end form-control" type="number" name="stock">
        </div>
        <div class="col">
            <label class="col-12 form-label">カテゴリー:</label>
            <select class="col-12 form-select" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label for="image" class="col-12 form-label">画像を選択:</label>
        <input id="image" class="form-control" type="file" name="image">
    </div>
    <div class="modal-footer">
        <button class="button btn_gray" type="button" data-bs-dismiss="modal">閉じる</button>
        <button class="button btn_green" type="submit">登録</button>
    </div>
</form>