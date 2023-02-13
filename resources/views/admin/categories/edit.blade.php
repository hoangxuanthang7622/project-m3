@extends('master')
@section('content')
    <main class="page-content">
        <h1>Chỉnh sửa Danh Mục</h1>
        <form action="{{ route('category.update', $categories->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên thể loại</label>
                <input type="text" id="fname" name="name" value='{{ $categories->name }}' class="form-control">
            </div>
            <input type="submit" value="Cập nhật" class="btn btn-primary">
            <a href="{{ route('category.index') }}" class="btn btn-danger">Huỷ</a>
        </form>
    </main>
@endsection
