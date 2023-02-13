@extends('master')
@section('content')
    <main class="page-content">
        <h2>Thùng rác</h2>
        @include('sweetalert::alert')

        <div class="container">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Ảnh</th>
                        <th adta-breakpoints="xs">Tuỳ chỉnh</th>
                    </tr>
                </thead>
                <tbody id="myTable">

                    @foreach ($products as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ number_format($product->price) }}VNĐ</td>
                            <td>{{ $product->quantity }}</td>
                            <td> <img src="{{ asset('storage/images/' . $product->image) }}"  style="width:100px;"></td>

                            <td>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{-- @if (Auth::user()->hasPermission('Product_restore')) --}}
                                    <a  href="{{ route('product.restoredelete', $product->id) }}"
                                        id="{{ $product->id }}" class="btn btn-success deleteIcon">Khôi phục</a>
                                        {{-- @endif --}}
                                    {{-- @if (Auth::user()->hasPermission('Product_forceDelete')) --}}
                                        <button onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" type="submit" class="btn btn-danger">Xoá</button>
                                        {{-- @endif --}}

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
