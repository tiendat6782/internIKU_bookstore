<nav
    class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
    <div class="container-fluid pe-0">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="">
            DT DashBoard
        </a>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{route('login')}}">
                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                        Sign in
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="">
                        Forget Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{route('register')}}">
                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                        Sign up
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{route('home')}}">
                        <i class="fa-solid fa-house" style="color: #acb3be;"></i>
                        Home
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
