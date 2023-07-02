@extends('adminLayouts.app')
@section('content')
    <table  id="myTable" class=" table cell-border compact stripe">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>PAN</th>
                <th>Aadhar</th>
                <th>Address</th>
                <th>Action</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- The table rows will be dynamically populated here -->
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script> --}}


    <script>
     $(document).ready(function() {
    $('#myTable').DataTable({
        ajax: {
            url: '{{ route('formdata.index') }}',
            dataSrc: ''
        },
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'name', title: 'Name' },
            { data: 'email', title: 'Email' },
            {
                data: 'image',
                title: 'Image',
                render: function(data) {
                    return '<img src="' + @json(asset('storage/'))+"/" + data + '" alt="Image" width="50">';
                }
            },
            { data: 'form_detail.pan', title: 'Pan' },
            { data: 'form_detail.aadhar', title: 'Aadhar' },
            { data: 'form_detail.address', title: 'Address' },
            {
                data: null,
                title: 'Action',
                render: function(data) {
                    return   '<a href="' + @json(url('/admin/edit'))+'/' + data.id + '">' +
                        '<button class="btn btn-primary mx-1 btn-sm edit-btn" data-id="' + data.id + '">Edit</button></a>' +
                        '<a href="' + @json(url('/admin/delete'))+'/' + data.id + '">' +  '<button class="btn btn-danger btn-sm delete-btn" data-id="' + data.id + '">Delete</button></a>';
                }
            }
        ]
    });
});

    </script>
@endsection
