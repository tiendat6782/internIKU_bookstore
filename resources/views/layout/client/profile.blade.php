@extends('templates.client.layout')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
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
        <form action="{{ route('profiles_client') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <div class="profile-pic ">
                            <label class="-label" for="file">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Change Image</span>
                            </label>
                            <input id="file" name="image" class="@error('image') is-invalid @enderror"
                                accept="image/*" type="file" onchange="loadFile(event)" />
                            <img src="{{ Storage::url($user->image) ? Storage::url($user->image) : Storage::url('image/user-244-128.png') }}"
                                id="output" width="200" />
                        </div>
                        <div class="my-3 d-flex flex-column align-items-center text-center">
                            <span class="font-weight-bold">{{ $user->name }}</span>
                            <span class="text-black-50">{{ $user->email }}</span>
                        </div>
                    </div>
                    <div>
                       <a  id="" class="btn btn-primary" href="{{route('ordered')}}"
                            role="button">Order</a>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col"><label class="labels">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            </div>
                            <div class="col-md-12"><label class="labels">Address </label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="{{ $user->id }}">
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Save
                                Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
