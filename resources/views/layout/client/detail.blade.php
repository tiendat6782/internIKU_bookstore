@extends('templates.client.layout')
@section('content')
    <div class="container">
        <div class="card">
            @if (Session::has('success_rate'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Notification</strong> {{ Session::get('success_rate') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active text-center" id="pic-1"><img
                                    style="max-height: 500px ; width: auto" src="{{ Storage::url($book->image) }}" /></div>
                            <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        {{-- <h3 class="product-title">{{ $book->name }} - {{ $cate->name }}</h3> --}}
                        <p class="product-title">{{ $book->author }}</p>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">41 reviews</span>
                        </div>
                        <p class="product-description">{{ $book->description }}</p>
                        <h4 class="price">current price: <span>${{ $book->price }}</span></h4>
                        </p>
                        <div class="action">
                            <a class="add-to-cart btn btn-default" href="{{ route('addtocart', ['id' => $book->id]) }}">add
                                to
                                cart</a>
                            @if (Session::has('success'))
                                <div class="mt-2 alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#check-circle-fill" />
                                    </svg>
                                    <div>
                                        {{ Session::get('success') }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- product the same  --}}
        <div>

        </div>
        <div>
            <div class="rd-reviews">
                <h4>Reviews</h4>
                @foreach ($rate as $item)
                    <div class="review-item">
                        <div class="ri-pic">
                            <img src="{{ Storage::url($item->image) }}" alt="">
                        </div>
                        <div class="ri-text">
                            <span>{{ $item->created_at }}</span>

                            <div class="rating">
                                @for ($i = 0; $i < $item->rate; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" id="star" height="1.25em"
                                        viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            #star {
                                                fill: #ffc800
                                            }
                                        </style>
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                @endfor

                            </div>
                            <h5>{{ $item->name }}</h5>
                            <p>{{ $item->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($flag == true)
                <div class="review-add mb-5">
                    <form action="{{ route('rate') }}" class="ra-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="text-dark bg-white" placeholder="Name" disabled
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="text-dark bg-white" placeholder="Email" disabled
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center">
                                    <h5 class="my-2">You Rating:</h5>
                                    <div class="d-flex align-items-center">
                                        <input class="star star-5 " id="star-5" type="radio" value="5"
                                            name="star" />
                                        <label class="star star-5" for="star-5">5</label>
                                        <input class="star star-4  " id="star-4" type="radio" value="4"
                                            name="star" />
                                        <label class="star star-4 " for="star-4">4</label>
                                        <input class="star star-3  " id="star-3" type="radio"value="3" name="star" />
                                        <label class="star star-3" for="star-3">3</label>
                                        <input class="star star-2  " id="star-2" type="radio"value="2"
                                            name="star" />
                                        <label class="star star-2" for="star-2">2</label>
                                        <input class="star star-1  " id="star-1" type="radio"value="1"
                                            name="star" />
                                        <label class="star star-1" for="star-1">1</label>
                                    </div>
                                </div>
                                <input type="hidden" name="id_book" value="{{ $book->id }}">
                                <textarea name="content" placeholder="Your Review"></textarea>
                                <button class="rounded-3 " style="background-color: #3b5d50" type="submit">Submit
                                    Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>
@endsection
