@extends('master')
@section('content')
<main class="page-content">

        <h1>Chỉnh sửa</h1>
        <form action="{{ route('product.update',$products->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" id="fname" name="name" value='{{$products->name}}' class="form-control">
                @error('name')
                    <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Loại sản phẩm</label>
                <select name="category_id" id="" class="form-control">
                    <option value="">-Vui Lòng Chọn-</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <input type="text" id="fname" name="description" value='{{$products->description}}' class="form-control">
                @error('description')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Giá sản phẩm</label>
                <input type="text" id="fname" name="price" value='{{$products->price}}' class="form-control">
                @error('price')
                    <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="text" id="fname" name="quantity" value='{{$products->quantity}}' class="form-control">
                @error('description')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputTitle">Ảnh Sản Phẩm</label><br>
                <input accept="image/*" type='file' id="inputFile" name="inputFile" /><br><br>
                <img type="hidden" width="90px" height="90px" id="blah"
                src="{{ asset('storage/images/' .$products->image) ?? $request->inputFile }}" alt="" /> <br>
                @error('inputFile')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="lưu" class="btn btn-success">
    <a href="{{route('product.index')}}" class="btn btn-danger">Huỷ</a>

        </form>
    </main>
@endsection
