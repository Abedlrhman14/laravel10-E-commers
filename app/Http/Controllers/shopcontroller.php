<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\product;
use Illuminate\Http\Request;

class shopcontroller extends Controller
{
    public function index(Request $request)
    {
        $page = $request ->query('page');
        $size = $request ->query('size');
        if(!$page)
        $page=1;
        if(!$size)
        $size = 12;
        $order = $request->query("order");
        if(!$order)
        $order = -1;
        $o_column = "";
        $o_order = "";
        switch($order)
        {
            case 1:
                $o_column ="created_at";
                $o_order  ="DESC";
                break;
            case 2:
                $o_column ="created_at";
                $o_order  ="ASC";
                break;
            case 3:
                $o_column ="refular_price";
                $o_order  ="DESC";
                break;
            case 4:
                $o_column ="refular_price";
                $o_order  ="ASC";
                break;
            default:
                $o_column ="id";
                $o_order  ="DESC";
        }
        $brands = Brand::orderBy('name','ASC')->get();
        $q_brands = $request->query("brands");
        $products = Product::where(function($query) use($q_brands){
                                $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
                            })
                    ->orderBy('created_at','DESC')->orderBy($o_column,$o_order)->paginate($size);
        return view('shop',['products'=>$products,'page'=>$page,'size'=>$size,'order'=>$order,'brands'=>$brands,'q_brands'=>$q_brands]);
    }

    public function productDettails($slug)
    {
        $product = product::where('slug',$slug)->first();
        $rproducts= product::where('slug','!=',$slug)->inRandomOrder('id')->get()->take(8);
        return view('details',['product'=>$product,'rproducts'=>$rproducts]);
    }
}
