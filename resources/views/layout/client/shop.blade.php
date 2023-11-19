@extends('templates.client.layout')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form id="frmSearch" action="{{ route('shop') }}" role="form" method="POST" class="was-validated">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-3 text-start">
                                <select ID="ddlType" name="keyCate" Class="form-control rounded">
                                    <option value="" selected>Category ....</option>
                                    @foreach ($cate as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 d-flex">
                                <input type="text" ID="tbTerm" name="keyBook" placeholder="Name Book"
                                    class="form-control rounded text-black" />
                            </div>
                            <div class="col-lg-4 d-flex">
                                <input type="text" ID="tbTerm" name="keyAuthor" placeholder="Name Author"
                                    class="form-control rounded text-black" />
                            </div>
                            <div class="col-lg-1 mx-auto">
                                <button type="submit" ID="btnSearch" class="btn-success btn text-white">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
        <div class="untree_co-section product-section before-footer-section">
            <div class="container">
                <div class="row">
                    @foreach ($book as $item)
                        <div class="col-12 col-md-4 col-lg-3 mb-5">
                            <a class="product-item" href="{{ route('detail', ['id' => $item->id]) }}">
                                <img style="height: 300px" src="{{ Storage::url($item->image) }}"
                                    class="img-fluid product-thumbnail">
                                <h3 class="product-title">{{ $item->name }}</h3>
                                <strong class="product-price">{{ $item->price }} VND </strong>

                                <span class="icon-cross">
                                    <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex justify-content-center">
            <div class="room-pagination">
                {{ $book->links() }}
            </div>
        </div>
@endsection
