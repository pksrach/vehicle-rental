@include('backend.layouts.header')

<main>
    <div class="container">
        <section class="section error min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <h1 class="text-center">Database Error</h1>
                        <p class="text-center">There was a problem connecting to the database. Please try again later.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@include('backend.layouts.footer')
