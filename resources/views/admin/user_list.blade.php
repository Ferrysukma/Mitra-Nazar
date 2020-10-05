@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.users') }}</h1>
                        <p>{{ __('all.desc_users') }}</p>
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
                <div class="btn-group" role="group" style="float:right">
                    <button type="button" class="btn btn-primary btn-sm" id="add-user" onclick="showModal('modal-mitra')"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                        <i class="fa fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                        <form id="formFilter" class="px-4 py-3" action="#">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" style="width: 100% !important;">
                                    <option value="" selected disabled>{{ __('all.placeholder.choose_status') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('all.form.username') }}</th>
                                <th>{{ __('all.form.email') }}</th>
                                <th>{{ __('all.form.telp') }}</th>
                                <th>{{ __('all.table.status') }}</th>
                                <th>{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Modal Change Password -->
<div class="modal fade" id="modal-mitra" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-white">{{ __('all.add_user') }}</h3>
                <hr>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.username') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="username" id="username" class="form-control" placeholder="{{ __('all.placeholder.username') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.email') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('all.placeholder.email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.telp') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="telp" id="telp" class="form-control" placeholder="{{ __('all.placeholder.telp') }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="button" class="btn btn-primary">{{ __('all.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->
@endsection