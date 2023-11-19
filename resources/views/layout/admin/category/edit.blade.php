@extends('templates.admin.layout')
@section('content')
    <div class="container-fluid p-2 border border-2 border-white rounded-2 my-5">
        <form class="row g-3" action="{{ route('edit_category',['id'=>$category->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputAddress" name="name" value="{{ $category->name }}">
                    @if ($errors->has('name'))
                        <p><small class="px-2 text-danger">{{ $errors->first('name') }}</small></p>
                    @endif
                </div>
                <div class="col-12">
                    <label for="image" class="form-label">File Image</label>
                    <input type="file" class="@error('image') is-invalid @enderror form-control" name="image"
                        id="image" accept="image/*">
                </div>
                <div class="col-md-6 my-2">
                    <img id="image_preview" style="width: 300px ; height:150px" src="{{ Storage::url($category->image) }}"
                        alt="User">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Descrition</label>
                        <textarea class="form-control" name="description" id="" rows="4">{{ $category->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
