<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlsitController extends Controller
{
    public function addProductToWishlist(Request $request)
    {
        Cart::instance("wishlist")->add($request->id,$request->name,1,$request->price)->associate('App\Models\Product');
        return response()->json(['status'=>200,'massage'=>'success ! item successfuly added to your whslist.']);
    }
}
