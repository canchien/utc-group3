<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')
            ->get()
            ->take(18);
        // $chunkProducts = $products
        //     ->chunk(2);
        // foreach ($products as $product) {
        //     dd($product->productimages()->where('status', 1)->orderBy('created_at', 'desc')->take(1)->get());
        // }
        // dd('srop');
        // dd($products);
        $session = Session::has('cart') ? Session::get('cart') : null;


        // $topSale = Product::all();
        // foreach ($topSale as $product) {
        //     if ($product->orders->isEmpty()) {
        //         echo 'empty<br>';
        //     } else {
        //         dd($product->orders()->count());
        //     }
        // }


        // lấy ra các sản phẩm bán chạy nhất:
        // lấy danh sách id các order đã giao:
        $listOrder = DB::table('orders')->select('id')->where('status',3)->get()->toArray();
        // $listIdOrder = json_decode(json_encode($listOrder), True);
        
        // lấy id các order có sattus đã giao ( Chuyển về dạng mảng 1 chiều ):
        $listIdOrder = array();              
        foreach($listOrder as $key =>$value){
            $listIdOrder[] = $listOrder[$key]->id;
        }
        // dd($listIdOrder);
        foreach($listIdOrder as $k => $v){
            $product_order[] = json_decode(json_encode(DB::table('order_product')->select('product_id','productQty')->where('order_id',$v)->get()->toArray()), True);

        }
        
        // dd($product_order);

        // lấy danh sách sản phẩm đã được giao thành công và số lượng ( Tính trên tổng các đơn hàng)
        $listProductQty=array();
        foreach($product_order as $k => $v){
            foreach($v as $value){
                // dd($value['product_id']);
                if(!key_exists($value['product_id'],$listProductQty)){
                    $listProductQty[$value['product_id']] = (int)$value['productQty'];

                }else{
                    $listProductQty[$value['product_id']] += (int)$value['productQty'];
                }
            }
            
        }
        // echo "<pre>";
        //     print_r($product_order);
        // echo "</pre>";
        // echo "<pre>";
        //     print_r($listProductQty);
        // echo "</pre>";

        //sắp xếp theo thứ tự giảm dần 
        arsort($listProductQty);
        // dd($listProductQty);
        
        // lấy ra top 3 sản phẩm trend:
        // dd(array_chunk($listProductQty, 3));
        $listTopSale = array_chunk($listProductQty, 3,true)[0];
        // dd($listTopSale);
        
        // lấy ra 3 sản phẩm bán chạy nhất
        $listSaleTop = array(); // hảm lấy các id của listTopSale (Id product)
        $topSale = array();
        foreach($listTopSale as $id => $qty){
            $listSaleTop[] = $id;
            // $topSale []=
            // $topSale[] = json_decode(json_encode( DB::table('products')->where('id', $id)->get()->toArray()), True);
            
        }
        // $topSale = Product::all();
        $topSale = Product::WhereIn('id', $listSaleTop)->get();
        // $topSale = DB::table('products')->whereIn('id', $listSaleTop)->get();

        // dd($topSale);
        // $topPoductSale = DB::table('products')->where()
        return view('frontend.home.index', compact('products', 'session', 'topSale'));
    }
}
