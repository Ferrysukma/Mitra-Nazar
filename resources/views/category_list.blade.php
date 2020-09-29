@extends('layouts.app')

@section('content')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="fa fa-database"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>{{ __('all.category_coordinator') }}</h2>
                                    <p>{{ __('all.desc_category') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
<div class="tabs-info-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-tabs-int tab-ctm-wp mg-t-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="data-table-list">
                                <div class="table-responsive-sm">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group ic-cmp-int">
                                                <input type="text" class="form-control" placeholder="{{ __('all.placeholder.name_category') }}">
                                                <div class="form-ic-cmp">
                                                    <button type="button" class="btn btn-primary">{{ __('all.save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-hover table-striped table-bordered" id="table-maps" width="100%">
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
            </div>
        </div>
    </div>
</div>

<!-- Start Modal Change Password -->
<div class="modal fade" id="modal-mitra" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('all.add_user') }}</h3>
                <hr>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.username') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="username" id="username" class="form-control readonly" placeholder="{{ __('all.placeholder.username') }}" readonly>
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
<!-- Start Modal Change Password -->
<div class="modal fade" id="modal-mitra" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('all.add_partner') }}</h3>
                <hr>
            </div>
            <div class="modal-body">
                <center>
                    <span>{{ __('all.confirm') }} ?</span>
                    <span>{{ __('all.text_confirm') }}</span>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.cancel') }}</button>
                <button type="button" class="btn btn-primary">{{ __('all.yes') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->
@endsection

@section('script')
<script>
    function showForm() {
        $('#show-form').show();
    }

    $('#show-form').hide();
</script>
@endsection