@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5">


        <form class="row g-3" id="myForm" method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name">
                <p id="nameError" class="error-message" style="display: none;"></p>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" name="image" id="image">
                <p id="imageError" class="error-message" style="display: none;"></p>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email">
                <p id="emailError" class="error-message" style="display: none;"></p>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label for="inputState" class="form-label">State</label>
                <select id="stateSelect" name="state" class="form-select" required>
                    <option value="">Select State</option>
                    @foreach ($states as $state)
                        <option {{ old('state') == $state->id ? 'selected' : '' }} value="{{ $state->id }}">
                            {{ $state->name }}</option>
                    @endforeach

                </select>
                <p id="stateError" class="error-message" style="display: none;"></p>
                @error('state')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label for="inputState" class="form-label">District</label>
                <select id="districtSelect" name="district" class="form-select" required>
                    <option value="">Select District</option>
                </select>
                <p id="districtError" class="error-message" style="display: none;"></p>
                @error('district')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">


                <label for="addressSelect" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="addressSelect"
                    placeholder="1234 Main St">
                <p id="addressError" class="error-message" style="display: none;"></p>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="aadhaarInput" class="form-label">Aadhar Card</label>
                <input type="text" class="form-control" value="{{ old('aadhaar') }}" name="aadhaar" id="aadhaarInput">
                <p id="aadhaarError" class="error-message" style="display: none;"></p>
                @error('aadhaar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-md-4">
                <label for="panInput" class="form-label">PAN Card</label>
                <input type="text" class="form-control"value="{{ old('pan') }}" name="pan" id="panInput">
                <p id="panError" class="error-message" style="display: none;"></p>
                @error('pan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
            @if (session('message'))
                <p class="text-success">{{ session('message') }}</p>
            @endif
        </form>

    </div>

    <script>
        var error = 0;
        $('#stateSelect').on('change', function() {
            var stateId = $(this).val();
            getDistrictsByStateId(stateId);
        });


        function getDistrictsByStateId(stateId) {
            $.ajax({
                url: '/get-districts/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    var selectDistrict = $('#districtSelect');
                    selectDistrict.empty();
                    selectDistrict.prepend('<option value="0">Select District</option>');

                    $.each(response, function(index, district) {
                        var option = $('<option>').val(district.id).text(district.name);
                        selectDistrict.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }



        function validatePAN(panNumber) {
            var panRegex = /^([A-Z]{5})(\d{4})([A-Z]{1})$/;
            var formattedPAN = panNumber.toUpperCase().replace(/[^A-Z\d]/g, '');

            if (panRegex.test(formattedPAN)) {
                return formattedPAN.replace(panRegex, "$1$2$3");
            } else {
                return false;
            }
        }


        function validateAadhaar(aadhaarNumber) {
            var aadhaarRegex = /^\d{4}-\d{4}-\d{4}$/;

            if (aadhaarRegex.test(aadhaarNumber)) {
                return true;
            } else {
                return false;
            }
        }





        panInput.addEventListener("change", function() {
            var panValue = panInput.value;
            var formattedPAN = validatePAN(panValue);

            if (formattedPAN) {
                panInput.classList.add("valid-pan");
                panInput.classList.remove("invalid-pan");
                panInput.value = formattedPAN;
                console.log("Valid PAN: " + formattedPAN);
            } else {
                panInput.classList.remove("valid-pan");
                panInput.classList.add("invalid-pan");
                error++;

                console.log("Invalid PAN");
                console.log(error);
            }
        });




        aadhaarInput.addEventListener("input", function() {
            var inputValue = aadhaarInput.value;
            var formattedValue = inputValue.replace(/[^0-9]/g, "").slice(0, 12);

            var formattedAadhaar = "";
            for (var i = 0; i < formattedValue.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedAadhaar += "-";
                }
                formattedAadhaar += formattedValue[i];
            }

            aadhaarInput.value = formattedAadhaar;
            console.log(formattedAadhaar);
            if (validateAadhaar(formattedAadhaar)) {
                aadhaarInput.classList.add("valid-aadhaar");
                aadhaarInput.classList.remove("invalid-aadhaar");
                console.log("Valid Aadhaar: " + formattedAadhaar);
            } else {
                aadhaarInput.classList.remove("valid-aadhaar");
                aadhaarInput.classList.add("invalid-aadhaar");
                console.log("Invalid Aadhaar");
            }
        });

        function validateFileExtension() {
            var fileInput = document.getElementById("image");
            var filePath = fileInput.value;
            var validExtensions = ["png", "jpg", "PNG", "JPG"];
            var fileExtension = filePath.split(".").pop().toLowerCase();
            console.log(validExtensions.includes(fileExtension));

            return validExtensions.includes(fileExtension);
        }

        var fileInput = document.getElementById("image");
        fileInput.addEventListener("change", function() {
            var file = fileInput.files[0];


            if (validateFileExtension()) {
                var imageError = document.getElementById("imageError");
                imageError.style.display = "none";
                fileInput.classList.add("valid-image");
                fileInput.classList.remove("invalid-image");
                return;
            } else {
                fileInput.classList.remove("valid-image");
                fileInput.classList.add("invalid-image");
                console.log("Please select a PNG or JPG image file.");
            }
            // ... any additional logic or actions for a valid image file
        });
        var form = document.getElementById("myForm");

        form.addEventListener("submit", function(event) {
            event.preventDefault(); // P

            var name = document.getElementById("name"); // Example input for validation
            var fileInput = document.getElementById("image");
            var emailInput = document.getElementById("email"); // Example input for validation
            var stateInput = document.getElementById("stateSelect"); // Example input for validation
            var districtInput = document.getElementById("districtSelect"); // Example input for validation
            var addressInput = document.getElementById("addressSelect"); // Example input for validation
            var panInput = document.getElementById("panInput");
            var aadhaarInput = document.getElementById("aadhaarInput");





            // Clear previous error messages
            var errorMessages = document.getElementsByClassName("error-message");
            for (var i = 0; i < errorMessages.length; i++) {
                errorMessages[i].style.display = "none";
            }

            // Perform form validation
            var hasErrors = false;


            if (name.value.trim() === "") {

                console.log("adasd");
                var errorName = document.getElementById("nameError");
                errorName.innerHTML = "Please enter Name."
                errorName.style.display = "block";
                errorName.style.color = "red";
                hasErrors = true;
            }


            if (districtInput.value.trim() === "0") {

                console.log("adasd");
                var errorDistrict = document.getElementById("districtError");
                errorDistrict.innerHTML = "Please Select District."
                errorDistrict.style.display = "block";
                errorDistrict.style.color = "red";
                hasErrors = true;
            }

            var file = fileInput.files[0];

            // if (!file) {
            //     // File is empty
            //     var imageError = document.getElementById("imageError");
            //     imageError.innerHTML = "Please select Image";
            //     imageError.style.display = "block";
            //     imageError.style.color = "red";
            //     hasErrors = true;
            //     // console.log("Please select an image file.");

            // }

            if (!validateAadhaar(aadhaarInput.value)) {
                var aadhaarError = document.getElementById("aadhaarError");
                aadhaarError.innerHTML = "Please enter a valid Aadhaar number."
                aadhaarError.style.display = "block";
                aadhaarError.style.color = "red";
                hasErrors = true;
            }


            // if (!validateFileExtension()) {
            //     var imageError = document.getElementById("imageError");
            //     imageError.innerHTML = "Please enter a valid Image"
            //     imageError.style.display = "block";
            //     imageError.style.color = "red";
            //     hasErrors = true;
            // }

            if (!validatePAN(panInput.value)) {
                var panError = document.getElementById("panError");
                panError.innerHTML = "Please enter a valid PAN number."
                panError.style.display = "block";
                panError.style.color = "red";
                hasErrors = true;
            }

            // Submit the form if no errors
            if (!hasErrors) {
                form.submit();
            }
        });
    </script>
@endsection
