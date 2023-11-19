@extends('templates.client.layout')

@section('content')
    <div class="untree_co-section before-footer-section">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Notification</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1 class="text-center">Order Detail</h1>
            <div class="row mb-5 overflow-auto">

                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">Order</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Total</th>
                            <th scope="col">Address Ship</th>
                            <th scope="col">Phone Ship</th>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Cart</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordered as $item)
                            <tr>
                                <th scope="row">#{{ $item->id }}</th>
                                <td>{{ $item->pttt == 0 ? 'Payment on deveridy' : 'Online payment' }}</td>
                                <td>{{ $item->total }} VND</td>
                                <td>{{ $item->address_ship }}</td>
                                <td>{{ $item->phone_ship }}</td>
                                <td>{{ $item->id_km }}</td>
                                <td>{{ $item->status_order == 0 ? 'Đang xử lý' : ($item->status_order == 1 ? 'Đang giao hàng' : ($item->status_order == 2 ? 'Đã hoàn thành' : 'Hủy')) }}
                                </td>
                                <td>
                                    <button type="button" class="btn " id="button_customer" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $item->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path
                                                d="M326.3 218.8c0 20.5-16.7 37.2-37.2 37.2h-70.3v-74.4h70.3c20.5 0 37.2 16.7 37.2 37.2zM504 256c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-128.1-37.2c0-47.9-38.9-86.8-86.8-86.8H169.2v248h49.6v-74.4h70.3c47.9 0 86.8-38.9 86.8-86.8z" />
                                        </svg>
                                    </button>
                                    <div class="modal fade modal-lg" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Your book order !
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">ID Book</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Count</th>
                                                                <th scope="col">Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order_detail as $item1)
                                                                @if ($item1->id_order == $item->id)
                                                                    <tr>
                                                                        <th scope="row">{{ $item1->id_order }}</th>
                                                                        <td>{{ $item1->id_book }}</td>
                                                                        @foreach ($book as $item2)
                                                                            @if ($item2->id == $item1->id_book)
                                                                                <td>{{ $item2->name }}</td>
                                                                            @endif
                                                                        @endforeach
                                                                        <td>{{ $item1->soLuong }}</td>
                                                                        <td>{{ $item1->price }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @if ($item->status_order == 0)
                                    <td><a name="" id="button_customer" class="btn cancel"
                                            href="{{ route('cancel_ordered', ['id' => $item->id]) }}"
                                            role="button">Cancel</a></td>
                                @elseif($item->status_order == 1)
                                    <td><a name="" id="button_customer" class="btn receive"
                                            href="{{ route('receive_ordered', ['id' => $item->id]) }}" role="button">
                                            Receive</a></td>
                                @else
                                    <td>Theo dõi</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
