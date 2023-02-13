@extends('master')
@section('content')
    <main class="page-content">
        <h2>Thêm thể loại</h2>
        <form class="row g-3" action="{{ route('category.store') }}" method='post'>
            @csrf
            <div class="col-12">
                <label class="form-label">Tên</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                    <div style="color: red">{{$message}}</div>
                @enderror
            </div>
            <div class="col-12">
                <input type="submit" value="Thêm" class="btn btn-success">
                <a href="{{ route('category.index') }}" class="btn btn-danger">Huỷ</a>
            </div>
        </form>
    </main>
@endsection
