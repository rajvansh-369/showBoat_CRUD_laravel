@extends('adminLayouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">



            @foreach ($getFormData as $data)
                <div class="col-md-3 mb-5">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/'.$data->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data->name }}</h5>
                            <p class="card-text">{{ $data->email }}</p>

                            <ul>
                                <li>{{ $data->formDetail->pan }}</li>
                                <li>{{ $data->formDetail->aadhar }}</li>
                                <li>{{ $data->formDetail->address }}</li>
                            </ul>
                            <a href="{{route('adminEdit', $data->id)}}" class="btn btn-success">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
