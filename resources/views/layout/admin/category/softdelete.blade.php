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
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>{{ $title }}</h6>
                        <div>
                            <a href="{{ route('insert_category') }}"
                                class="btn btn-outline-success text-success  fw-bolder  btn-sm rounded-pill "
                                data-toggle="tooltip" data-original-title="add user">
                                NEW 
                            </a>
                            <a href="{{ route('category') }}"
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
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Descrition
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
                                                        <p class="text-xs text-secondary mb-0">Type 1</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <img width="100px" src="{{ Storage::url($item->image) }}"
                                                        class="" alt="user1">
                                                </div>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <p class="text-xs text-secondary mb-0 text-truncate" style="max-width: 400px">{{ $item->description }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('restore_category', ['id' => $item->id]) }}"
                                                    class="my-3 btn btn-outline-warning text-warning fw-light text-xs btn-sm"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Restore
                                                </a>
                                                <a onclick="return confirm('Are you sure ?')"
                                                    href="{{ route('force_category', ['id' => $item->id]) }}"
                                                    class="my-3 btn btn-outline-danger text-danger text-xs btn-sm"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Delete
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
