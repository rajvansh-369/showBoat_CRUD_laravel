@extends('adminLayouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">
                <h1>Add State</h1>

                <form action="{{ route('addDistrict') }}" method="post">
                    @csrf
                    <select id="stateSelect" name="state" class="form-control">
                        <option value="">Choose State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    <label class="form-label mt-3" for="name">District</label>
                    <input class="form-control  mb-5" type="text" name="name">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror


                    <input class="form-control " type="submit" value="Submit">
                    @if (session('message'))
                        <p class="text-success">{{ session('message') }}</p>
                    @endif

                </form>

            </div>
            <div class="col-md-6">

                <div style="height: 400px; overflow-y: scroll;">
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 200px;">District</th>
                                <th style="width: 200px;">State</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($districts as $district)
                                <tr>
                                    <td style="width: 200px;">{{ $district->name }}</td>
                                    <td style="width: 200px;">{{ $district->state->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
