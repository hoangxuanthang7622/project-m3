@extends('master')
@section('content')
<main class="page-content">
<style>
    img#avtshow {
        border: 3px solid rgb(150, 0, 0);
        padding: 10px;
        height: 250px;
        width: 250px;
        border-radius: 50%;

    }
</style>
<div class="card">
    <div class="card-body">
        <br>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Quay Lại</a>
        <h2 class="offset-4">
            Thông tin chi tiết
        </h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="gallery-grid">
                    <br>
                    <a class="example-image-link" href="{{ asset($user->image) }}" data-lightbox="example-set"
                        data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
                        <img src="{{asset('public/assets/images/user/' . $user->image)}}" id="avtshow">
                        <div class="captn">
                            {{-- <h4>Xem Avt</h4> --}}
                        </div>
                    </a>
                </div>
                <div class="panel-body">
                    <hr>
                    <h3 style="color: red">{{ $user->name }}</h3>
                    <ul class="nav nav-pills nav-stacked labels-info ">
                        <li>
                            <h6>{{ $user->group->name }}</h6>
                        </li>
                    </ul>
                    <hr>
                </div>
                <div class="text-center">
                    <a class="btn mini btn-default" href="{{ route('user.editpass', Auth::user()->id) }}">
                        <i class="fa fa-cog"> Mật Khẩu </i>
                    </a>
                    <a class="btn mini btn-default" href="{{ route('user.adminpass', $user->id) }}">
                        <i class="fa fa-cog">Mật khẩu*</i>
                    </a>
                </div>
            </div>

            <div class="col-sm-9">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Thông
                            tin</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Khác</button>
                    </li>
                    @if(Auth()->user()->id ==  $user->id )
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Thay đổi
                            mật khẩu</button>
                    </li>
                    @endif
                    @if (Auth::user()->hasPermission('User_adminupdatepass'))
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab"
                            data-bs-target="#profile-change-password-by-mail">Admin đổi mật khẩu</button>
                    </li>
                    @endif
                </ul>



                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        @if (Session::has('success'))
                            <p class="text-success"><i class="fa fa-check" aria-hidden="true"></i>
                                {{ Session::get('success') }}
                            </p>
                        @endif
                        @if (Session::has('error'))
                            <p class="text-danger"><i class="bi bi-x-circle"></i>
                                {{ Session::get('error') }}
                            </p>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Họ tên</h5>
                            </div>
                            <div class="col-sm-9">
                                <h3>{{ $user->name }}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Email</h3>
                            </div>
                            <div class="col-sm-9">
                                <h3>{{ $user->email }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Số điện thoại</h3>
                            </div>
                            <div class="col-sm-9">
                                <h3>{{ $user->phone }}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Giới tính</h3>
                            </div>
                            <div class="col-sm-9">
                                <h3>{{ $user->gender }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Ngày sinh</h3>
                            </div>
                            <div class="col-sm-9">
                                <h3>{{ $user->birthday }}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Địa chỉ</h3>
                            </div>
                            <div class="col-sm-9">
                                <h4>{{ $user->address }}</h4>

                            </div>
                        </div>
                    </div>
                </div>
</main>
@endsection
