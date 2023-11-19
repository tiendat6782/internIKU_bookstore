@extends('templates.client.layout')
@section('content')
    <div class="untree_co-section">
        <div class="container">
            <h1 class="text-center">Check out</h1>
            <form action="{{ route('order_cart') }}" method="post">
                @csrf
                <div class="row pt-2">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control " disabled id="c_fname" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Address Ship <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="address_ship"
                                        placeholder="Street address">
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address"
                                        value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Phone Ship <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="phone_ship"
                                        placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="" class="form-label">Payment</label>
                                <select class="form-select form-select-lg" name="pttt" id="">
                                    <option value="0">Payment on
                                        delivery</option>
                                    <option value="1">Online payment</option>
                                </select>
                            </div>
                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank"
                                        role="button" aria-expanded="false" aria-controls="collapsebank">Payment on
                                        delivery</a></h3>

                                <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                        <p class="mb-0">After the customer receives the goods and checks them, they will
                                            then
                                            pay the order value</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque"
                                        role="button" aria-expanded="false" aria-controls="collapsecheque">Online
                                        payment</a>
                                </h3>

                                <div class="collapse" id="collapsecheque">
                                    <div class="py-2">
                                        <p class="mb-0">Customers will pay online through a third party to pay the value
                                            of
                                            the order the customer has placed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td>{{ $item[0]->name }}<strong class="mx-2">x</strong>
                                                    {{ $item[0]->qty }}</td>
                                                <td>{{ $item[0]->price * $item[0]->qty }} VND</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                            <td class="text-black">{{ $subtotal }} VND </td>
                                        </tr>
                                        @if (session('key'))
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Promotional value</strong></td>
                                                <td class="text-black font-weight-bold"><strong>{{ session('key')[3].'%' }}</strong>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>{{ $total }} VND</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
