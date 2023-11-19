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
                                            User </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Book
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                           Count
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Descrition
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Create at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rate as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ Storage::url($item->image) }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->user }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-secondary mb-0 text-center">{{$item->name}}</p>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-secondary mb-0 text-center">{{$item->rate}}</p>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-secondary mb-0 text-truncate " style="max-width: 400px;">{{ $item->content }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="room-pagination">
                            {{ $rate->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
