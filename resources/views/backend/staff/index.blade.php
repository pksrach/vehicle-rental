@extends('backend.layouts.master')
@section('title', 'Staff Management')
@section('custom-style')
    <link href="{{asset('backend/assets/vendor/DataTables/datatables.css')}}" rel="stylesheet">
@endsection
@section('content')
    @include('components.alert')
    <div class="pagetitle">
        <h1>Staff</h1>
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
                {{--                @include('backend.customer.modal')--}}
                <div class="card">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table id="dataTableList" class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Attachment</th>
                                <th>Fist Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th>Date Of Birth</th>
                                <th>Phone</th>
                                <th>Hire Date</th>
                                <th>Salary</th>
                                <th>Address</th>
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


@section('myScript')
    <script>
        $(document).ready(function () {
            $('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('backend.staffs.index')}}",
                columns: [
                    {data: 'attachment', name: 'attachment'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'role', name: 'role'},
                    {data: 'date_of_birth', name: 'date_of_birth'},
                    {data: 'phone', name: 'phone'},
                    {data: 'hire_date', name: 'hire_date'},
                    {data: 'salary', name: 'salary'},
                    {data: 'address', name: 'address'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable: false}
                ],
                error: function (xhr, error, thrown) {
                    alert('An error occurred: ' + error + '\n' + thrown);
                }
            });
        });
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
                // Set the image source
                $('#img1').attr('src', imageUrl);

                // Change the modal title and submit button text
                $('#modalTitle').text('Update Vehicle');
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
