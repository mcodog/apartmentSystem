@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color: #DBEAD2;">
                <div class="card-header" style="font-family: Bebas Neue; text-align: center;">
                    <h4>Edit Water Record</h4> <!-- Change header to 'Edit Water Record' -->
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ url('water/update', $water->id) }}" method="POST"> <!-- Update form action to water update route -->
                        @csrf
                        @method('PUT') <!-- Add method field for PUT request -->
                        <div class="form-group">
                            <label for="tenant_id">Tenant</label>
                            <select class="form-control" id="tenant_id" name="tenant_id" required>
                                <option value="">Select Tenant</option> <!-- Add an empty option -->
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->id }}" {{ $tenant->id == $water->tenant_id ? 'selected' : '' }}>{{ $tenant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $water->date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="total_head">Total Head</label>
                            <input type="text" class="form-control" id="total_head" name="total_head" value="{{ $water->total_head }}" required>
                        </div>
                        <div class="form-group">
                            <label for="amount_per_head">Amount per Head</label>
                            <input type="text" class="form-control" id="amount_per_head" name="amount_per_head" value="{{ $water->amount_per_head }}" required>
                        </div>
                        <div class="form-group">
                            <label for="amount_due">Total Due</label>
                            <input type="number" class="form-control" id="amount_due" name="amount_due" value="{{ $water->amount_due }}" readonly>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('water') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
