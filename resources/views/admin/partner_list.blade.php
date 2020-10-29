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
                <div class="btn-group" role="group" style="float:right">
                    <button type="button" class="btn btn-primary btn-sm" id="add-mitra"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                    <!-- <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
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
                                <select name="tipe" id="type" class="form-control select2" onchange="change('type', 3)">
                                    <option value="">{{ __('all.placeholder.choose_coortype') }}</option>
                                    <option value="pusat">{{ __('all.checkbox.central') }}</option>
                                    <option value="provinsi">{{ __('all.checkbox.regional') }}</option>
                                    <option value="kota">{{ __('all.checkbox.city') }}</option>
                                    <option value="kecamatan">{{ __('all.checkbox.district') }}</option>
                                    <option value="desa">{{ __('all.checkbox.village') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="kategori" id="cat" class="form-control select2 create-cat" onchange="change('cat', 4)"></select>
                            </div>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" style="width: 100% !important;" onchange="change('status', 10)">
                                    <option value="" selected disabled>{{ __('all.placeholder.choose_status') }}</option>
                                    <option value="{{ __('all.active') }}">{{ __('all.active') }}</option>
                                    <option value="{{ __('all.noactive') }}">{{ __('all.noactive') }}</option>
                                </select>
                            </div>
                        </form>
                    </div> -->
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
                        <h4>{{ __('all.table_chart') }}</h4>
                    </div>
                    <hr>
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th>{{ __('all.table.partner_id') }}</th>
                                <th>{{ __('all.table.partner_nm') }}</th>
                                <th>{{ __('all.table.coordinator_type') }}</th>
                                <th>{{ __('all.category_coordinator') }}</th>
                                <th>{{ __('all.table.prov') }}</th>
                                <th>{{ __('all.table.city') }}</th>
                                <th>{{ __('all.form.district') }}</th>
                                <th>{{ __('all.table.village') }}</th>
                                <th>{{ __('all.table.address') }}</th>
                                <th style="display:none">lat</th>
                                <th style="display:none">long</th>
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
                <div class="container-fluid" id="form-mitra">
                    <b>{{ __('all.modal_info') }}</b>
                    <br><br>
                    <form action="#" method="post" id="postmitra">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.code_user') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="text" name="userCode" id="userCode" class="form-control readonly" placeholder="{{ __('all.placeholder.code_user') }}" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary input-group-text" id="basic-addon1" onclick="findUser()" disabled><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.partner_nm') }} <sup class="text-danger">*</sup></label>
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
                                <select name="kategori" id="kategori" class="form-control select2 create-cat"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.prov') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="hidden" id="idProv">
                                    <input type="text" name="provinsi" class="form-control dropdown-toggle" id="dropProv" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('dropProv', 'data-prov', 'showProv')" placeholder="{{ __('all.placeholder.key') }}">
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
                                    <input type="text" name="city" class="form-control dropdown-toggle" id="city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('city', 'data-city', 'showCity')" placeholder="{{ __('all.placeholder.key') }}">
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
                                    <input type="text" name="district" class="form-control dropdown-toggle" id="district" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('district', 'data-district', 'showDistrict')" placeholder="{{ __('all.placeholder.key') }}">
                                    <div class="dropdown-menu data-district scrollable-menu" id="showDistrict">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.village') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="desa" id="desa" class="form-control" placeholder="{{ __('all.placeholder.village') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.address') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control readonly" cols="30" rows="5"></textarea>
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
                        <hr>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                            <button type="submit" class="btn btn-success" id="save-mitra">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>

                <div class="container-fluid" id="form-cat">
                    <form action="#" method="post" id="postcat">
                        <div class="form-group row">
                            <label for="cat" class="col-sm-3">{{ __('all.category_coordinator') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="cat_name" placeholder="{{ __('all.placeholder.name_category') }}">
                            </div>
                        </div>
                        <hr>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" onClick="formMitra()">{{ __('all.close') }}</button>
                            <button type="submit" class="btn btn-success" id="save-cat" disabled onClick="saveCat()">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->
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
                    <span>{{ __('all.text_confirm') }}</span>
                </center>
                <input type="hidden" name="partner_id" id="partner_id">
                <input type="hidden" name="active" id="active">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.cancel') }}</button>
                <button type="button" class="btn btn-success" onclick="disabledP('btnDis','delete-mitra','disabled-mitra')" id="btnDis">{{ __('all.yes') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->

<div class="modal fade" id="active-mitra" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content active-mitra">
            <div class="modal-header">
                <h3 class="modal-title text-white"></h3>
                <hr>
            </div>
            <div class="modal-body">
                <center>
                    <span>{{ __('all.confirm_act') }} ?</span>
                    <span>{{ __('all.text_confirm_act') }}</span>
                </center>
                <input type="hidden" name="partner_id" id="partner_id">
                <input type="hidden" name="active" id="active">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.cancel') }}</button>
                <button type="button" class="btn btn-success" onclick="disabledP('btnAct','active-mitra','active-mitra')" id="btnAct">{{ __('all.yes_act') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Ah8Zuhy2ECqqjBNF8ri2xJ7mwwtIbwo&callback=initMap" defer></script>
<script>
    var table = $('#table-maps').DataTable({
        "language" : {
            "searchPlaceholder" : "{{ __('all.datatable.searchName') }}",
            "lengthMenu"        : "{{ __('all.datatable.show_entries') }}",
            "emptyTable"        : "{{ __('all.datatable.no_data') }}",
            "info"        	    : "{{ __('all.datatable.showing_start') }}",
            "infoFiltered"      : "{{ __('all.datatable.filter') }}",
            "infoEmpty"         : "{{ __('all.datatable.showing_null') }}",
            "loadingRecords"    : "{{ __('all.datatable.load') }}",
            "processing"        : "{{ __('all.datatable.process') }}",
            "search"      	    : "{{ __('all.datatable.search') }}",
            "zeroRecords"       : "{{ __('all.datatable.zero') }}",
            "paginate"          : 
            {
                "first"         : "{{ __('all.datatable.first') }}",
                "last"          : "{{ __('all.datatable.last') }}",
                "next"          : "{{ __('all.datatable.next') }}",
                "previous"      : "{{ __('all.datatable.prev') }}",
            }
        },
        "columnDefs"            : [ 
            { targets: [0], orderable: false, className	: "text-center" },
            { targets: [10,11], visible : false },
            { targets: [14], orderable: false, searchable: false, className	: "text-center" },
        ],
        "initComplete"          : function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });

    function filterPosition(filter, code, show) {
        var input, filter;
        var data = new FormData();

        input   = document.getElementById(filter);
        value   = input.value.toUpperCase();

        if (filter == 'filterProv') {
            data.append('filter', value);
            var url = "{{ route('findProv') }}";
        } else {
            data.append('query', value);
            data.append('filter', $('#idfProv').val());
            var url = "{{ route('findCity') }}";
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

    function filterProv(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#filterProv').val(name);
        $('#idfProv').val(id);

        $('.filter-prov').hide(); 
        filterPosition('filterCity', 'filter-city', 'showFilCity');
        change('filterProv', 5);
    }

    function filterCity(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#filterCity').val(name);

        $('.filter-city').hide(); 
        change('filterCity', 6);
    }

    function filter(data, row) {
        if (table.column(row).search() !== data ) {
            table
                .column(row)
                .search( data )
                .draw();
        }
    }

    function change(params, row) {
        var val = $('#'+params).val();
        filter(val, row);
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

    function getLoc(e) {
        $('.data-district').hide();
        $('#modalMaps').removeAttr('hidden');
        $('#district').val($(e).attr('name'));
        getLatLong($(e).attr('name'), 'map_canvas', 'maps-mitra');
    }

    function filterCoordinate(filter, code, show) {
        var input, filter;
        var data = new FormData();

        input   = document.getElementById(filter);
        value   = input.value.toUpperCase();

        if (filter == 'dropProv') {
            data.append('filter', value);
            var url = "{{ route('getCoordinate') }}";
        } else if (filter == 'city') {
            data.append('query', value);
            data.append('filter', $('#idProv').val());
            var url = "{{ route('coordinateCity') }}";
        } else {
            data.append('query', value);
            data.append('filter', $('#idCity').val());
            var url = "{{ route('coordinateDistrict') }}";
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

    $('#form-cat').hide();

    $(document).on('click','#add-mitra', function () {
        showModal('modal-mitra', 'postmitra');
        $('#modalMaps').attr('hidden', true);
        $('#id').val('');
        $('#tipe').val('pusat');
        $('#basic-addon1').attr('disabled', true);
        $('#userCode').removeAttr('readonly');
        $('#kategori').val('').change();
        $('#modal-mitra').find('.modal-title').text("{{ __('all.add_partner') }}");
    });

    $(document).on('keyup','#cat_name', function () {
        var val = $(this).val();
        if (val.length > 0) {
            $('#save-cat').removeAttr('disabled');
        } else {
            $('#save-cat').attr('disabled', true);
        }
    });

    $('.dataTables_filter input')
       .off()
       .on('keyup', function() {
        table.clear().draw();
        showData();
        maps();
    }); 

    $('.create-cat').select2({
        theme           : 'bootstrap4',
    }).on('select2:open', function () {
        var val = $(this).val();
        var a   = $(this).data('select2');
        if (!$('.select2-link').length) {
            a.$results.parents('.select2-results')
                    .append('<div class="select2-link"><a><i class="fa fa-plus"></i> {{ __("all.button.new") }}</a></div>')
                    .on('click', function (b) {
                        a.trigger('close');
                        if (val == null || val == '') {
                            formCategory();
                            $('#modal-mitra').find('.modal-title').text("{{ __('all.add_cat') }}");
                        }
                    });
        }
    });

    function formMitra() {
        $('#modal-mitra').find('.modal-title').text("{{ __('all.add_partner') }}");
        $("#form-cat").animate({
            width: [ "toggle", "swing" ],
            height: [ "toggle", "swing" ],
            opacity: "toggle"
        }, 1000, "linear", function() {
            $('#form-mitra').show('slow');
        });
    }

    function formCategory() {
        $("#form-mitra").animate({
            width: [ "toggle", "swing" ],
            height: [ "toggle", "swing" ],
            opacity: "toggle"
        }, 1000, "linear", function() {
            $('#form-cat').show('slow');
        });
    }

    function saveCat() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('createCategory') }}",
            data	: $('#postcat').serialize(),
            dataType: "JSON",
            beforeSend: function(){
                $("#save-cat").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".create-mitra").ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                    formMitra();
                    showCategory();
                } else {
                    notif('warning', '{{ __("all.warning") }}', data.info);
                }
            },
            complete    : function(){
                $("#save-cat").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $('#cat_name').val('');
                $('#save-cat').attr('disabled', true);
                $(".create-mitra").ploading({action : 'hide'});
            },
            error 		: function(){
                notif('error', '{{ __("all.error") }}');
            }
        });
    }

    function showCategory() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListCategory') }}",
            dataType: "JSON",
            success     : function(data){
                if (data.code == 0) {
                    $('#kategori').empty();
                    $('#cat').empty();
                    txt  = '';
                    list = data.data;
                    
                    txt += '<option value="" selected>{{ __("all.placeholder.choose_coorcategory") }}</option>';
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            txt += '<option value="'+ref.name+'">'+ref.name+'</option>';
                        });
                    }

                    $('#cat').append(txt);
                    $('#kategori').append(txt);
                } 
            },
        });
    }

    showCategory();

    function showData() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "POST",
            url     : "{{ route('loadListPartner') }}",
            data    : {
                search  : $('.dataTables_filter input').val(),
                // provinsi: $('#filterProv').val(),
                // kota    : $('#filterCity').val(),
                // tipe    : $('#type').val(),
                // kategori: $('#cat').val(),
                // status  : $('#status').val(),
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
                                ref.userCode,
                                ref.nama,
                                ref.tipe,
                                ref.kategori,
                                ref.provinsi,
                                ref.kota,
                                ref.kecamatan,
                                ref.desa,
                                ref.alamat,
                                ref.lat,
                                ref.long,
                                ref.koordinat,
                                ref.active,
                                ref.action, 
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
            url     : "{{ route('listAllPartner') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data    : {
                search  : $('.dataTables_filter input').val(),
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
            url     : "{{ route('findUser') }}",
            data    : {
                id  : $('#userCode').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                $('#nama').val('');
                $("#basic-addon1").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".create-mitra").ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    $('#nama').val(data.data.name);
                } else {
                    notif('warning', '{{ __("all.warning") }}', data.info);
                }
            },
            complete : function () {
                $("#basic-addon1").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $(".create-mitra").ploading({action : 'hide'});
            }
        });
    }

    function disabledP(btn, lood, modal) {
        $.ajax({
            type    : "POST",
            url     : "{{ route('deletePartner') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data	: {
                id      : $('#partner_id').val(),
                active  : $('#active').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                $('#'+btn).buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $("."+lood).ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    if ($('#active').val() == true) {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.disable") }}');
                    } else {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.activate") }}');
                    }

                    $('#'+modal).modal('hide');
                    showData();
                    maps();
                } else {
                    notif('warning', '{{ __("all.warning") }}', data.info);
                }
            },
            complete    : function(){
                $('#'+btn).buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $("."+lood).ploading({action : 'hide'});
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
        $('#modalMaps').removeAttr('hidden');
        $('#id').val($(this).attr('id'));
        $('#userCode').val(data[1]).attr('readonly', true);
        $('#nama').val(data[2]);
        $('#tipe').val(data[3]);
        $('#kategori').val(data[4]).change();
        $('#dropProv').val(data[5]);
        $('#city').val(data[6]);
        $('#district').val(data[7]);
        $('#desa').val(data[8]);
        $('#address').val(data[9]);
        $('#lat').val(data[10]);
        $('#lng').val(data[11]);

        initialize(data[10], data[11], 'map_canvas');
        
        $('#modal-mitra').find('.modal-title').text("{{ __('all.edit_user') }} #"+data[0]+"");
    });

    $('#table-maps tbody').on('click', '.action-delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

        showModal('disabled-mitra'); 
        $('#partner_id').val($(this).attr('id'));
        $('#active').val($(this).attr('status'));
        $('#disabled-mitra').find('.modal-title').text("{{ __('all.disabled_partner') }} "+data[2]+"");
    })

    $('#table-maps tbody').on('click', '.action-active', function () {
        var data = table.row( $(this).parents('tr') ).data();

        showModal('active-mitra'); 
        $('#partner_id').val($(this).attr('id'));
        $('#active').val($(this).attr('status'));
        $('#active-mitra').find('.modal-title').text("{{ __('all.active_partner') }} "+data[2]+"");
    })
    
    showData();

    $("#postmitra").validate({
        rules       : {
            userCode    : "required",
            tipe        : "required",
            kategori    : "required",
            city        : "required",
            province    : "required",
            district    : "required",
            desa        : "required",
            address     : "required",
        },
        messages: {
            userCode    : "{{ __('all.validation.usercode') }}",
            tipe        : "{{ __('all.validation.tipe') }}",
            kategori    : "{{ __('all.validation.cat') }}",
            city        : "{{ __('all.validation.city') }}",
            province    : "{{ __('all.validation.province') }}",
            district    : "{{ __('all.validation.district') }}",
            desa        : "{{ __('all.validation.village') }}",
            address     : "{{ __('all.validation.address') }}",
        },
        errorClass      : "invalid-feedback",
        errorElement    : "div",
        highlight: function (element, errorClass, validClass) {
            var check = $(element).attr('readonly');
            if (typeof check == 'undefined') {
                $(element).addClass('is-invalid').removeClass('is-valid');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            var check = $(element).attr('readonly');
            if (typeof check == 'undefined') {
                $(element).removeClass('is-invalid').addClass('is-valid');                
            }
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
                url		: "{{ route('createPartner') }}",
                data	: $('#postmitra').serialize(),
                dataType: "JSON",
                beforeSend: function(){
                    $("#save-mitra").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-mitra').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                        showData();
                        maps();
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