@extends('master')
@section('content')
@include('sweetalert::alert')
    <main class="page-content">
        <h2>Thể loại</h2>
        <hr>
        @if(Auth::user()->hasPermission('Category_create'))
        <a href="{{ route('category.create') }}" class="btn btn-success">Thêm Thể Loại</a>
        @endif
        <table class="table">
        <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên thể loại</th>
                    <th scope="col">Tuỳ chỉnh</th>
                </tr>
        </thead>
        <tbody>
                @foreach ($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $category->name }}</td>

                    <td>
                        <a href="{{ route('category.edit', $category->id) }}"class="btn btn-sm btn-icon btn btn-outline-warning "><i
                                    class="bi bi-pencil "></i>
                        </a>
                        <form
                                onclick="return confirm('Bạn có muốn chuyển nó vào kho lưu trữ?')"
                                action="{{ route('category.softdeletes', $category->id) }}" style="display:inline"
                                method="post">
                                <button type="submit" class="btn btn-sm btn-icon btn btn-outline-danger"><i class="bi bi-trash"></i>
                                </button>
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
                {{ $categories->appends(request()->query()) }}
            </div>
        </div>
    </main>
@endsection
