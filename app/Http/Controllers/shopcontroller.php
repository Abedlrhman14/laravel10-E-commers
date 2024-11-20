<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class shopcontroller extends Controller
{
    public function index()
    {

        $products=product::orderBY('created_at','DESC')->paginate(12);
        return view('shop',['products'=>$products]);
    }
}
