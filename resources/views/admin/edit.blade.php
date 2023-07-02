@extends('adminLayouts.app')
@section('content')
    <form action="{{ route('update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationServer01">First name</label>
                <input type="text" class="form-control " id="validationServer01" name="name" placeholder="First name"
                    value="{{ $data->name }}" required>

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control " id="email" name="email" placeholder="abc@email.com"
                    value="{{ $data->email }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-md-6 mt-2">
                <img class="mb-2" src="{{ asset('storage/' . $data->image) }}" alt="" width="200px">
            </div>
            <div class=" custom-file">


                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                <input type="file" class="custom-file-input" name="image" id="validatedCustomFile">
            </div>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="stateSelect" name="state" class="form-control">
                    <option selected>Choose...</option>
                    @foreach ($states as $state)
                        <option {{ $data->formDetail->district->state->id == $state->id ? 'selected' : '' }}
                            value="{{ $state->id }}">
                            {{ $state->name }}</option>
                    @endforeach
                </select>
                @error('state')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {{-- {{dd($data->formDetail->district->state)}} --}}
            <div class="col-md-3 mb-3">
                <label for="validationServer04">District</label>
                <select id="districtSelect" name="district" class="form-control">
                    <option selected>Choose...</option>
                    @foreach ($districts as $district)
                        <option {{ $data->formDetail->district_id == $district->id ? 'selected' : '' }}
                            value="{{ $district->id }}">
                            {{ $district->name }}</option>
                    @endforeach
                </select>
                @error('district')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class=" col-md-6 mb-3">
                <label for="validationTextarea">Textarea</label>
                <textarea class="form-control" name="address" id="validationTextarea" placeholder="Required example textarea" required>{{ $data->formDetail->address }}</textarea>

            </div>
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @php
            $string = $data->formDetail->aadhar;
            $chunks = str_split($string, 4);
            $formattedaadhar = implode('-', $chunks);
        @endphp
        <div class="form-row">

            <div class="col-md-6 mb-3">
                <label for="aadhaarInput">Aadhar No</label>
                <input type="text" class="form-control " id="aadhaarInput" name="aadhaar" placeholder="Last name"
                    value="{{ $formattedaadhar }}" required>
                @error('aadhaar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-md-6 mb-3">
                <label for="panInput">Pan No</label>
                <input type="text" class="form-control " id="panInput" name="pan" placeholder="Last name"
                    value="{{ $data->formDetail->pan }}" required>
                @error('pan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>

        <button class="btn btn-primary" type="submit">Submit form</button>
        @if (session('message'))
            <p class="text-success">{{ session('message') }}</p>
        @endif
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



    <script>
        function getDistrictsByStateId(stateId) {
            jQuery.ajax({
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

        $(document).ready(function() {
            $('#stateSelect').on('change', function() {
                var stateId = $(this).val();
                getDistrictsByStateId(stateId);
            });



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

            var panInput = document.getElementById("panInput");
            var aadhaarInput = document.getElementById("aadhaarInput");


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

        });
    </script>
@endsection
