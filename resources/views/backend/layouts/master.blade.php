@include('backend.layouts.header')
@include('backend.layouts.heading')
@include('backend.layouts.sidebarmenu')

<main id="main" class="main">
    @yield('content')
</main>

@include('backend.layouts.footer')
