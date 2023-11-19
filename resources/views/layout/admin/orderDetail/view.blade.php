@extends('templates.admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>{{ $title }}</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Product</th>
                                            <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                           ID Order
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                           Count
                                        </th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_detail as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @foreach ($book as $item1)
                                                        @if ($item1->id == $item->id_book)
                                                        <div>
                                                            <img src="{{ Storage::url($item1->image) }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item1->name }}</h6>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-center text-secondary mb-0">{{ $item->id_order }}</p>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-center text-secondary mb-0">{{ $item->price }} VND</p>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-center text-secondary mb-0">{{ $item->soLuong }}</p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="room-pagination">
                            {{ $order_detail->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
