@include('backend.layouts.header')

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">

                            <a href="{{ route('front.register') }}" class=" d-flex align-items-center w-auto">
                                <img src="{{ asset('logo.png') }}" width="150" alt="logo">
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Register to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to Register</p>
                                </div>

                                <form method="post" class="row g-3 needs-validation" action="{{ route('front.register.post') }}" id="myForm">
                                    @csrf
                                    <div class="col-12">
                                      <label for="username" class="form-label">Username</label>
                                      <div class="input-group has-validation">
                                        <input type="text" name="username" class="form-control" id="username" required>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <label for="email" class="form-label">Email</label>
                                      <div class="input-group has-validation">
                                        <input type="text" name="email" class="form-control" id="email" required>
                                        <div class="invalid-feedback">Please enter your email.</div>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <label for="password" class="form-label">Password</label>
                                      <input type="password" name="password" class="form-control" id="password" required>
                                      <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                      <label for="confirmPassword" class="form-label">Confirm Password</label>
                                      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                      <div class="invalid-feedback">Please confirm your password!</div>
                                    </div>
                                    <div class="col-12">
                                      <button class="btn btn-primary w-100" type="submit">Register</button>
                                    </div>
                                  </form>
                                  

                            </div>
                        </div>

                        <div class="credits">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                            Designed by <a href="https://www.setecu.com/">SS5 Semester 2</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main>
<script>
    const form = document.getElementById("myForm");

    // Using event listener (recommended)
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const nameValue = formData.get("username");
        const emailValue = formData.get("email");
        const passwordValue = formData.get("password");
        const confirmPasswordValue = formData.get("password_confirmation");
        console.log("Name:", nameValue);
        console.log("Email:", emailValue);
        console.log("Password:", passwordValue);
        console.log("Confirm Password:", confirmPasswordValue);
    });
</script>
