@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header" style="background-color: #99A98F; font-family: Bebas Neue; text-align: center;">
                    <h1 style="color: white;">Dashboard</h1> <!-- Change header to 'Electricity' -->
                </div>
                <div class="card-body" style="background-color: #C1D0B5;">
                    <div class="text-center"> <!-- Centering everything -->
                        <div id="dataTableContainer">
                            {{ $dataTable->table(['class' => 'custom-datatable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('styles')
    <style>
        /* Centering column names */
        #dataTableContainer thead th {
            text-align: center;
        }

        /* Centering action buttons */
        #dataTableContainer tbody td .d-flex {
            justify-content: center;
        }

        .dataTables_scrollBody {
            overflow-x: scroll !important;
            overflow-y: hidden !important;
            position: absolute !important;
            bottom: 0 !important;
        }
    </style>
@endpush

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

