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
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="nk-int-st">
                                                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="{{ __('all.start_date') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="nk-int-st">
                                                        <input type="text" name="end_date" id="end_date" class="form-control" placeholder="{{ __('all.end_date') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select name="provinsi" id="provinsi" class="form-control">
                                                        <option value="" selected disabled>{{ __('all.placeholder.choose_prov') }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select name="kabupaten" id="kabupaten" class="form-control">
                                                        <option value="" selected disabled>{{ __('all.placeholder.choose_kab') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <hr>
                                            <h4 class="card-title">{{ __('all.title_chart') }}</h4>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="line-chart-wp chart-display-nn">
                                                    <canvas height="140vh" width="180vw" id="basiclinechart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <hr>
                                            <h4 class="card-title">{{ __('all.table_chart') }}</h4>
                                            <div class="data-table-list">
                                                <div class="table-responsive-sm">
                                                    <table id="dataTable" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Position</th>
                                                                <th>Office</th>
                                                                <th>Age</th>
                                                                <th>Start date</th>
                                                                <th>Salary</th>
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
                                    <p>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nulla sit amet est. Praesent ac the massa at ligula laoreet iaculis. Vivamus aliquet elit ac nisl. Nulla porta dolor. Cras dapibus. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
                                    <p class="tab-mg-b-0">In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nam eget dui. In ac felis quis tortor malesuadan of pretium. Phasellus consectetuer vestibulum elit. Duis lobortis massa imperdiet quam. Pellentesque commodo eros a enim. Vestibulum ante ipsum primis in faucibus orci the luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Phasellus a est. Pellentesque commodo eros a enim. Cras ultricies mi eu turpis hendrerit of fringilla. Donec mollis hendrerit risus. Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Praesent egestas neque eu enim. In hac habitasse plat.</p>
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

<script>
    $('#start_date').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#end_date').data('datepicker')
                .update('minDate', date);
            $('#end_date').focus();
        }
    });

    $('#end_date').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#start_date').data('datepicker')
                .update('maxDate', date);
        }
    });
</script>