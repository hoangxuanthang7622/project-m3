@extends('master')
@section('content')

<main class="page-content">

<section class="wrapper">
    <div class="panel-panel-default">
        <div class="market-updates">
            <div class="container">
                <div class="page-inner">
                    <header class="page-title-bar">
                        <nav aria-label="breadcrumb">
                        </nav>
                    </header>
                    <div class="page-section">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <legend>Thông tin cơ bản</legend>
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tf1">Email<abbr name="Trường bắt buộc">*</abbr></label>
                                                <input name="email" type="text" class="form-control"
                                                    value="{{ old('email') }}">
                                                <small id="" class="form-text text-muted"></small>
                                                @error('email')
                                                <div style="color: red">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tf1">Mật Khẩu<abbr
                                                        name="Trường bắt buộc">*</abbr></label>
                                                <input name="password" type="text" class="form-control"
                                                    value="{{ old('password') }}">
                                                <small id="" class="form-text text-muted"></small>
                                                @error('password')
                                                <div style="color: red">{{ $message }}</div>
                                            @enderror
                                                <br>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="tf1">Họ Và Tên<abbr
                                                        name="Trường bắt buộc">*</abbr></label>
                                                <input name="name" type="text" class="form-control"
                                                    value="{{ old('name') }}">
                                                <small id="" class="form-text text-muted"></small>
                                                @error('name')
                                                <div style="color: red">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="tf1">Số Điện Thoại<abbr
                                                        name="Trường bắt buộc">*</abbr></label> <input name="phone"
                                                    type="number" class="form-control" value="{{ old('phone') }}">
                                                <small id="" class="form-text text-muted"></small>
                                                @error('phone')
                                            <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="tf1">Ngày sinh<abbr
                                                        name="Trường bắt buộc">*</abbr></label> <input name="birthday"
                                                    type="date" class="form-control" value="{{ old('birthday') }}">
                                                <small id="" class="form-text text-muted"></small>
                                                @error('birthday')
                                        <div style="color: red">{{ $message }}</div>
                                                @enderror
                                                <br>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="control-label" for="flatpickr01">Chức Vụ<abbr
                                                    name="Trường bắt buộc">*</abbr></label>
                                            <select name="group_id" id="" class="form-control">
                                                <option value="">--Vui lòng chọn--</option>
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('group_id')
                                            <div style="color: red">{{ $message }}</div>
                                                    @enderror
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label class="control-label" for="flatpickr01">Giới Tính<abbr
                                                    name="Trường bắt buộc">*</abbr></label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="">--Vui lòng chọn--</option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                                <option value="Khác">Khác</option>
                                                {{-- @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach --}}
                                            </select>
                                            @error('gender')
                                        <div style="color: red">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="col-lg-3 control-label">image</label>
                                            <div class="col-lg-4">
                                                <input accept="image/*" type='file' id="inputFile"
                                                    name="image" /><br>
                                                <img type="hidden" width="90px" height="90px" id="blah"
                                                    src="#" alt="" />
                                                    <br>
                                                    @error('image')
                                        <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- địa chỉ --}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="tf1">Địa chỉ<abbr
                                                        name="Trường bắt buộc">*</abbr></label> <input name="address"
                                                    type="text" class="form-control" value="{{ old('address') }}">
                                                <small id="" class="form-text text-muted"></small>
                                                @error('address')
                                                <div style="color: red">{{ $message }}</div>
                                                        @enderror
                                                <br>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <br><br><br><br>
                                        <button class="btn btn-primary" type="submit">Đăng ký</button>
                                        <a class="btn btn-danger" href="{{ route('user.index') }}">Hủy</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</section>
