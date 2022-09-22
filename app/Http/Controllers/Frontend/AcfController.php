<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class AcfController extends Controller
{
    public function contact(Request $request)
    {
        $categories = Category::all();
        return view('frontend.home.about_contact_faqs')->with(['request' => $request, 'i' => 'Contact','categories'=>$categories]);
    }
    public function about(Request $request)
    {
        $categories = Category::all();
        return view('frontend.home.about_contact_faqs')->with(['request' => $request, 'i' => 'About','categories'=>$categories]);
    }
    public function faqs(Request $request)
    {
        $categories = Category::all();
        return view('frontend.home.about_contact_faqs')->with(['request' => $request, 'i' => 'Faqs','categories'=>$categories]);
    }
    public function term(Request $request)
    {
        $categories = Category::all();
        return view('frontend.home.about_contact_faqs')->with(['request' => $request, 'i' => 'Terms of Use','categories'=>$categories]);
    }
    public function privacy(Request $request)
    {
        $categories = Category::all();
        return view('frontend.home.about_contact_faqs')->with(['request' => $request, 'i' => 'privacy policy','categories'=>$categories]);
    }
    public function help(Request $request)
    {
        $categories = Category::all();
        return view('frontend.home.about_contact_faqs')->with(['request' => $request, 'i' => 'Help','categories'=>$categories]);
    }
}
