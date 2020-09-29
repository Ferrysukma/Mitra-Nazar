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
                                    <h2>{{ __('all.users') }}</h2>
                                    <p>{{ __('all.desc_users') }}</p>
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
                                        <div class="col-sm-8"></div>
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-2">
                                            <div class="btn-group" id="grMaps" style="float:left">
                                                <button type="button" class="btn btn-primary" id="add-mitra"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                                                <button class="btn btn-info dropdown-toggle" type="button" id="btnFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-filter"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnFilter" id="keepOpen">
                                                    <form action="#">
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
    $(document).on('click','#add-mitra', function () {
        showModal('modal-mitra');
    });

    $(document).on('click','.remove-mitra', function () {
        showModal('remove-mitra'); 
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

    $("#btnFilter").on('click',function() {
        if ($("#grMaps").hasClass('open')) {
            $("#keepOpen").dropdown('hide');
        } else {
            $("#keepOpen").dropdown('show');
        }
    });
</script>
@endsection