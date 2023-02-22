<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(1);
        $items = Category::with('products')->get();
        $products =Product::with('category')->get();
        $param = [
            'products' => $products,
            'items' => $items
        ];
        return view('shop.layouts.main', $param);
    }
    public function products()
    {
        $items = Category::with('products')->get();
        // dd($items);
        $products = Product::search()->get();
        $categories = Category::get();
        // dd($products);
        $param = [
            'products' => $products,
            'categories' => $categories,
            'items' => $items
        ];
        return view('shop.layouts.product', $param);
    }
    public function detail(Request $request,$id)
    {
        $Category = Category::find($id);
        $products = $Category->products;
        $categories = Category::get();
        // dd($products);
        $param = [
            'products' => $products,
            'categories' => $categories
        ];
        return view('shop.layouts.product', $param);
    }
    public function show($id)
    {
        $productdetail = Product::find($id);
        $items = Category::with('products')->get();
        // dd($items);
        // $products = Product::search()->get();
        // dd($products);
        $param = [
            'productdetail' => $productdetail,
            'items' => $items
        ];
        return view('shop.layouts.show', $param);
    }
    public function checkout()
    {

        return view('shop.layouts.checkout');

    }
    public function cart()
    {
        // dd(1);
        $productshow = Product::all();
        $categories = Category::all();
        $param = [
            'productshow' => $productshow,
            'categories' => $categories,
        ];
        return view('shop.mastershop', $param);
    }
    public function addtocart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nameVi" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                'image' => $product->image,
                'max' => $product->quantity,
            ];
        }
        session()->put('cart', $cart);
        $data = [];
        $data['cart'] = session()->has('cart');
        return redirect()->back();
    }
    public function removeCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->put('cart', $cart);
            return redirect()->back();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
