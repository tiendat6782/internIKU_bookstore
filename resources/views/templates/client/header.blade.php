<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TienDatShop<span></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                <li><a class="nav-link" href="{{route('blog')}}">Blog</a></li>
                <li><a class="nav-link" href="{{route('contact')}}">Contact us</a></li>
            </ul>
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">

                @if (Auth::user())
                    <li><a class="nav-link" href="{{route('profiles_client')}}"> <img style="height: 25px; width: 25px;" class="rounded-circle"
                                src="{{ Storage::url(Auth::user()->image) }}" class="img-fluid" alt="Updating"></a>
                    </li>
                @else
                    <a class="nav-link" href="{{ route('login') }}"><img
                            src="{{ asset('assets/images/user.svg') }}"></a>
                @endif

                <li><a class="nav-link" href="{{ route('getCart') }}"><img
                            src="{{ asset('assets/images/cart.svg') }}"></a></li>
                @if (Auth::user())
                    <li><a class="nav-link" href="{{ route('logout') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                height="1.5em"
                                viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <style>
                                    svg {
                                        fill: #fafafa
                                    }
                                </style>
                                <path
                                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                            </svg></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
