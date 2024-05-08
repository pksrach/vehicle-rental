@extends('frontend.layout.master')
@section('content')
    <section class="ftco-section ftco-cart" style="background-image: url('frontend/assets/images/bg_1.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="col-lg-12 ">
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation">
                    Create
                </button>
                @include('backend.vehicle.modal') --}}
                    <div class="card">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table id="dataTableList" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Attachment</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
                <div class="mt-2  " style=" float: inline-end;">
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <button type="button" class="btn btn-primary">Next</button>
                </div>
            </div>

        </div>  
    </section>
@endsection
