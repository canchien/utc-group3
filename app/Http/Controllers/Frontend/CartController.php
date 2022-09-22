<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderStatuses;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function index()
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart, 1);
            $products = $cart->items;
            return view('frontend.carts.index', compact('session', 'products'));
        } else {
            return view('frontend.carts.empty', compact('session'));
        }
    }

    public function getAddToCart()
    {
        $updated = false;
        $product = Product::find(request()->id);
        (int) $qty = request()->qty ?? '1';
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart, $qty);
        $cart->add($product, $product->id);
        if (!request()->qty && $cart->items[$product->id]['qty'] > $product->qty) {
            $updated = true;
            $cart->minusQty($product->id);
        }
        request()->session()->put('cart', $cart);
        return response()->json([
            'updated' => $updated,
            'staus' => 'success',
        ]);
    }

    public function minusA_Product()
    {
        $product = Product::find(request()->id);
        if ($product) {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart, 1);
            $cart->minusQty($product->id);
            request()->session()->put('cart', $cart);
            $cart = Session::get('cart');
            if ($cart->totalQty == 0) {
                request()->session()->flush();
                return response()->json([
                    'cart' => 'empty',
                ]);
            }
            if (!array_key_exists($product->id, $cart->items)) {
                return response()->json([
                    'is_delete_product' => true,
                    'product_id' => $product->id
                ]);
            }
            return response()->json([
                'status' => 'success',
            ]);
        }
    }

    public function getRemoveFromCart()
    {
        if (request()->session()->has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart, 1);
            $cart->remove(request('id'));
            request()->session()->put('cart', $cart);
            $cart = Session::get('cart');
            if ($cart->totalQty == 0) {
                request()->session()->flush();
                return response()->json([
                    'cart' => 'empty',
                ]);
            } else {
                return response()->json([
                    'cart' => $cart,
                ]);
            }
        }
    }

    public function getTotalQty()
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        $cartQty = 0;
        if ($session) {
            $cartQty = $session->totalQty;
        }
        return response()->json([
            'totalQty' => $cartQty,
        ]);
    }

    public function checkouted($orderCode)
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        if (Session::has('cart')) {
            return view('frontend.carts.showCheckout', compact('session', 'orderCode'));
        } else {
            return view('frontend.carts.showCheckout', compact('session', 'orderCode'));
        }
    }

    public function orderStatus()
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        $order = Order::where('order_code', request()->order_code)->first();
        return view('frontend.carts.track', compact('session', 'order'));
    }

    public function showCheckout()
    {

        $session = Session::has('cart') ? Session::get('cart') : null;
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart, 1);
            $products = $cart;
            return view('frontend.carts.showCheckout', compact('session', 'products'));
        } else {
            return view('frontend.carts.empty', compact('session'));
        }
    }

    public function doCheckout()
    {
        $data = request()->validate(
            [
                'cusName' => ['required', 'string', 'max:255'],
                'cusEmail' => ['required', 'email', 'max:255', 'regex:/^[a-z][a-z0-9_\.]{2,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/i'],
                'cusPhone' => ['required', 'regex:/((\+84|84|0)[9|3])+([0-9]{8})\b/i'],
                'cusAddress' => ['required', 'string', 'max:255', 'min:16'],
                'description' => '',
            ],
            [
                'cusEmail.regex' => 'hãy nhập đúng dạng email : bắt đầu bằng chữ cái độ dài 3 ký tự trước @',
                'cusPhone.regex' => 'hãy nhập đúng sđt: bắt đầu bằng 0, 84, +84 và có độ dài 10 số riêng vớ 84 thì 11'
            ]
        );
        $orderCode = ['order_code' => Str::random(10),];
        $data = array_merge($data, $orderCode);
        if (request()->session()->has('cart')) {
            $order = Order::create([
                'order_code' => $data['order_code'],
                'customerName' => $data['cusName'],
                'customerEmail' => $data['cusEmail'],
                'customerPhone' => $data['cusPhone'],
                'customerAddress' => $data['cusAddress'],
                'description' => $data['description'],
            ]);
            $order->orderStatuses()->create([
                'status' => 'Tiếp nhận thông tin đơn hàng',
            ]);
            $oldCart = Session::get('cart');
            $carts = new Cart($oldCart, 1);
            //$carts = $carts->items;
            foreach ($carts->items as $cart) {
                $order->products()->attach($cart['item']->id, [
                    'productName' => $cart['item']->name,
                    'productImage' => $cart['item']->getImage(),
                    'productQty' => $cart['qty'],
                    'productPrice' => $cart['item']->price,
                    'ProductAmount' => $cart['price'],
                ]);
            }
            try {
                Mail::to($order->customerEmail, $order->customerName)
                ->send(new OrderMail($order, $data['order_code']));
            } catch (\Exception $e) {
                
            }
            return redirect()->route('cart.checkouted', ['orderCode' => $data['order_code']]);
        }
    }

    public function huyDonHang($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        if ($order->status != 0) {
            abort(404);
        } else {
            $order->status = -1;
            $order->orderStatuses()->create(['status' => 'Người dùng huỷ đơn hàng']);
            $order->save();
            return back();
        }
    }

    public function showOrderSearch()
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        return view('frontend.carts.showOrderSearch', compact('session'));
    }
}
