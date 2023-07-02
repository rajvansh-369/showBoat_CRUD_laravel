<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5"
            style="background-image: url({{ asset('storage/logo.jpg') }});"></a>
        <ul class="list-unstyled components mb-5">

            <li class="{{ Route::currentRouteName() == 'adminIndex' ? 'active' : '' }}">
                <a href="{{ route('adminIndex') }}">Home</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'datable' ? 'active' : '' }}">
                <a href="{{ route('datable') }}">Ajax Data Table</a>
            </li>


            <li class="{{ Route::currentRouteName() == 'adminState' ? 'active' : '' }}">
                <a href="{{ route('adminState') }}">Add State</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'adminDistrict' ? 'active' : '' }}">
                <a href="{{ route('adminDistrict') }}">Add District</a>
            </li>
            <li>
                <a target="_snehal" href="http://snehal.info/">Portfolio (Snehal.info)</a>
            </li>
        </ul>

    </div>
</nav>

<div id="content" class="p-4 p-md-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="{{ Route::currentRouteName() == 'adminIndex' ? 'active' : '' }}">
                        <a href="{{ route('adminIndex') }}">Home</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'datable' ? 'active' : '' }}">
                        <a href="{{ route('datable') }}">Ajax Data Table</a>
                    </li>


                    <li class="{{ Route::currentRouteName() == 'adminState' ? 'active' : '' }}">
                        <a href="{{ route('adminState') }}">Add State</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'adminDistrict' ? 'active' : '' }}">
                        <a href="{{ route('adminDistrict') }}">Add District</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
