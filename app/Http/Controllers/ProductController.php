<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class ProductController extends Controller
{
    public function index() {
        $data = Product::all() ;
        return view('product', ['products'=> $data]);
    }

    public function detail($id) {
        $data = Product::find($id);
        return view('detail', ['product' => $data]);
    }

    public function addToCart(Request $request) {
        if($request->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->product_id = $request->product_id;
            $cart->save();
            return back();
        }
        else {
            return redirect()->route('login');
        }
        
    }

    static public function cartItem() {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }

    public function cartList(){
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')
        ->join('products', 'cart.product_id', '=' , 'products.id')
        ->where('cart.user_id', $userId)
        ->select('products.*', 'cart.id as cart_id')
        ->get();

        return view('cartlist', [
            'products' => $products
        ]);
    }

    public function removeFromCart($id) {
        Cart::destroy($id);
        return back();
    }

    public function orderNow() {
        $userId = Session::get('user')['id'];
        $total = $products = DB::table('cart')
        ->join('products', 'cart.product_id', '=' , 'products.id')
        ->where('cart.user_id', $userId)
        ->sum('products.price');

        return view('ordernow', [
            'total' => $total
        ]);
    }

    public function orderPlace(Request $request) {
        $userId = Session::get('user')['id'];
        $allCart = Cart::where('user_id', $userId)->get();
        foreach($allCart as $cart) {
           $order = new Order; 
           $order->product_id = $cart['product_id'];
           $order->user_id = $cart['user_id'];
           $order->status = "pending";
           $order->payment_method = $request->payment;
           $order->payment_status = "pending";
           $order->address = $request->address;
           $order->save();
           Cart::where('user_id', $userId)->delete();
        }
        $request->input();
        return redirect()->route('home');
    }

    public function myOrders() {
        $userId = Session::get('user')['id'];
        $orders = DB::table('orders')
        ->join('products', 'orders.product_id', '=' , 'products.id')
        ->where('orders.user_id', $userId)
        ->get();


        return view('myorders', [
            'orders' => $orders
        ]);
    }
}
