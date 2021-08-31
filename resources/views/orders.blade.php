@extends('dashboard')

@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{-- @foreach ($products as $product) --}}
                    @foreach ($orders as $order)
                    <div class="border border-primary m-3 ">
                        <div class="m-5 d-flex justify-content-center align-top">
                            @foreach ($order->product->images as $image)
                            <img src="{{ config("ecommerce.productUrl").$image->image }}" alt="item" height="100px" width="100px">
                            @break
                            @endforeach
                            <div class="d-inline-flex justify-content-between form-inline">
                                <h4 class="pl-5">{{ $order->product->name }}</h4>
                                <h6 class="pl-5">${{ $order->product->price }}</h6>
                                <p class="pl-5 pt-2">{{ $order->product->description }}</p>
                                <form action="{{ route('order.delete', $order) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-info ml-5 mb-1">Mark as Done</button>
                                </form>
                            </div>
                        </div>
                        <div class="border border-top-secondary text-center">
                            Email: {{ $order->email }} <br>
                            Phone: {{ $order->phone }} <br>
                            Address: {{ $order->address }} <br>
                            Quantity: {{ $order->quantity }} <br>
                            Size: {{ $order->size }} <br>
                            Color: {{ $order->color }} <br>
                            Payment Method: {{ $order->payment }} <br>
                            @if($order->payment == 'cc')
                            Credit Card Number: {{ $order->creditCardNumber }} <br>
                            @elseif($order->payment == 'epaisa')
                            EasyPaisa Number: {{ $order->easyPaisaNumber }} <br>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
@endsection
