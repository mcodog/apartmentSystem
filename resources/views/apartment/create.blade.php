@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color: #DBEAD2;">
                <div class="card-header" style="font-family: Bebas Neue; text-align: center;">
                    <h4>Create New Apartment Record</h4> <!-- Change header to 'Create New Apartment Record' -->
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ url('apartment/store') }}" method="POST"> <!-- Update form action to apartment store route -->
                        @csrf
                        <div class="form-group">
                            <label for="tenant_id">Tenant</label>
                            <select class="form-control" id="tenant_id" name="tenant_id" required>
                                <option value="">Select Tenant</option> <!-- Add an empty option -->
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="rental_fee">Rental Fee</label>
                            <input type="number" class="form-control" id="rental_fee" name="rental_fee" required>
                        </div>
                        <div class="form-group">
                            <label for="date_occupied">Date Occupied</label>
                            <input type="date" class="form-control" id="date_occupied" name="date_occupied" required>
                        </div>
                        <div class="form-group">
                            <label for="last_payment">Last Payment</label>
                            <input type="date" class="form-control" id="last_payment" name="last_payment" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('apartment') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
