@extends('templates.admin.layout')
@section('content')
    {{-- <div class="container-fluid"> --}}
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
                                        User</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Payment
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Address ship</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone Ship</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Discount</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Order</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                @foreach ($user as $item1)
                                                    @if ($item1->id == $item->id_user)
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
                                            <p class="text-xs text-secondary mb-0">
                                                {{ $item->pttt == 0 ? 'Payment on deveridy' : 'Online payment' }}</p>
                                        </td>
                                        <td class="align-middle  text-sm">
                                            <p class="text-xs text-secondary mb-0">{{ $item->total }} VND</p>
                                        </td>
                                        <td class="align-middle  text-sm">
                                            <p
                                                class="text-xs text-secondary mb-0  {{ $item->status == 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $item->status == 0 ? 'unpaid' : 'paid' }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $item->address_ship }}</span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $item->phone_ship }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->id_km }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $item->status_order == 0 ? 'Đang xử lý' : ($item->status_order == 1 ? 'Đang giao hàng' : ($item->status_order == 2 ? 'Đã hoàn thành' : 'Hủy')) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($item->status_order == 3)
                                                <p
                                                    class="my-3 btn btn-outline-danger bg-danger text-white fw-light text-xs btn-sm">
                                                    Cancel</p>
                                            @elseif($item->status_order == 0)
                                                <a href="{{ route('handle', ['id' => $item->id]) }}"
                                                    class="my-3 btn btn-outline-warning text-warning fw-light text-xs btn-sm"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Handle
                                                </a>
                                            @elseif($item->status_order == 2)
                                                <p
                                                    class="my-3 btn btn-outline-success bg-success text-white fw-light text-xs btn-sm">
                                                    Accomplished
                                                </p>
                                            @else
                                                <p
                                                    class="my-3 btn btn-outline-info bg-info text-white fw-light text-xs btn-sm">
                                                    Are delivering
                                                </p>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="room-pagination">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
