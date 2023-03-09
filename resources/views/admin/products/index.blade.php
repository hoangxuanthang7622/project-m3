@extends('master')
@section('content')
@include('sweetalert::alert')
    <main class="page-content">
        <h2>Sản phẩm</h2>
        <hr>
        @if(Auth::user()->hasPermission('Product_create'))
        <a href="{{ route('product.create') }}" class="btn btn-success">Thêm sản phẩm</a>
        @endif
        <table class="table">
            <form>
                <a class="btn btn-sm btn-icon btn-warning" type="button" name="key" value="{{ $f_key }}" data-bs-toggle="modal" data-bs-target="#basicModal">Tìm kiếm</a>
                    @include('admin.products.modals.modalproductcolumns')
                </form>
        <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tuỳ chỉnh</th>
                </tr>
        </thead>
        <tbody>
                @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price) }}VNĐ</td>
                    <td>{{ $product->quantity }}</td>
                    <td> <img src="{{ asset('storage/images/' . $product->image) }}"  style="width:100px;"></td>
                    <td>
                        @if (Auth::user()->hasPermission('Product_update'))
                        <a href="{{ route('product.edit', $product->id) }}"class="btn btn-sm btn-icon btn btn-outline-warning "><i
                                    class="bi bi-pencil"></i>
                        @endif
                        </a>
                        @if (Auth::user()->hasPermission('Product_view'))
                        <a href="{{ route('product.show', $product->id) }}"
                            class="btn btn-sm btn-icon btn btn-outline-info"><i class="bi bi-eye-fill"></i></a>
                        @endif
                        <form
                        @if (Auth::user()->hasPermission('Product_delete'))
                        onclick="return confirm('Bạn có muốn chuyển nó vào kho lưu trữ?')"
                        action="{{ route('product.softdeletes', $product->id) }}" style="display:inline"
                        method="post">
                        <button type="submit" class="btn btn-sm btn-icon btn btn-outline-danger "><i class="bi bi-trash"></i>
                        </button>
                        @endif
                        @csrf
                        @method('DELETE')

                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-6">
            <div class="pagination float-right">
                {{ $products->appends(request()->query()) }}
            </div>
        </div>
    </main>
@endsection
