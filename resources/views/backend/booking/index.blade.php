@extends('backend.layouts.master')
@section('title', 'Booking Management')
@section('custom-style')
    <link href="{{asset('backend/assets/vendor/DataTables/datatables.css')}}" rel="stylesheet">
@endsection
@section('content')
    @include('components.alert')
    <div class="pagetitle">
        <h1>Booking</h1>
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
            @component('components.alert')
            @endcomponent
            <div class="modal" tabindex="-1" id="errorModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Error</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="errorMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#disabledAnimation">
                    Create
                </button>
                {{--@include('backend.booking.modal')--}}
                <div class="card">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table id="dataTableList" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Pickup Date</th>
                                <th>Complete Date</th>
                                <th>Customer</th>
                                <th>Staff</th>
                                <th>Payment Method</th>
                                <th>Action</th>
{{--                                <th>Details</th>--}}
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


@section('myScript')
    <script>
        validateNumberInput('amount', true);
        $(document).ready(function() {
            var table = $('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('backend.bookings.index')}}",
                columns: [
                    {data: 'status', name: 'status'},
                    {data: 'amount', name: 'amount'},
                    {data: 'pickup_date', name: 'pickup_date'},
                    {data: 'complete_date', name: 'complete_date'},
                    {data: 'customer', name: 'customer'},
                    {data: 'staff', name: 'staff'},
                    {data: 'payment_method', name: 'payment_method'},
                    {data: 'action', name: 'action', orderable: false},
                    {data: 'booked_details', name: 'booked_details', orderable: false, visible: false}, // Hide this column
                ],
                error: function (xhr, error, thrown) {
                    alert('An error occurred: ' + error + '\n' + thrown);
                }
            });

            // Add event listener for opening and closing details
            $('#dataTableList tbody').on('click', 'tr', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(row.data().booked_details).show();
                    tr.addClass('shown');
                }
            });
        });

        /*$(document).ready(function () {
            $('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('backend.bookings.index')}}",
                columns: [
                    {data: 'status', name: 'status'},
                    {data: 'amount', name: 'amount'},
                    {data: 'pickup_date', name: 'pickup_date'},
                    {data: 'complete_date', name: 'complete_date'},
                    {data: 'customer', name: 'customer'},
                    {data: 'staff', name: 'staff'},
                    {data: 'payment_method', name: 'payment_method'},
                    {data: 'action', name: 'action', orderable: false},
                    // {data: 'booked_details', name: 'booked_details', orderable: false},
                ],
                error: function (xhr, error, thrown) {
                    alert('An error occurred: ' + error + '\n' + thrown);
                }
            });
        });*/
    </script>

    {{--Preview Image--}}
    <script>
        function previewImg(event) {
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('img1');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            } else {
                console.log('No files selected');
            }
        }
    </script>

    {{--Create--}}
    <script>
        // Check if the modal is opened by the 'Create' button
        // If so, clear all inputs and selects in the modal
        $(document).ready(function () {
            $('.btn-primary[data-bs-toggle="modal"]').on('click', function () {
                var submitButton = $('#submitButton');
                if (submitButton.text() === 'Update') {
                    // Clear all inputs and selects in the modal
                    $('#disabledAnimation').find('input[type="text"], textarea, select').val('');
                    // Clear file input
                    $('#disabledAnimation').find('input[type="file"]').val('');
                    // Reset the image preview
                    $('#img1').attr('src', '');
                    // Reset the 'Active' select to its default value
                    $('#active').val('1');
                    // Reset the submit button text to 'Create'
                    submitButton.text('Create');
                    // Reset the modal title
                    $('#modalTitle').text('Create New');
                }
            });
        });

        $('#disabledAnimation form').on('submit', function (e) {
            e.preventDefault();

            // Clear previous error messages
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#disabledAnimation').modal('hide');
                    $('#dataTableList').DataTable().ajax.reload();

                    // Show the success message in the modal
                    $('#successModal').find('.modal-body').text(response.success);
                    $('#successModal').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status === 422) { // When status code is 422, it's a validation issue
                        console.log(jqXHR.responseJSON);
                        // Display errors on each form field
                        var errors = jqXHR.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).after('<div class="invalid-feedback">' + value + '</div>');
                        });
                        $('#disabledAnimation').modal('show');
                    } else {
                        // Hide the create modal
                        $('#disabledAnimation').modal('hide');

                        // Show the error message in the modal
                        $('#errorModal').find('.modal-body').text(jqXHR.responseJSON.error);
                        $('#errorModal').modal('show');
                        console.error(textStatus, errorThrown);
                    }
                }
            });
        });
    </script>

    {{--Edit--}}
    <script>
        $(document).ready(function () {
            $('#dataTableList').on('click', '.editRoom', function () {
                var table = $('#dataTableList').DataTable();
                var data = table.row($(this).parents('tr')).data(); // Get the data for the row

                // Extract the image URL from the 'attachment' field
                var imageUrl = $(data.attachment).attr('src');
                // Check if the image URL is 'no_img'
                if (imageUrl === 'no_img.jpg') {
                    imageUrl = ''; // Set the image URL to an empty string
                }

                // Extract the checked status from the 'is_active' field
                var isActive = $(data.is_active).prop('checked') ? '1' : '0';

                // Populate the modal with the data
                $('#id').val(data.id)
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#brand').val(data.brand_id); // Set the value to the brand ID
                $('#category').val(data.category_id); // Set the value to the category ID
                $('#location').val(data.location_id); // Set the value to the location ID
                // Set the value of the 'active' select element
                $('#active').val(isActive);
                // Set the image source
                $('#img1').attr('src', imageUrl);

                // Change the modal title and submit button text
                $('#modalTitle').text('Update Booking');
                $('#submitButton').text('Update');

                // Show the modal
                $('#disabledAnimation').modal('show');
            });
        });
    </script>

    <script>
        @if ($errors->any())
        $('#disabledAnimation').modal('show');
        @endif
    </script>
@endsection