@extends('templates.admin.layout')
@section('content')
    <div class="container-fluid py-4">
        @if (Session::has('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif
        @if (Session::has('error'))
            {{ Session::get('error') }}
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>{{ $title }}</h6>
                        <div>
                            <a href="{{ route('insert_promotion') }}"
                                class="btn btn-outline-success text-success  fw-bolder  btn-sm rounded-pill "
                                data-toggle="tooltip" data-original-title="add user">
                                NEW
                            </a>
                            <a href="{{ route('promotion') }}"
                                class="btn btn-outline-secondary text-secondary  fw-bolder  btn-sm rounded-pill "
                                data-toggle="tooltip" data-original-title="add user">
                                List
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Code</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Value
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Note
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Create at</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deleted as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->time }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->code }}</span>

                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold ">{{ $item->giatri }}</span>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-secondary text-xs font-weight-bold  text-truncate "
                                                    style="width: 400px">{{ $item->description }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->status == 0 ? 'Disable' : 'Enable' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->start }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->end }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('restore_promotion', ['id' => $item->id]) }}"
                                                    class="my-3 btn btn-outline-warning text-warning fw-light  btn-sm"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <svg id="restore" xmlns="http://www.w3.org/2000/svg" height="0.875em"
                                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <style>
                                                            #restore {
                                                                fill: #f0d419
                                                            }
                                                        </style>
                                                        <path
                                                            d="M432 64H208c-8.8 0-16 7.2-16 16V96H128V80c0-44.2 35.8-80 80-80H432c44.2 0 80 35.8 80 80V304c0 44.2-35.8 80-80 80H416V320h16c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16zM0 192c0-35.3 28.7-64 64-64H320c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V192zm64 32c0 17.7 14.3 32 32 32H288c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32 14.3-32 32z" />
                                                    </svg>
                                                </a>
                                                <a onclick="return confirm('Are you sure ?')"
                                                    href="{{ route('force_promotion', ['id' => $item->id]) }}"
                                                    class="my-3 btn btn-outline-danger text-danger fw-light  btn-sm"
                                                    data-toggle="tooltip" data-original-title="Delete user">
                                                    <svg id="delete" xmlns="http://www.w3.org/2000/svg" height="0.875em"
                                                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <style>
                                                            #delete {
                                                                fill: #ff0505
                                                            }
                                                        </style>
                                                        <path
                                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="room-pagination">
                            {{ $deleted->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
