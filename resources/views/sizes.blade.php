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
            <form action="{{ route('size.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="size" type="text" class="form-control" placeholder="Enter the size">
                    <button class="btn btn-primary ml-2">+ Add a size</button>
                </div>
                @error('size')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </form>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Sr.no</th>
                        <th scope="col">Sizes Available</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sizes as $size)
                        <tr>
                            <td>{{ $size->id }}</td>
                            <td>{{ $size->size }}</td>
                            <td>
                                <form action="{{ route('size.delete', $size) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete Size</button>
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
