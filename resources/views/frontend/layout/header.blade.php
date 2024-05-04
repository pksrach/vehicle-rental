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
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
