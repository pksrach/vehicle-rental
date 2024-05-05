<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('frontend.home') }}">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('frontend.home') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('frontend.about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('frontend.service') }}" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="{{ route('frontend.pricing') }}" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="{{ route('frontend.car') }}" class="nav-link">Cars</a></li>
                <li class="nav-item"><a href="{{ route('frontend.blog') }}" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="{{ route('frontend.contact') }}" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="{{ route('frontend.contact') }}" class="nav-link"><svg
                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none">
                                <path fill="#ffffff"
                                    d="M3 1.75a1.25 1.25 0 1 0 0 2.5zM5 3l1.246-.096A1.25 1.25 0 0 0 5 1.75zm16 3l1.242.138A1.25 1.25 0 0 0 21 4.75zM5.23 6l-1.246.096zm13.109 9.119l.089 1.247zm-10.355.74l-.089-1.248zM3 4.25h2v-2.5H3zm5.073 12.855l10.355-.74l-.178-2.493l-10.355.74zm13.353-3.622l.816-7.345l-2.484-.276l-.816 7.345zM3.754 3.096l.23 3l2.493-.192l-.23-3zm.23 3l.617 8.017l2.493-.192l-.617-8.017zM21 4.75H5.23v2.5H21zm-2.572 11.616a3.25 3.25 0 0 0 2.998-2.883l-2.484-.276a.75.75 0 0 1-.692.665zM7.895 14.61a.75.75 0 0 1-.801-.69l-2.493.192a3.25 3.25 0 0 0 3.472 2.992z">
                                </path>
                                <path stroke="#ffffff" stroke-linejoin="round" stroke-width="3.75"
                                    d="M8.5 20.5h.01v.01H8.5zm9 0h.01v.01h-.01z"></path>
                            </g>
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('frontend.contact') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="#ffffff"
                                d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z">
                            </path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
