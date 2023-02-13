@extends('master')
@section('content')
<main class="page-content">
<section class="wrapper">
    <div class="panel-panel-default">
        <div class="market-updates">
            <div class="container">
                <main id="main" class="main">
                    <div class="pagetitle">
                        <h2>Danh Sách Khách hàng</h2>
                        <hr>
                    </div>
                    <table class="table border-primary">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên Khách Hàng</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số Điện Thoại</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->onEachSide(5)->links() }}
                </main>
            </div>
        </div>
    </div>
</section>
</main>
@endsection
