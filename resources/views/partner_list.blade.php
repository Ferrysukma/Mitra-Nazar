@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.partners') }}</h1>
                        <p>{{ __('all.desc_partners') }}</p>
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
                    <div class="col-sm-8"></div>
                    <div class="col-sm-2">
                        <input type="text" name="search" id="search" class="form-control" placeholder="{{ __('all.filter') }}">
                    </div>
                    <div class="col-sm-2">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary btn-sm" id="add-mitra"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                                <i class="fa fa-filter"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                                <form id="formFilter" class="px-4 py-3" action="#">
                                    <div class="form-group">
                                        <select name="provinsi" id="provinsi_maps" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_prov') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="kabupaten" id="kabupaten_maps" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_kab') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="coordinator_type" id="coordinator_type" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_coortype') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="coordinator_category" id="coordinator_category" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_coorcategory') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="status" id="status" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_status') }}</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="googleMap"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="table-responsive-sm">
                    <div class="card-title">
                        <h4>{{ __('all.table_chart') }}</h4>
                    </div>
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('all.table.date') }}</th>
                                <th>{{ __('all.table.prov') }}</th>
                                <th>{{ __('all.table.city') }}</th>
                                <th>{{ __('all.table.qty') }}</th>
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
                <h3 class="modal-title text-white">{{ __('all.add_partner') }}</h3>
                <hr>
            </div>
            <div class="modal-body">
                <b>{{ __('all.modal_info') }}</b>
                <br><br>
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.code_user') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="code_user" id="code_user" class="form-control" placeholder="{{ __('all.placeholder.code_user') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.partner_nm') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="partner_nm" id="partner_nm" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.coordinator_type') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="coordinator_type" id="coordinator_type" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.prov') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="prov" id="prov" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.city') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="city" id="city" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.district') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="district" id="district" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.coordinate') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="coordinate" id="coordinate" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.address') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <textarea name="address" id="address" class="form-control readonly" cols="30" rows="10" readonly></textarea>
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
    $(document).on('click','#add-mitra', function () {
        showModal('modal-mitra');
    });

    $(document).on('click','.remove-mitra', function () {
        showModal('remove-mitra'); 
    });

    // variabel global marker
	function initMap() {
        // The location of Uluru
        var uluru = {lat: -25.344, lng: 131.036};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('googleMap'), {zoom: 4, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
    }
</script>
@endsection