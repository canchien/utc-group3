<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\User;

class DashboardController extends Controller
{
    public function index(){
        $products= Product::all();
        $orderProducts = DB::table('order_product')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->where('orders.status', 3)->get();
        $authUser = auth()->user();
        $user = User::find(1);
        
        return view('backend.dashboard.index', compact('products', 'orderProducts'));
    }
}
