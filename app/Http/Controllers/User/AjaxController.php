<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        // logger($request->status);
        Log::info("message");
        if($request->status=='desc'){
            $pizza=Product::orderBy('created_at','desc')->get();
        }else{
            $pizza=Product::orderBy('created_at','asc')->get();
        }
        return response()->json($pizza,200);
    }

    //return pizza list
    public function addToCart(Request $request){
        $data=$this->getOrderData($request);
        Cart::create($data);
        $response=[
            'message'=>'Add to Cart Completed',
            'status'=>'success'
        ];
        return response()->json($response,200);
    }

    //order
    public function order(Request $request){
        $total=0;
        foreach($request->all() as $item){ //orderList = [item,item,item]
            $data=OrderList::create([
                'user_id'=>$item['user_id'],
                'product_id'=>$item['product_id'],
                'qty'=>$item['qty'],
                'total'=>$item['total'],
                'order_code'=>$item['order_code']
            ]);
            $total+=$data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$total+3000
        ]);
        return response()->json([
            'status'=>'true',
            'message'=>'order completed'
        ],200);
    }
    //get order data
    private function getOrderData($request){
        return[
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('id',$request->orderId)
        ->where('product_id',$request->productId)->delete();
    }

    //increase pizza viewcount
    public function increaseViewCount(Request $request){
        // Log::info($request->all());
        $pizza=Product::where('id',$request->productId)->first();
        $viewCount=[
            'view_count'=>$pizza->view_count + 1
        ];
        Product::where('id',$request->productId)->update($viewCount);
    }
}
