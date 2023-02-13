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
                        <th scope="col">Tên</th>
                        <th adta-breakpoints="xs">Tuỳ chỉnh</th>
                    </tr>
                </thead>
                <tbody id="myTable">

                    @foreach ($categories as $key => $category)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $category->name }}</td>

                            <td>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{-- @if (Auth::user()->hasPermission('Category_restore')) --}}
                                    <a  href="{{ route('category.restoredelete', $category->id) }}"
                                        id="{{ $category->id }}" class="btn btn-success deleteIcon">Khôi phục</a>
                                        {{-- @endif --}}
                                    {{-- @if (Auth::user()->hasPermission('Category_forceDelete')) --}}
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
