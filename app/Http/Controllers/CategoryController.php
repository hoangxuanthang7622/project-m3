<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::search()->paginate(5);
        $param = [
            'categories' => $categories
        ];
        return view('admin.categories.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            alert()->success('Thêm danh mục' , 'Thành công');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            alert()->error('Thêm danh mục','Thất bại');
            return redirect()->route('category.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        $param = [
            'categories' => $categories
        ];
        return view('admin.categories.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        try {
            $category = new Category();
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();
            alert()->success('Cập nhật danh mục' , 'Thành công');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            alert()->error('Thêm danh mục','Thất bại');
            return redirect()->route('category.index');
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
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        alert()->success('Xoá danh mục' , 'Thành công');
        return redirect()->route('category.trash');
    } catch (\Throwable $th) {
        alert()->error('Xoá danh mục','Thất bại');
        return redirect()->route('category.trash');

    }
    }
    public function trash(){
        $categories = Category::onlyTrashed()->get();
        $param = [
            'categories'    => $categories
        ];
        return view('admin.categories.trash', $param);
    }
    public  function softdeletes($id){
        $this->authorize('delete', Category::class);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $category = Category::findOrFail($id);
        $category->deleted_at = date("Y-m-d h:i:s");

        $category->save();
        alert()->success('Đã chuyển vào kho lưu trữ','thành công');

        return redirect()->route('category.index');
    }
    public function restoredelete($id){
        $this->authorize('restore',Category::class);
        $categories=Category::withTrashed()->where('id', $id);
        $categories->restore();

        alert()->success('Khôi phục ','thành công');

        return redirect()->route('category.trash');
    }
}
