@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">
                    <h1>Tenants</h1>
                </div>
                <div class="card-body">     
                    {{ $dataTable->table() }}
                    <a class="btn btn-success" href="employee/create">Create New</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush