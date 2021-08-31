@extends('dashboard')

@section('content')
<div class="products">
    <div class="container">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="category" type="text" class="form-control" placeholder="Enter the category">
                    <button class="btn btn-primary ml-2">+ Add a category</button>
                </div>
                @error('category')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </form>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Sr.no</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category }}</td>
                            <td>
                                <form action="{{ route('category.delete', $category) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete Category</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
