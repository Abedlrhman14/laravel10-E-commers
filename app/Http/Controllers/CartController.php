<?php

namespace App\Http\Controllers;

// use Gloudemans\Shoppingcart\Cart;

use App\Models\product;
use Database\Factories\ProductFactory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
// use Cart;
// use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class CartController extends Controller
{
    public function index()
    {

        $cartItems=Cart::instance('cart')->content();
        // return view('cart',['cartItems'=>$cartItems]);
        return view('cart', compact('cartItems'));

    }
    public function addToCart(Request $request)
    {

        $product= Product::find($request->id);
        $price=$product->sale_price ? $product->sale_price : $product->regular_price;
        cart::instance('cart')->add($product->id,$product->name,$request->quantity, $price)->associate('App\Models\product');
        return redirect()->back()->with('message','success ! Item has been added successfully');
    }
    public function uptadeCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }
    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}
