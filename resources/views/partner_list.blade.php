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
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>{{ __('all.partners') }}</h2>
                                    <p>{{ __('all.desc_partners') }}</p>
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
                        <div class="card-header">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="google-map-single sm-res-mg-t-30">
                                    <div id="googleMap"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="data-table-list">
                                <div class="table-responsive-sm">
                                    <div class="row">
                                        <div class="col-sm-8"></div>
                                        <div class="col-sm-2">
                                            <div style="float:righ">
                                                <input type="text" name="filter" id="filter" class="form-control" placeholder="{{ __('all.placeholder.filter') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="btn-group" style="float:left">
                                                <button type="button" class="btn btn-primary" id="add-mitra"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                                                <button class="btn btn-info triger-fadeIn" data-toggle="dropdown"><i class="fa fa-filter"></i></button>
                                                <ul class="dropdown-menu triger-fadeIn-dp">
                                                    <li>
                                                        <input type="text" name="start_date" id="start_dtm_maps" class="form-control" placeholder="{{ __('all.start_date') }}">
                                                    </li>
                                                    <li>
                                                        <input type="text" name="end_date" id="end_dtm_maps" class="form-control" placeholder="{{ __('all.end_date') }}">
                                                    </li>
                                                    <li>
                                                        <select name="provinsi" id="provinsi_maps" class="form-control" style="width: 100% !important;">
                                                            <option value="" selected disabled>{{ __('all.placeholder.choose_prov') }}</option>
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <select name="kabupaten" id="kabupaten_maps" class="form-control" style="width: 100% !important;">
                                                            <option value="" selected disabled>{{ __('all.placeholder.choose_kab') }}</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-hover table-striped table-bordered" id="table-maps" width="100%">
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#start_dtm_maps').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#end_dtm_maps').data('datepicker')
                .update('minDate', date);
            $('#end_dtm_maps').focus();
        }
    });

    $('#end_dtm_maps').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#start_dtm_maps').data('datepicker')
                .update('maxDate', date);
        }
    });

    function initMap() {
       var myLatlng = {lat: -25.363, lng: 131.044};

        var map6 = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 4,
            center: myLatlng
        });

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map6,
            title: 'Click to zoom'
        });
    }

    initMap();
</script>
@endsection