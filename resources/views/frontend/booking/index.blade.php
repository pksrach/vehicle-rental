@extends('frontend.layout.master')
@section('content')
    <section class="ftco-section ftco-cart" style="background-image: url('frontend/assets/images/bg_1.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table id="dataTableList" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody id="vehicleData" style="padding-left: 10px">
                                <!-- Data will be populated here by JavaScript -->
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
                <div class="mt-2" style="float: inline-end;">

                    <a href="{{ route('frontend.home') }}">
                        <button type="button" class="btn btn-danger" onclick="clearDataLocal()">Cancel</button>
                    </a>
                    @csrf
                    <!-- Add other form inputs here if necessary -->
                    <button type="submit" class="btn btn-primary" id="nextButton">Next</button>


                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve the vehicle data from localStorage
            const vehicleData = localStorage.getItem('selectedVehicle');

            // Parse the JSON string into a JavaScript object
            const vehicle = JSON.parse(vehicleData);

            // Check if vehicle data exists
            if (vehicle) {
                // Get the table body element
                const vehicleDataElement = document.getElementById('vehicleData');

                // Create a new table row
                const row = document.createElement('tr');

                // Insert table data into the row
                row.innerHTML = `
                    <td style="font-size: 12px;">${vehicle.name}</td>
                    <td style="font-size: 12px;">$${vehicle.price}</td>
                    <td style="font-size: 12px;">Brand Example</td>
                    <td style="font-size: 12px;">Category Example</td>
                    <td style="font-size: 12px;">Location Example</td>
                    <td><img src="frontend/assets/images/vehicle/${vehicle.image}" alt="Image" style="width: 100px; height: 100px;"></td>
                `;

                // Append the row to the table body
                vehicleDataElement.appendChild(row);
            } else {
                console.log('No vehicle data found in localStorage');
            }

        });

        function clearDataLocal() {
            localStorage.clear();
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nextButton').addEventListener('click', function() {

                // Retrieve data from local storage
                let selectedVehicle = localStorage.getItem('selectedVehicle');
                // Send data to Laravel backend via AJAX
                fetch('{{ route('frontend.booking.post') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            myData: selectedVehicle
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Data submitted successfully!');
                        } else {
                            alert('Failed to submit data.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
