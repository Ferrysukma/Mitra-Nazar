@extends('user.master')

@section('contentUser')
<?php $type   = isset($tipe) && !empty($tipe) ? $tipe : null;?>


<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">Downline</h1>
                        <p>{{ __('all.desc_downline') }}</p>
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
                    <button type="button" class="btn btn-primary btn-sm" id="add-mitra"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                        <i class="fa fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                        <form id="formFilter" class="px-4 py-3" action="#">
                            <div class="form-group">
                                <div class="dropdown">
                                    <input type="hidden" id="idfProv">
                                    <input type="text" name="city" class="form-control dropdown-toggle" id="filterProv" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterPosition('filterProv', 'filter-prov', 'showFilProv')" placeholder="{{ __('all.table.prov') }}">
                                    <div class="dropdown-menu filter-prov scrollable-menu" id="showFilProv">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="dropdown">
                                    <input type="text" name="city" class="form-control dropdown-toggle" id="filterCity" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterPosition('filterCity', 'filter-city', 'showFilCity')" placeholder="{{ __('all.table.city') }}">
                                    <div class="dropdown-menu filter-city scrollable-menu" id="showFilCity">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="tipe" id="type" class="form-control select2" onchange="showData()">
                                    <option value="">{{ __('all.placeholder.choose_coortype') }}</option>
                                    <option value="pusat" {{ Request::segment(3) == 'pusat' ? 'selected' : '' }}>{{ __('all.checkbox.central') }}</option>
                                    <option value="provinsi" {{ Request::segment(3) == 'provinsi' ? 'selected' : '' }}>{{ __('all.checkbox.regional') }}</option>
                                    <option value="kota" {{ Request::segment(3) == 'kota' ? 'selected' : '' }}>{{ __('all.checkbox.city') }}</option>
                                    <option value="kecamatan" {{ Request::segment(3) == 'kecamatan' ? 'selected' : '' }}>{{ __('all.checkbox.district') }}</option>
                                    <option value="desa" {{ Request::segment(3) == 'desa' ? 'selected' : '' }}>{{ __('all.checkbox.village') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" style="width: 100% !important;" onchange="showData()">
                                    <option value="" selected disabled>{{ __('all.placeholder.choose_status') }}</option>
                                    <option value="true">{{ __('all.active') }}</option>
                                    <option value="false">{{ __('all.noactive') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="maps-homeMitra">
                    <div id="mapsHomeMitra" style="width:100%;height:50vh"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="table-responsive">
                    <div class="card-title">
                        <h4>{{ __('all.table_down') }}</h4>
                    </div>
                    <hr>
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th>ID Downline</th>
                                <th>{{ __('all.table.nmDown') }}</th>
                                <th>{{ __('all.table.coordinator_type') }}</th>
                                <th>{{ __('all.category_coordinator') }}</th>
                                <th>{{ __('all.table.prov') }}</th>
                                <th>{{ __('all.table.city') }}</th>
                                <th>{{ __('all.form.district') }}</th>
                                <th>{{ __('all.table.address') }}</th>
                                <th>{{ __('all.table.coordinate') }}</th>
                                <th>{{ __('all.table.status') }}</th>
                                <th style="text-align:center">{{ __('all.table.action') }}</th>
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
        <div class="modal-content create-mitra">
            <div class="modal-header">
                <h3 class="modal-title text-white"></h3>
                <hr>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <b>{{ __('all.modal_info') }}</b>
                    <br><br>
                    <form action="#" method="post" id="postmitra">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">ID Downline <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="text" name="userCode" id="userCode" class="form-control" placeholder="{{ __('all.placeholder.code_userDown') }}" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary input-group-text" id="basic-addon1" onclick="findUser()" disabled><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.nm_down') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" id="nama" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.coordinator_type') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="tipe" id="tipe" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-3">{{ __('all.category_coordinator') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="kategori" id="kategori" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.prov') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="hidden" id="idProv">
                                    <input type="text" name="provinsi" class="form-control dropdown-toggle readonly-edit" id="dropProv" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('dropProv', 'data-prov', 'showProv')" placeholder="{{ __('all.placeholder.key') }}">
                                    <div class="dropdown-menu data-prov scrollable-menu" id="showProv">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.city') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="hidden" id="idCity">
                                    <input type="text" name="city" class="form-control dropdown-toggle form-control readonly-edit" id="city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('city', 'data-city', 'showCity')" placeholder="{{ __('all.placeholder.key') }}">
                                    <div class="dropdown-menu data-city scrollable-menu" id="showCity">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.district') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="text" name="district" class="form-control dropdown-toggle readonly-edit" id="district" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('district', 'data-district', 'showDistrict')" placeholder="{{ __('all.placeholder.key') }}">
                                    <div class="dropdown-menu data-district scrollable-menu" id="showDistrict">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.address') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control readonly-edit" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group row" id="modalMaps" hidden>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9" id="maps-mitra">
                                <div id="map_canvas" style="width:100%;height:50vh"></div>
                                <input type="hidden" id="lat" name="lat">
                                <input type="hidden" id="lng" name="long">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-success" id="save-mitra">{{ __('all.save') }}</button> 
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="disabled-mitra" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content delete-mitra">
            <div class="modal-header">
                <h3 class="modal-title text-white"></h3>
                <hr>
            </div>
            <div class="modal-body">
                <center>
                    <span>{{ __('all.confirm') }} ?</span>
                    <span>{{ __('all.text_confirmDown') }}</span>
                </center>
                <input type="hidden" name="partner_id" id="partner_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.cancel') }}</button>
                <button type="button" class="btn btn-success" onclick="disabledP()" id="btnClose">{{ __('all.yes') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content create-detail">
            <div class="modal-header">
                <h5 class="modal-title text-white">{{ __('all.button.detail') }}</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" alt="" id="imageUser">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.regional') }}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="countR" align="center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.city') }}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="countC" align="center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.district') }}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="countD" align="center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.village') }}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="countV" align="center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{ __('all.button.detail') }} Downline</h6>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post" id="postdetail">
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">ID Downline</label>
                                        <div class="col-sm-7">
                                            <span id="idDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">{{ __('all.table.nmDown') }}</label>
                                        <div class="col-sm-7">
                                            <span id="nmDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">{{ __('all.table.coordinator_type') }}</label>
                                        <div class="col-sm-7">
                                            <span id="tipeDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="category" class="col-sm-5">{{ __('all.category_coordinator') }}</label>
                                        <div class="col-sm-7">
                                            <span id="kategoriDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">{{ __('all.table.prov') }}</label>
                                        <div class="col-sm-7">
                                            <span id="provDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">{{ __('all.table.city') }}</label>
                                        <div class="col-sm-7">
                                            <span id="cityDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">{{ __('all.form.district') }}</label>
                                        <div class="col-sm-7">
                                            <span id="distDown"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="old" class="col-sm-5">{{ __('all.table.address') }}</label>
                                        <div class="col-sm-7">
                                            <span id="addDown"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptUser')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Ah8Zuhy2ECqqjBNF8ri2xJ7mwwtIbwo&callback=initMap" defer></script>
<script>
    var table = $('#table-maps').DataTable({
        "language" : {
            "lengthMenu"    : "{{ __('all.datatable.show_entries') }}",
            "emptyTable"    : "{{ __('all.datatable.no_data') }}",
            "info"        	: "{{ __('all.datatable.showing_start') }}",
            "infoFiltered"  : "{{ __('all.datatable.filter') }}",
            "infoEmpty"     : "{{ __('all.datatable.showing_null') }}",
            "loadingRecords": "{{ __('all.datatable.load') }}",
            "processing"    : "{{ __('all.datatable.process') }}",
            "search"      	: "{{ __('all.datatable.search') }}",
            "zeroRecords"   : "{{ __('all.datatable.zero') }}",
            "paginate"      : 
            {
                "first"     : "{{ __('all.datatable.first') }}",
                "last"      : "{{ __('all.datatable.last') }}",
                "next"      : "{{ __('all.datatable.next') }}",
                "previous"  : "{{ __('all.datatable.prev') }}",
            }
        },
        "columnDefs"        : [ 
            { targets: [0], orderable: false, className	: "text-center" },
            { targets: [11], orderable: false, searchable: false, className	: "text-center" },
        ],
        "initComplete"      : function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });

    function filterProv(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#filterProv').val(name);
        $('#idfProv').val(id);

        $('.filter-prov').hide(); 
        filterPosition('filterCity', 'filter-city', 'showFilCity');
        showData();
    }

    function filterCity(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#filterCity').val(name);

        $('.filter-city').hide(); 
        showData();
    }

    function selectProv(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#dropProv').val(name);
        $('#idProv').val(id);

        $('.data-prov').hide(); 
        filterCoordinate('city', 'data-city', 'showCity');
    }

    function selectCity(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#city').val(name);
        $('#idCity').val(id);

        $('.data-city').hide(); 
        filterCoordinate('district', 'data-district', 'showDistrict');
    }

    function filterCoordinate(filter, code, show) {
        var input, filter;
        var data = new FormData();

        input   = document.getElementById(filter);
        value   = input.value.toUpperCase();

        if (filter == 'dropProv') {
            data.append('filter', value);
            var url = "{{ route('getCoordinateUser') }}";
        } else if (filter == 'city') {
            data.append('query', value);
            data.append('filter', $('#idProv').val());
            var url = "{{ route('coordinateCityUser') }}";
        } else {
            data.append('query', value);
            data.append('filter', $('#idCity').val());
            var url = "{{ route('coordinateDistrictUser') }}";
        }

        $('#'+show).toggle('show');

        $.ajax({
            type        : "POST",
            url         : url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data        : data,
            dataType    : 'JSON',
            processData : false,  // Important!
            contentType : false,
            cache       : false,
            beforeSend  : function () {
                $('.'+code).ploading({action:'show'});
            },
            success     : function (res) {
                $('.'+code).html(res.data);
            },
            complete    : function () {
                $('.'+code).ploading({action:'hide'});
            }
        });
    }

    function filterPosition(filter, code, show) {
        var input, filter;
        var data = new FormData();

        input   = document.getElementById(filter);
        value   = input.value.toUpperCase();

        if (filter == 'filterProv') {
            data.append('filter', value);
            var url = "{{ route('findProvUser') }}";
        } else {
            data.append('query', value);
            data.append('filter', $('#idfProv').val());
            var url = "{{ route('findCityUser') }}";
        }

        $('#'+show).toggle('show');

        $.ajax({
            type        : "POST",
            url         : url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data        : data,
            dataType    : 'JSON',
            processData : false,  // Important!
            contentType : false,
            cache       : false,
            beforeSend  : function () {
                $('.'+code).ploading({action:'show'});
            },
            success     : function (res) {
                $('.'+code).html(res.data);
            },
            complete    : function () {
                $('.'+code).ploading({action:'hide'});
            }
        });
    }

    function getLoc(e) {
        $('.data-district').hide();
        $('#modalMaps').removeAttr('hidden');
        $('#district').val($(e).attr('name'));
        getLatLong($(e).attr('name'), 'map_canvas', 'maps-mitra');
    }

    $(document).on('click','#add-mitra', function () {
        showModal('modal-mitra', 'postmitra');
        $('#modalMaps').attr('hidden', true);
        $('#id').val('');
        $('#tipe').val('pusat');
        $('#basic-addon1').attr('disabled', true);
        $('#userCode').removeAttr('readonly');
        $('#kategori').val('umum');
        $('#modal-mitra').find('.readonly-edit').removeAttr('readonly');
        $('#modal-mitra').find('.modal-title').text("{{ __('all.add_down') }}");
    });

    function showData() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "POST",
            url     : "{{ route('listUser') }}",
            data    : {
                search  : $('#search').val(),
                provinsi: $('#filterProv').val(),
                kota    : $('#filterCity').val(),
                tipe    : $('#type').val(),
                status  : $('#status').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                table.clear().draw();
                $("#table-maps").parent().ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    list = data.data;
                    
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            table.row.add( [
                                idx + 1,
                                ref.koordinatorProfile['userCode'],
                                ref.name,
                                ref.koordinatorProfile['tipe'],
                                ref.koordinatorProfile['kategori'],
                                ref.koordinatorProfile['provinsi'],
                                ref.koordinatorProfile['kota'],
                                ref.koordinatorProfile['kecamatan'],
                                ref.koordinatorProfile['alamat'],
                                ref.koordinat,
                                ref.active,
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-info action-detail' title='{{ __('all.button.detail') }}' data-toggle='tooltip' data-placement='top' id='"+ref.koordinatorProfile['userCode']+"'><i class='fa fa-eye'></i></button><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.koordinatorProfile['id']+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.koordinatorProfile['id']+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-times'></i></button></div>", 
                            ] ).draw( false );
                        });
                    }
                } 
            },
            complete : function () {
                $("#table-maps").parent().ploading({action : 'hide'});
            }
        });
    }

    function maps() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('listAllUser') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data    : {
                params  : 1
            },
            dataType: "JSON",
            beforeSend: function(){
                $("#maps-homeMitra").ploading({action : 'show'});
            },
            success     : function(data){
                initMaps(data.data, 'mapsHomeMitra');
            },
            complete : function () {
                $("#maps-homeMitra").ploading({action : 'hide'});
            }
        });
    }

    maps();

    function findUser() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "POST",
            url     : "{{ route('Userfind') }}",
            data    : {
                id          : $('#id').val(),
                userCode    : $('#userCode').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                $('#nama').val('');
                $("#basic-addon1").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".create-mitra").ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    if ($('#id').val().length > 0) {
                        $('#nama').val(data.data.user.name);
                        $('#tipe').val(data.data.payload.tipe);
                        $('#kategori').val(data.data.payload.kategori);
                        $('#dropProv').val(data.data.payload.provinsi);
                        $('#city').val(data.data.payload.kota);
                        $('#district').val(data.data.payload.kecamatan);
                        $('#address').val(data.data.payload.alamat);

                        latlng  = data.data.payload.koordinat;
                        split   = latlng.split(',');

                        initialize(split[0], split[1], 'map_canvas');
                    } else {
                        $('#nama').val(data.data.name);
                    }
                } 
            },
            complete : function () {
                $("#basic-addon1").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $(".create-mitra").ploading({action : 'hide'});
            }
        });
    }

    function disabledP() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('disabledUser') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data	: {
                id  : $('#partner_id').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                $('#btnClose').buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".delete-mitra").ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    notif('success', '{{ __("all.success") }}', '{{ __("all.alert.delete") }}');
                    $('#disabled-mitra').modal('hide');
                    showData();
                } else {
                    notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_delete") }}');
                }
            },
            complete    : function(){
                $('#btnClose').buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $(".delete-mitra").ploading({action : 'hide'});
            },
            error 		: function(){
                notif('error', '{{ __("all.error") }}');
            }
        });
    }

    $(document).on('keyup','#userCode', function () {
        var name = $('#userCode').val();
        if (name != '') {
            $('#basic-addon1').removeAttr('disabled');
        } else {
            $('#basic-addon1').attr('disabled', true);
        }
    });

    $('#table-maps tbody').on('click', '.action-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        showModal('modal-mitra','postmitra');
        $('#modalMaps').attr('hidden', true);
        $('#id').val($(this).attr('id'));
        $('#userCode').val('');
        
        $('#modal-mitra').find('.readonly-edit').attr('readonly', true);
        $('#modal-mitra').find('.modal-title').text("{{ __('all.edit_down') }} #"+data[0]+"");
    });

    $('#table-maps tbody').on('click', '.action-delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

        showModal('disabled-mitra'); 
        $('#partner_id').val($(this).attr('id'));
        $('#disabled-mitra').find('.modal-title').text("{{ __('all.disabled_partner') }} "+data[2]+"");
    });

    $('#table-maps tbody').on('click', '.action-detail', function () {
        var data = table.row( $(this).parents('tr') ).data();
        showModal('modal-detail','postdetail');
        $('#idDown').text(data[1]);
        $('#nmDown').text(data[2]);
        $('#tipeDown').text(data[3]);
        $('#kategoriDown').text(data[4]);
        $('#provDown').text(data[5]);
        $('#cityDown').text(data[6]);
        $('#distDown').text(data[7]);
        $('#addDown').text(data[8]);

        findCode(data[1]);
    });

    function findCode(id) {
        $.ajax({
            type        : "POST",
            url         : "{{ route('findCode') }}",
            data        : {
                _token  : "{{ csrf_token() }}",
                id      : id
            }, 
            dataType    : "JSON",
            success     : function (res) {
                var prov = res.data.provinsi;
                var city = res.data.kota;
                var dist = res.data.kecamatan;
                var vill = res.data.desa;

                if (prov == '' || prov == null) { prov = 0 }
                if (city == '' || city == null) { city = 0 }
                if (dist == '' || dist == null) { dist = 0 }
                if (vill == '' || vill == null) { vill = 0 }

                $('#countR').text(prov);
                $('#countC').text(city);
                $('#countD').text(dist);
                $('#countV').text(vill);

                if (res.data.image) {
                    $('#imageUser').attr('src', res.data.image);
                } else {
                    $('#imageUser').attr('src', '{{ asset("assets/admin/image/user.png") }}');
                }
            }
        })
    }
    
    showData();

    $("#postmitra").validate({
        rules       : {
            userCode    : "required",
            city        : "required",
            province    : "required",
            district    : "required",
            address     : "required",
        },
        messages: {
            userCode    : "{{ __('all.validation.usercode') }}",
            city        : "{{ __('all.validation.city') }}",
            province    : "{{ __('all.validation.province') }}",
            district    : "{{ __('all.validation.district') }}",
            address     : "{{ __('all.validation.address') }}",
        },
        errorClass      : "invalid-feedback",
        errorElement    : "div",
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        errorPlacement  : function(error,element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            if (element.attr("name") == "userCode" ) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler           : function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type	: "POST",
                url		: "{{ route('saveUser') }}",
                data	: $('#postmitra').serialize(),
                dataType: "JSON",
                beforeSend: function(){
                    $("#save-mitra").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-mitra').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', data.info);
                        showData();
                        resetForm('postmitra','id');
                        $('#modal-mitra').modal('hide');
                    } else {
                        notif('warning', '{{ __("all.warning") }}', data.info);
                    }
                },
                complete    : function(){
                    $("#save-mitra").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $('.create-mitra').ploading({action:'hide'});
                },
                error 		: function(){
                    notif('error', '{{ __("all.error") }}');
                }
            });
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection