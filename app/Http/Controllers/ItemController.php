<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Item;

use App\Http\Requests\ItemRequest;
use App\Services\FileUploadService;

class ItemController extends Controller
{
    // 一部のアクションはログインを要求しない
    public function __construct()
    {
      $this->middleware(['auth', 'checkAdmin'])->only(['store', 'edit', 'update', 'destroy']);
    }
    
    // トップページ
    // 各カテゴリから3つの商品をランダムで取得し一覧で返す
    public function index()
    {
        $user = \Auth::user();
        
        if($user && $user->email === 'admin@admin.com'){
            return redirect()->route('dashboard');
        }
        
        $categories = Category::with(['item' => function($query){
            $query->whereNotIn('stock', [0])->inRandomOrder();
        }])->get();
        
        return view('items.index', [
            'categories' => $categories,
        ]);
    }
    
    // 商品詳細ページ
    public function show(Item $item)
    {
        return view('items.show', [
            'item'  => $item,
        ]);
    }
    
    // 検索ボックスで入力されたkeywordを商品名に含む商品を一覧で返す
    public function result(Request $request)
    {
        $keyword = $request->input('keyword');
        
        if(!empty($keyword)){
            $items = Item::where('name', 'LIKE', "%{$keyword}%")->latest()->paginate(9);
        }
        
        return view('items.result', [
            'title' => '検索結果',
            'items'  => $items,
        ]);
    }
    
    // カテゴリに含まれる商品を一覧で返す
    public function categorize($category)
    {
        $category_id = Category::where('name', '=', $category)->first()->id;
        $items = Item::where('category_id', '=', $category_id)->latest()->paginate(9);
        
        return view('items.result', [
            'title' => 'カテゴリー：' . $category,
            'items'  => $items,
        ]);
    }
    
    // below functions must be with admin permission
    
    // [管理者] 商品を追加する
    // 管理ダッシュボードがこのアクションを兼ねるよう変更された
    // public function create()
    // {
    //     $categories = Category::all();
    //     return view('items.create', [
    //       'title' => '商品を出品',
    //       'categories' => $categories,
    //     ]);
    // }

    // [管理者] 商品追加フォームから投稿された商品をテーブルに追加する
    public function store(ItemRequest $request, FileUploadService $service)
    {
        //画像投稿処理
        $filename = $service->saveImage($request->file('image'), 'images/items');

        $parameters = $request->only([
            'name',
            'description',
            'category_id',
            'price',
            'stock'
        ]);
        $parameters['image'] = $filename;

        Item::create($parameters);

        \Session::flash('success', '商品を追加しました');
        
        return redirect()->route('dashboard.item');
    }

    // [管理者] 商品情報を編集するページを返す
    public function edit(Item $item)
    {
        return view('items.edit', [
            'title' => '商品情報の編集',
            'item'  => $item,
            'categories' => Category::all(),
        ]);
    }
    
    // [管理者] 商品情報を更新する
    public function update(Item $item, ItemRequest $request, FileUploadService $service)
    {
        // 画像投稿処理
        $filename = $service->saveImage($request->file('image'), 'images/items');
    
        // 変更前の画像の削除
        if($item->image !== ''){
          \Storage::disk('public')->delete($item->image);
        }
        
        $parameters = $request->only([
            'name',
            'description',
            'category_id',
            'price',
            'stock'
        ]);
        $parameters['image'] = $filename;
        
        $item->update($parameters);
        
        \Session::flash('success', '商品情報を更新しました');
        
        return redirect()->route('dashboard.item');
    }

    // [管理者] 選択された商品をテーブルから削除する
    public function destroy(Item $item)
    {
        $item->delete();
        if($item->image !== ''){
          \Storage::disk('public')->delete($item->image);
        }
        return redirect()->route('dashboard.item');
    }
    
    // 商品情報の更新で同時に行うように変更された
    // public function editImage(Item $item)
    // {
    //     return view('items.edit_image', [
    //         'title' => '商品画像の変更',
    //         'item'  => $item,
    //     ]);
    // }
    
    // public function updateImage(Item $item, ItemImageUpdateRequest $request, FileUploadService $service)
    // {
    
    //     //画像投稿処理
    //     $filename = $service->saveImage($request->file('image'), 'photos');
    
    //     // 変更前の画像の削除
    //     if($item->image !== ''){
    //       \Storage::disk('public')->delete('photos/' . $item->image);
    //     }
    
    //     $item->update([
    //         'image' => $filename,
    //     ]);
    //     return redirect()->route('items.show', $item);
    // }
}