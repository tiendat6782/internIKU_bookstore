@extends('templates.client.layout')
@section('content')
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <h1 class="text-center">Cart</h1>
            @if ($cart == [])
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Welcome to Cart !</h4>
                    <p>Welcome to our shopping cart. Currently, your cart does not have any selected products</p>
                    <hr>
                    <p class="mb-0">Please choose a product <a class="p-2 text-success" href="{{ route('shop') }}">Click
                            here</a></p>
                </div>
            @else
                <div class="row mb-5">
                    <form class="col-md-12" action="{{route('updateCart')}}" method="post">
                        @csrf
                        <div class="site-blocks-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ Storage::url($item[1]->image) }}" alt="Image"
                                                    class="img-fluid">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $item[0]->name }}</h2>
                                            </td>
                                            <td>${{ $item[0]->price }}</td>
                                            <td>
                                                <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                    style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-black decrease"
                                                            type="button">&minus;</button>
                                                    </div>
                                                    <input type="text" class="form-control text-center quantity-amount"
                                                        value="{{ $item[0]->qty }}" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1" name="qty[]">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-black increase"
                                                            type="button">&plus;</button>
                                                    </div>
                                                </div>

                                            </td>
                                            <input type="hidden" value="{{$item[0]->rowId}}" name="rowId[]">
                                            <td>{{ $item[0]->price * $item[0]->qty }}</td>
                                            <td><a href="{{ route('removeCart', ['id' => $item[0]->rowId]) }}"
                                                    class="btn btn-black btn-sm">X</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('shop') }}" class="btn btn-outline-black btn-sm btn-block">Continue
                                    Shopping</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('addCode') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-black h4" for="coupon">Coupon</label>
                                    <p>Enter your coupon code if you have one.</p>
                                </div>
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <input type="text" class="form-control  py-3" name="code" id="coupon"
                                        placeholder="Coupon Code">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-black">Apply Coupon</button>
                                </div>
                                @if (Session::has('key'))
                                    <p>{{ Session::get('message') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">{{ $subtotal }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">{{ $total }}</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('order_cart') }}"
                                            class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
