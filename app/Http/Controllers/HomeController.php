<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders  =  Order::pluck('id')->count();
        $totalPrice  =  Order::pluck('total')->sum();
        $totalCustomer = Customer::count();
        $productnew = Product::take(5)->get();

        $topcustomer = DB::table('customers')
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->selectRaw('customers.*, sum(orders.total) as total_Order')
            ->groupBy('customers.id')
            ->orderBy('total_Order', 'desc')
            ->take(5)
            ->get();
            // d


            $topproduct = DB::table('orderdetail')
            ->leftJoin('products', 'products.id', '=', 'orderdetail.product_id')
            ->selectRaw('products.*, sum(orderdetail.quantity) total_Product, sum(orderdetail.total) total_Price')
            ->groupBy('orderdetail.product_id')
            ->orderBy('total_Product', 'desc')
            ->take(3)
            ->get();
            // dd($topproduct);

            
        return view('dashboard', compact('totalUsers','totalOrders','totalPrice','totalCustomer','topcustomer','topproduct','productnew'));
    }

}
