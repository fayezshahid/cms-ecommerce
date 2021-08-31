@extends('dashboard')

@section('content')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 9px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }
</style>
<div class="products">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                @foreach ($errors as $error)
                    {{ $error }}
                @endforeach
            @endif
            <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $product->name }}">
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Price</label>
                    <input name="price" type="text" class="form-control" id="exampleInputPassword1" value="{{ $product->price }}">
                    @error('price')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Category</label>
                    <select class="form-select form-control" name="category" value="{{ $product->category }}">
                        <option disabled>Choose a category</option>
                        @foreach ($categories as $category)
                            <option value={{ $category->category }}>
                                    {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <input name="description" type="text" class="form-control" id="exampleInputPassword1" value="{{ $product->description }}">
                    @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Size</label>
                    <select class="form-select form-control js-example-basic-multiple" name="size[]" multiple="multiple">
                        <option disabled>Choose a size</option>
                        @foreach ($sizes as $size)
                            <option value={{ $size->id }} @foreach ($product->sizes as $psize) {{ ($size->id == $psize->id) ? 'selected' : '' }} @endforeach>
                                    {{ $size->size }}
                            </option>
                        @endforeach
                    </select>
                    @error('size')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Color</label>
                    <select class="form-select form-control js-example-basic-multiple" name="color[]" multiple="multiple">
                        <option disabled>Choose a color</option>
                        @foreach ($colors as $color)
                            <option value={{ $color->id }} @foreach ($product->colors as $pcolor) {{ ($color->id == $pcolor->id) ? 'selected' : '' }} @endforeach>
                                    {{ $color->color }}
                            </option>
                        @endforeach
                    </select>
                    @error('color')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Product Images (Add images in the order of colors)</label>
                    <input name="image[]" type="file" class="form-control" id="inputGroupFile02" multiple>
                    @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                    @error('featured_image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection


