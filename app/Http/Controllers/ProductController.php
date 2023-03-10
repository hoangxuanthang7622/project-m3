<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $products =Product::search()->paginate(5);
        $categories = Category::all();
        $key        = $request->key ?? '';
        $name      = $request->name ?? '';
        $price      = $request->price ?? '';
        $category_id       = $request->category_id ?? '';
        $id         = $request->id ?? '';
        $query = Product::query(true);

        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($price) {
            $query->where('price', 'LIKE', '%' . $price . '%');
        }
        if ($category_id) {
            $query->where('category_id', 'LIKE', '%' . $category_id . '%');
        }
        if ($id) {
            $query->where('id', $id);
        }
        if ($key) {
            $query->orWhere('id', $key);
            $query->orWhere('name', 'LIKE', '%' . $key . '%');
            $query->orWhere('price', 'LIKE', '%' . $key . '%');
            $query->orWhere('category_id', 'LIKE', '%' . $key . '%');
        }

        $products = $query->paginate(4);

       $params = [
            'f_id'        => $id,
            'f_name'     => $name,
            'f_price'     => $price,
            'f_category_id'     => $category_id,
            'f_key'       => $key,
            'f_categories' => $categories,
            'products'    => $products,
        ];

        return view('admin.products.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $param = [
            'categories' => $categories
        ];
        return view('admin.products.create', $param);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        try {
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        // $product->image = $request->image;
        $product->description = $request->description;
        $file = $request->inputFile;
        if ($request->hasFile('inputFile')) {
            $fileExtension = $file->getClientOriginalName();
            //L??u file v??o th?? m???c storage/app/public/image v???i t??n m???i
            $request->file('inputFile')->storeAs('public/images', $fileExtension);
            // G??n tr?????ng image c???a ?????i t?????ng task v???i t??n m???i
            $product->image = $fileExtension;

        }
        $product->save();
        alert()->success('Th??m','th??nh c??ng');
        return redirect()->route('product.index');
    } catch (\Throwable $th) {
        alert()->error('Th??m','th???t b???i');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productshow = Product::findOrFail($id);
        $param =[
            'productshow'=>$productshow,
        ];

        // $productshow-> show();
        return view('admin.products.show',  $param );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $products = Product::find($id);
        $param = [
            'categories' => $categories,
            'products' => $products
        ];
        return view('admin.products.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $id)
    {

        try {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $file = $request->inputFile;
        if ($request->hasFile('inputFile')) {
            $fileExtension = $file->getClientOriginalName();
            //L??u file v??o th?? m???c storage/app/public/image v???i t??n m???i
            $request->file('inputFile')->storeAs('public/images', $fileExtension);
            // G??n tr?????ng image c???a ?????i t?????ng task v???i t??n m???i
            $product->image = $fileExtension;

        }
            $product->save();
            alert()->success('C???p nh???t','th??nh c??ng');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            alert()->error('C???p nh???t','th???t b???i');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $products=Product::onlyTrashed()->findOrFail($id);
            $products->forceDelete();
            alert()->success('Xo?? s???n ph???m' , 'Th??nh c??ng');
            return redirect()->route('product.trash');
        } catch (\Throwable $th) {
            alert()->error('Xo?? s???n ph???m','Th???t b???i');
            return redirect()->route('product.trash');

        }


    }
    public function trash(){
        $products = Product::onlyTrashed()->get();
        $param = [
            'products'    => $products
        ];
        return view('admin.products.trash', $param);
    }
    public  function softdeletes($id){
        $this->authorize('delete', Category::class);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $products = Product::findOrFail($id);
        $products->deleted_at = date("Y-m-d h:i:s");
        // $notification = [
        //     'message' => '???? chuy???n v??o kho l??u!',
        //     'alert-type' => 'success'
        // ];
        $products->save();
        alert()->success('???? chuy???n v??o kho l??u tr???','th??nh c??ng');

        return redirect()->route('product.index');
    }
    public function restoredelete($id){
        $this->authorize('restore',Category::class);
        $products=Product::withTrashed()->where('id', $id);
        $products->restore();
        // $notification = [
        //         'message' => 'Kh??i ph???c th??nh c??ng!',
        //          'alert-type' => 'success'
        //     ];
        alert()->success('Kh??i ph???c ','th??nh c??ng');

        return redirect()->route('product.trash');
    }
}
