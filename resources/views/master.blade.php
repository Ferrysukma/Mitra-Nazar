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
                                    <i class="fa fa-dashboard"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>{{ __('all.home') }}</h2>
                                    <p>{{ __('all.welcome') }}</p>
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
                    <div class="widget-tabs-list">
                        <ul class="nav nav-tabs tab-nav-right">
                            <li class="active"><a data-toggle="tab" href="#home2">{{ __('all.chart') }}</a></li>
                            <li><a data-toggle="tab" href="#menu12">{{ __('all.maps') }}</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st tab-ctn-right">
                            <div id="home2" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="btn-group" id="grChart" style="float:right">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="filterChart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ __('all.filter') }} <i class="fa fa-filter"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="filterChart" id="keepChart">
                                                    <form action="#">
                                                        <div class="form-group">
                                                            <input type="text" name="start_date" id="start_dtm_chart" class="form-control" placeholder="{{ __('all.start_date') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="end_date" id="end_dtm_chart" class="form-control" placeholder="{{ __('all.end_date') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="provinsi" id="provinsi_chart" class="form-control" style="width: 100% !important;">
                                                                <option value="" selected disabled>{{ __('all.placeholder.choose_prov') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="kabupaten" id="kabupaten_chart" class="form-control" style="width: 100% !important;">
                                                                <option value="" selected disabled>{{ __('all.placeholder.choose_kab') }}</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>{{ __('all.title_chart') }}</h4>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="line-chart-wp chart-display-nn">
                                                    <canvas id="myChart" style="display:block;width:100px:height:100px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="data-table-list">
                                                <div class="table-responsive-sm">
                                                    <div class="card-title">
                                                        <h4>{{ __('all.table_chart') }}</h4>
                                                    </div>
                                                    <table class="table table-hover table-striped table-bordered" id="table-chart" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>{{ __('all.table.join_date') }}</th>
                                                                <th>{{ __('all.table.partner_id') }}</th>
                                                                <th>{{ __('all.table.partner_nm') }}</th>
                                                                <th>{{ __('all.table.coordinator_type') }}</th>
                                                                <th>{{ __('all.table.prov') }}</th>
                                                                <th>{{ __('all.table.city') }}</th>
                                                                <th>{{ __('all.table.address') }}</th>
                                                                <th>{{ __('all.table.coordinate') }}</th>
                                                                <th>{{ __('all.table.telp') }}</th>
                                                                <th>{{ __('all.table.downline') }}</th>
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
                            </div>
                            <div id="menu12" class="tab-pane fade">
                                <div class="tab-ctn">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="btn-group" id="grMaps" style="float:right">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ __('all.filter') }} <i class="fa fa-filter"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="filterMaps" id="keepMaps">
                                                    <form action="#">
                                                        <div class="form-group">
                                                            <input type="text" name="start_date" id="start_dtm_maps" class="form-control" placeholder="{{ __('all.start_date') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="end_date" id="start_dtm_maps" class="form-control" placeholder="{{ __('all.end_date') }}">
                                                        </div>
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
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>{{ __('all.title_maps') }}</h4>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="google-map-single sm-res-mg-t-30">
                                                    <div id="googleMap"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <hr>
                                            <div class="data-table-list">
                                                <div class="table-responsive-sm">
                                                    <div class="card-title">
                                                        <h4>{{ __('all.table_chart') }}</h4>
                                                    </div>
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#start_dtm_chart').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#end_dtm_chart').data('datepicker')
                .update('minDate', date);
            $('#end_dtm_chart').focus();
        }
    });

    $('#end_dtm_chart').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#start_dtm_chart').data('datepicker')
                .update('maxDate', date);
        }
    });

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

    var speedCanvas = document.getElementById("myChart");

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var dataFirst = {
        label: "Car A - Speed (mph)",
        data: [0, 59, 75, 20, 20, 55, 40],
        lineTension: 0,
        fill: false,
        borderColor: 'red'
    };

    var dataSecond = {
        label: "Car B - Speed (mph)",
        data: [20, 15, 60, 60, 65, 30, 70],
        lineTension: 0,
        fill: false,
        borderColor: 'blue'
    };

    var speedData = {
        labels: ["0s", "10s", "20s", "30s", "40s", "50s", "60s"],
        datasets: [dataFirst, dataSecond]
    };

    var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
            boxWidth: 80,
            fontColor: 'black'
            }
        }
    };

    var lineChart = new Chart(speedCanvas, {
        type: 'line',
        data: speedData,
        options: chartOptions
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