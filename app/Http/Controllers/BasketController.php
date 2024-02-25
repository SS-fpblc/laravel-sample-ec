<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Exception;

class BasketController extends Controller
{
    // ログイン状態のみ
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // バスケットの内容を一覧で表示する
    public function index(Request $request)
    {
        $basket = \Session::get('basket');
        $basket_items_detail = array();
        $total = 0;
        $has_shortage = false;
        
        if($basket){
            $items = Item::find(array_column($basket, 'item_id'));
            
            foreach($basket as $index => $row){
                $item = $items->find($row['item_id']);
                $quantity = $row['quantity'];
                $subtotal = $item->price * $quantity;
                if($quantity - $item->stock > 0 && !$has_shortage){
                    $has_shortage = true;
                }
                array_push($basket_items_detail, [
                    'item' => $item,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }
        }
        
        return view('basket.index', [
            'basket_items_detail' => $basket_items_detail,
            'total' => $total,
            'has_shortage' => $has_shortage,
        ]);
    }
    
    // バスケットに商品を追加する
    public function add(Request $request, Item $item)
    {
        $item_id = $item->id;
        $quantity = $request->form_quantity;
        
        if($quantity - $item->stock > 0){
            \Session::flash('error', '在庫がないか、注文数を下回っています。');
        }else{
            \Session::get('basket') ? $basket = \Session::get('basket') : $basket = array();
            $col_basket = collect($basket);
            
            if($col_basket->firstWhere('item_id', $item_id)){
                $pk = (int)$col_basket->firstWhere('item_id', $item_id)['pk'];
                $quantity = (int)$col_basket->firstWhere('item_id', $item_id)['quantity'] + $quantity;
                
                array_splice($basket, $pk, 1);
            }else{
                $basket ? $pk = count($basket) : $pk = 0;
            }
            
            $add_item = [
                'pk' => $pk,
                'item_id' => $item_id,
                'quantity' => $quantity,
            ];
            array_push($basket, $add_item);
            array_multisort(array_column($basket, 'pk'), $basket);
            
            \Session::put('basket', $basket);
            
            \Session::flash('success', '商品をバスケットに追加しました。');
        }
        
        return redirect()->back();
    }
    
    // バスケットから商品を取り除く
    public function remove(Request $request, $id)
    {
        $basket = \Session::get('basket');
        
        array_splice($basket, $id, 1);
        
        if(empty($basket)){
            \Session::forget('basket');
        }else{
            \Session::put('basket', $basket);
        }
        
        \Session::flash('success', '商品をバスケットから削除しました。');
        
        return redirect()->back();
    }
    
    // バスケットの内容で確定し、精算する
    public function settle(Request $request)
    {
        $user_id = \Auth::user()->id;
        $basket = \Session::get('basket');
        $amount = $request->amount;
        $items = Item::find(array_column($basket, 'item_id'));
        
        if($basket){
            try{
                $order = DB::transaction(function() use($user_id, $basket, $amount, $items){
                    $order = Order::create([
                        'user_id' => $user_id,
                        'amount' => $amount,
                    ]);
                    
                    foreach($items as $item){
                        $current_stock = $item->stock;
                        $ordered_quantity = collect($basket)->firstWhere('item_id', $item->id)['quantity'];
                        $calc_stock = $current_stock - $ordered_quantity;
                        if($calc_stock < 0){
                            throw new \Exception();
                        }
                        $item->update(['stock' => $calc_stock]);
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'item_id' => $item->id,
                            'quantity' => $ordered_quantity,
                        ]);
                        if($item->isWatchedBy($user_id)){
                            $item->watch->firstWhere('user_id', $user_id)->delete();
                        }
                    }
                    
                    return $order->id;
                });
                
                \Session::forget('basket');
                
                return redirect()->route('basket.complete', $order);
                
            }catch(\Exception $e){
                return redirect()->back();
            }
        }
    }
    
    public function complete(Request $request, Order $order)
    {
        return view('basket.complete', [
            'order' => $order,
        ]);
    }
}
