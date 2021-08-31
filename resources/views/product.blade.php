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
    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('product.add') }}" class="btn btn-primary">+ Add a product</a>
    </div>
    <table class="table text-center">
        <thead>
            <tr>
            <th scope="col">Product Id</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Size</th>
            <th scope="col">Color</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ config("ecommerce.productUrl").$product->featured_image }}" alt="item" height="50px" width="50px" class="mx-auto">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>
                        @foreach ($product->sizes as $size)
                            {{ $size->size }},
                        @endforeach
                    </td>
                    <td>
                        @foreach ($product->colors as $color)
                            {{ $color->color }},
                        @endforeach
                    </td>
                    <td class="d-flex justify-content-center form-inline">
                        <a href="{{ route('product.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('product.delete', $product) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger ml-2">Delete</button>
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
