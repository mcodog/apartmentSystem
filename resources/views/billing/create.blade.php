@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color: #DBEAD2;">
                <div class="card-header" style="font-family: Bebas Neue; text-align: center;">
                    <h4>Create New Electricity Record</h4> <!-- Change header to 'Create New Electricity Record' -->
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ url('billing/store') }}" method="POST"> <!-- Update form action to electricity store route -->
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

                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('billing') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
