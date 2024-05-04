@extends('backend.layouts.master')
@section('title', 'Vehicle Management')
@section('custom-style')
    <link href="{{asset('backend/assets/vendor/DataTables/datatables.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Vehicle</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disabledAnimation">
                    Create
                </button>
                @include('backend.vehicle.modal')
                <div class="card">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table id="dataTableList" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Attachment</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('dataTable')

@endsection
@section('myScript')
    <script>
        console.log('Hello from myScript in vehicle')
        $(document).ready(function () {
            $('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('backend.vehicles.index')}}",
                columns: [
                    {data: 'attachment', name: 'attachment'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'price', name: 'price'},
                    {data: 'brand', name: 'brand'},
                    {data: 'category', name: 'category'},
                    {data: 'location', name: 'location'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable: false}
                ],
                error: function (xhr, error, thrown) {
                    alert('An error occurred: ' + error + '\n' + thrown);
                }
            });
        });
    </script>

    {{--Create--}}
    <script>
        $(document).ready(function() {
            // When the form is submitted
            $('#disabledAnimation form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from being submitted normally

                var formData = new FormData(this); // Create a FormData object from the form

                $.ajax({
                    url: $(this).attr('action'), // The URL to send the request to
                    method: 'POST', // The HTTP method to use for the request
                    data: formData, // The data to send to the server
                    processData: false, // Tell jQuery not to process the data
                    contentType: false, // Tell jQuery not to set the contentType
                    success: function(response) {
                        // The request was successful
                        // You can update the UI here, for example, close the modal and refresh the data table
                        $('#disabledAnimation').modal('hide');
                        $('#dataTableList').DataTable().ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // The request failed
                        // You can handle the error here
                        console.error(textStatus, errorThrown);
                    }
                });
            });
        });

        function previewImgForCreate(event) {
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('img1');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            } else {
                console.log('No files selected');
            }
        }
    </script>
@endsection
