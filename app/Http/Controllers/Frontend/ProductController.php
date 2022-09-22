<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function shopIndex()
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        $allProducts = Product::all()->count();
        $products = Product::paginate(9);
        return view('frontend.product.shop', compact('session', 'products', 'allProducts'));
    }

    public function showProduct($id)
    {
        $product = Product::find($id);
        $session = Session::has('cart') ? Session::get('cart') : null;
        return view('frontend.product.showProduct', compact('product', 'session'));
    }

    public function showProductFromCat($id)
    {
        $session = Session::has('cart') ? Session::get('cart') : null;
        $category = Category::find($id);
        $products = $category->products()->orderBy('created_at', 'DESC')->paginate(9);
        $catId = $products[0]->category->id ?? null;
        $allProducts = $category->products->count();
        return view('frontend.product.shop', compact('session', 'products', 'allProducts', 'catId'));
    }

    public function filterPrice()
    {
        $filerProducts = Category::find(request()->id);
        $products = $filerProducts->products()->whereBetween('price', [request()->from, request()->to])
            ->paginate(9);
        if (request()->ajax()) {
            return response()->json([
                'html' => view('frontend.product.ajax_product', compact('products'))->render(),
            ]);
        }
    }

    public function PageAjax()
    {
        $products = Product::paginate(9);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('frontend.product.ajax_product', compact('products'))->render(),
                'page' => request()->page,
            ]);
        }
    }

    public function shopFilter()
    {
        $products = Product::whereBetween('price', [request()->from, request()->to])
            ->paginate(9);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('frontend.product.ajax_product', compact('products'))->render(),
            ]);
        }
    }

    public function catPageAjax()
    {
        $category = Category::find(request()->id);
        $products = $category->products()->orderBy('created_at', 'DESC')->paginate(9);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('frontend.product.ajax_product', compact('products'))->render(),
                'page' => request()->page,
            ]);
        }
    }
}
