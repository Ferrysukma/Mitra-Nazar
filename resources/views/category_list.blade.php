@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.category_coordinator') }}</h1>
                        <p>{{ __('all.desc_category') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="{{ __('all.placeholder.name_category') }}" name="category_name" id="category_name">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary">{{ __('all.save') }}</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-hover table-striped table-bordered table-consended" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.name_category') }}</th>
                                <th>{{ __('all.table.created') }}</th>
                                <th>{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function showForm() {
        $('#show-form').show();
    }

    $('#show-form').hide();
</script>
@endsection