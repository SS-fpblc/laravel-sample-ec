<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Watch;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = \Auth::user();
        $orders = $user->order()->latest()->limit(3)->get();
        $watches = $user->watchingItems()->orderBy('pivot_updated_at', 'desc')->limit(3)->get();
        
        return view('users.index', [
            'orders' => $orders,
            'watches' => $watches,
        ]);
    }
    
    public function history(){
        $user = \Auth::user();
        $orders = $user->order()->latest()->paginate(5);
        
        return view('users.history', [
            'orders' => $orders,
        ]);
    }
    
    public function watchlist(){
        $user = \Auth::user();
        $watches = $user->watchingItems()->orderBy('pivot_updated_at', 'desc')->paginate(9);
        
        return view('users.watch', [
            'watches' => $watches,
        ]);
    }
    
    public function toggleWatch(Item $item)
    {
        $user_id = \Auth::user()->id;
        $item_id = $item->id;
        
        if($item->isWatchedBy($user_id)){
            $item->watch->where('user_id', $user_id)->first()->delete();
            \Session::flash('success', '商品をウォッチリストから削除しました');
        }else{
            Watch::create([
                'user_id' => $user_id,
                'item_id' => $item_id,
            ]);
            \Session::flash('success', '商品をウォッチリストに追加しました');
        }
        
        return redirect()->route('item.show', $item);
    }
}

