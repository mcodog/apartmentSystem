@extends('layouts.master')

@section('content')
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Tenant Record</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ url('/tenants/' . $tenant->id . '/update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $tenant->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $tenant->phone_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="{{ $tenant->emergency_contact_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="emergency_contact_number">Emergency Contact Number</label>
                                <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" value="{{ $tenant->emergency_contact_number }}" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('tenants') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
