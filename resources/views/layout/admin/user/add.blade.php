@extends('templates.admin.layout')
@section('content')
<div class="container-fluid p-2 border border-2 border-white rounded-2">
    <form class="row g-3" action="{{ route('insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="inputname4" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputname4" name="name">
            @if ($errors->has('name'))
                <p><small class="px-2 text-danger">{{ $errors->first('name') }}</small></p>
            @endif

        </div>
        <div class="col-md-6">
            <label for="inputphone4" class="form-label">Phone</label>
            <input type="text" class="form-control" id="inputphone4" name="phone">
            @if ($errors->has('phone'))
                <p><small class="px-2 text-danger">{{ $errors->first('phone') }}</small></p>
            @endif
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="address">
            @if ($errors->has('address'))
                <p><small class="px-2 text-danger">{{ $errors->first('address') }}</small></p>
            @endif
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputAddress2" name="email">
            @if ($errors->has('email'))
                <p><small class="px-2 text-danger">{{ $errors->first('email') }}</small></p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="inputusername4" class="form-label">Username</label>
            <input type="text" class="form-control" id="inputusername4" name="username">
            @if ($errors->has('username'))
                <p><small class="px-2 text-danger">{{ $errors->first('username') }}</small></p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="inputpass4" class="form-label">Password</label>
            <input type="text" class="form-control" id="inputpass4" name="password">
            @if ($errors->has('password'))
                <p><small class="px-2 text-danger">{{ $errors->first('password') }}</small></p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">File Image</label>
            <input type="file" class="@error('image') is-invalid @enderror form-control" name="image"
                id="image" accept="image/*">
        </div>
        <div class="col-md-6">
            <img id="image_preview" style="width: 200px ; height:100px"
                src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="User">
        </div>
        <div class="col-md-6">
            @foreach ($role as $item)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="inlineRadio{{$item->id}}" value="{{$item->id}}">
                <label class="form-check-label" for="inlineRadio{{$item->id}}">
                    {{$item->name}}</label>
            </div>
            @endforeach
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Add user</button>
        </div>
    </form>
</div>
@endsection
