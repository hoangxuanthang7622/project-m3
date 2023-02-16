@extends('master')
@section('content')
@include('sweetalert::alert')

<style>
    img#avt {
width: 80px;
height: 80px;
border-radius:50%;
-moz-border-radius:50%;
-webkit-border-radius:50%;
}
</style>
<main class="page-content">

<section class="wrapper">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel-panel-default">
                    <header class="page-title-bar">
                        @if(Auth::user()->hasPermission('User_create'))
                        <a href="{{ route('user.create') }}" class="btn btn-info">Đăng ký tài khoản user</a>
                        @endif
                    </header>
                    <hr>
                    <div class="panel-heading">
                      <h3> Nhân sự</h3>
                    </div>
                    <div>
                        <table class="table" ui-jq="footable"
                            ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>

                            <thead>
                                <tr>
                                    <th data-breakpoints="xs">STT</th>
                                    {{-- <th data-breakpoints="xs">ID</th> --}}
                                    <th>Avatar</th>
                                    <th>Tên</th>
                                    <th>Phone</th>
                                    <th>Chức vụ</th>
                                    <th data-breakpoints="xs">Tùy Chỉnh</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach ($users as $key => $user)
                                    <tr data-expanded="true" class="item-{{ $user->id }}">
                                        <td>{{  ++$key }}</td>
                                        <td><a href="{{ route('user.show', $user->id) }}"><img id="avt" src="{{asset('public/assets/images/user/' . $user->image)}}" alt=""></a></td>
                                        <td><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->group->name }}</td>
                                        <td>
                                            @if (Auth::user()->hasPermission('User_update'))
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-primary">Chỉnh sửa</a>
                                            @endif
                                            @if (Auth::user()->hasPermission('User_forceDelete'))
                                            <a href="{{ route('user.destroy', $user->id) }}"
                                                id="{{ $user->id }}" class="btn btn-danger deleteIcon">Xóa</i></a>
                                            @endif
                                            @if (Auth::user()->hasPermission('User_adminUpdatePass'))
                                            <a href="{{ route('user.adminpass', $user->id) }}"
                                                class="btn btn-info">Đổi mật khẩu</a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       {{-- {{ $users->appends(request()->query()) }} --}}
                    </div>
                </div>
            </div>
        </section>
</section>
</main>
@endsection
