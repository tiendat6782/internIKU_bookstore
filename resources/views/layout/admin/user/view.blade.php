@extends('templates.admin.layout')
@section('content')
    <div class="container-fluid">
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
                            @can('isAdmin')
                                <a href="{{ route('view-delete') }}"
                                    class="btn btn-outline-danger text-danger  fw-bolder  btn-sm rounded-pill "
                                    data-toggle="tooltip" data-original-title="add user">
                                    Trash to move
                                </a>
                                <a href="{{ route('insert') }}"
                                    class="btn btn-outline-success text-success  fw-bolder  btn-sm rounded-pill "
                                    data-toggle="tooltip" data-original-title="add user">
                                    NEW USER
                                </a>
                            @endcan


                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Create</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($user)
                                        @foreach ($user as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ Storage::url($item->image) }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->role == 1 ? 'User' : 'Admin' }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->created_at == '' ? 'N/A' : $item->created_at }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('edit_user', ['id' => $item->id]) }}"
                                                        class="my-3 btn btn-outline-warning text-warning fw-normal  btn-sm"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        <svg id="edit" xmlns="http://www.w3.org/2000/svg" height="0.875em"
                                                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <style>
                                                                #edit {
                                                                    fill: #fafd4e
                                                                }
                                                            </style>
                                                            <path
                                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                        </svg>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure?')"
                                                        href="{{ route('delete_user', ['id' => $item->id]) }}"
                                                        class="my-3 mx-1 btn btn-outline-danger text-danger fw-normal  btn-sm"
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
                                                    <a href="{{ route('profile', ['id' => $item->id]) }}"
                                                        class="my-3 btn btn-outline-success text-success fw-normal  btn-sm"
                                                        data-toggle="tooltip" data-original-title="View user">
                                                        <svg id="detail" xmlns="http://www.w3.org/2000/svg" height="0.875em"
                                                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <style>
                                                                #detail {
                                                                    fill: #41f144
                                                                }
                                                            </style>
                                                            <path
                                                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="room-pagination">
                            {{ $user->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
