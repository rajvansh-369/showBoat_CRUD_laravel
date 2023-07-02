@extends('adminLayouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">
                <h1>Add State</h1>

                <form action="{{ route('addState') }}" method="post">
                    @csrf
                    <label class="form-label" for="name">State</label>
                    <input class="form-control  mb-5" id="name" type="text" name="state">
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
                                <th style="width: 200px;">State</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $state)
                                <tr>
                                    <td style="width: 200px;">{{ $state->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
