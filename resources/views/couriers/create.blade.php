@extends('be.master')
@section('menu')
    @include('be.menu')
@endsection
@section('couriers')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">{{ $title }}</h6>
            </nav>
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Add New {{ $title }} Data</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('couriers.store') }}" method="POST" id="frm">
                            @csrf
                            <div class="row ms-3 me-3">
                                <div class="col-12">
                                    <div class="mb-3 px-3 pt-3">
                                        <label for="name" class="form-label">Courier Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Courier Name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="mb-3 px-3 pt-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
                                    </div>
                                    <div class="mb-3 px-3 pt-3">
                                        <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                        <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="e.g. Motor, Mobil" value="{{ old('vehicle_type') }}">
                                    </div>
                                    <div class="mb-3 px-3 pt-3">
                                        <label for="license_plate" class="form-label">License Plate</label>
                                        <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="Enter License Plate" value="{{ old('license_plate') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row ms-3 me-3 mt-3">
                                <div class="col-12">
                                    <div class="px-3 pb-3 text-end">
                                        <a href="{{ route('couriers.index') }}" class="btn bg-gradient-secondary me-3">Cancel</a>
                                        <button type="submit" class="btn bg-gradient-primary"> Save New {{ $title }} Data </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
