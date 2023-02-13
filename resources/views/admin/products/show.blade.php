@extends('master')
@section('content')
<main class="page-content">
<h1>Chi tiết sản phẩm</h1>
<table class="table">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Thể loại</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Giá</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Ảnh</th>
    </tr>
    <tr>
        <th scope="row">{{ $productshow->id}}</th>
        <td>{{ $productshow->name }}</td>
        <td>{{ $productshow->category->name }}</td>
        <td>{{ $productshow->description }}</td>
        <td>{{ number_format($productshow->price) }}VNĐ</td>
        <td>{{ $productshow->quantity }}</td>
        <td> <img src="{{ asset('storage/images/' . $productshow->image) }}"  style="width:100px;"></td>
    </tr>
</table>
</main>
@endsection
