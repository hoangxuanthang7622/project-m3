<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $cart = session()->get('cart', []);
        $items = Category::with('products')->get();
        $products = Product::with('category')->get();
        $param = [
            'cart' => $cart,
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
    public function detail(Request $request, $id)
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
        $items = Category::with('products')->get();
        $cart = session()->get('cart', []);
        $param = [
            'items' => $items,
            'cart' => $cart
        ];
        return view('shop.layouts.checkout', $param);
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
    public function register()
    {
        return view('shop.layouts.register');
    }
    public function checkregister(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        try {
            $customer->save();
            return redirect()->route('viewlogin');
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
        }

        if ($request->password == $request->confirmpassword) {
            $customer->save();
            alert()->success('Đăng kí tài khoản', 'Thành công');
            return redirect()->route('shop.login');
        } else {
            alert()->error('Đăng kí tài khoản', 'Thất bại');

            return redirect()->route('shop.register');
        }
    }
    public function login()
    {
        return view('shop.layouts.login');
    }
    public function checklogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::guard('customers')->attempt($arr)) {
            alert()->success('Đăng nhập thành công', 'Thành công');

            return redirect()->route('shop.index');
        } else {
            return redirect()->route('shop.login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('shop.index');
    }

    public function order(Request $request)
    {
        try {

            $id = Auth::guard('customers')->user()->id;
            $data = Customer::find($id);
            $data->address = $request->address;
            $data->email = $request->email;
            $data->phone = $request->phone;

            $data->save();


            $order = new Order();
            $order->customer_id = Auth::guard('customers')->user()->id;
            $order->date_at = date('Y-m-d H:i:s');
            $order->total = $request->total;
            $order->save();

            $count_product = count($request->product_id);
            for ($i = 0; $i < $count_product; $i++) {
                $orderItem = new Orderdetail();
                $orderItem->order_id =  $order->id;
                $orderItem->product_id = $request->product_id[$i];
                $orderItem->quantity = $request->quantity[$i];
                $orderItem->total = $request->total[$i];
                $orderItem->save();
                session()->forget('cart');
                DB::table('products')
                    ->where('id', '=', $orderItem->product_id)
                    ->decrement('quantity', $orderItem->quantity);
            }
            alert()->success('Đặt hàng', 'thành công');
            return redirect()->route('shop.index');
        } catch (\Exception $e) {
            alert()->error('Đặt hàng', 'thất bại');
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            Mail::send('mail.mail', compact('data'), function ($email) use ($request) {
                $email->subject('Xmen-Store');
                $email->to($request->email, $request->name);
            });
            return redirect()->route('shop.index');
        }
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
