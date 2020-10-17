@extends('user.master')

@section('contentUser')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">Downline</h1>
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
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                        <i class="fa fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                        <form id="formFilter" class="px-4 py-3" action="#">
                            <div class="form-group">
                                <div class="dropdown">
                                    <input type="text" name="city" class="form-control dropdown-toggle" id="filterProv" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="findProv('filterProv', 'filter-prov', 'showFilProv')" placeholder="{{ __('all.table.prov') }}">
                                    <div class="dropdown-menu filter-prov" id="showFilProv">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="dropdown">
                                    <input type="text" name="city" class="form-control readonly" id="filterCity" readonly placeholder="{{ __('all.table.city') }}">
                                    <div class="dropdown-menu filter-city" id="showFilCity">
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
                                <select name="status" id="status" class="form-control" style="width: 100% !important;" onchange="change('status', 10)">
                                    <option value="" selected disabled>{{ __('all.placeholder.choose_status') }}</option>
                                    <option value="{{ __('all.active') }}">{{ __('all.active') }}</option>
                                    <option value="{{ __('all.noactive') }}">{{ __('all.noactive') }}</option>
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
                                <input type="text" name="nama" id="nama" class="form-control readonly" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.coordinator_type') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="tipe" id="tipe" class="form-control readonly" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-3">{{ __('all.category_coordinator') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="kategori" id="kategori" class="form-control readonly" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.prov') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="text" name="city" class="form-control dropdown-toggle" id="dropProv" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('dropProv', 'data-prov', 'showProv')" placeholder="{{ __('all.placeholder.key') }}">
                                    <div class="dropdown-menu data-prov" id="showProv">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.city') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="text" name="city" class="form-control readonly" id="city" readonly>
                                    <div class="dropdown-menu data-city" id="showCity">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.district') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <input type="text" name="district" class="form-control readonly" id="district" readonly>
                                    <div class="dropdown-menu data-district" id="showDistrict">
                                        <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9" id="maps-mitra">
                                <div id="map_canvas" style="width:100%;height:50vh"></div>
                                <input type="hidden" id="lat" name="lat">
                                <input type="hidden" id="lng" name="long">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.table.address') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control readonly" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-primary" id="save-mitra">{{ __('all.save') }}</button> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->
<!-- Start Modal Change Password -->
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.cancel') }}</button>
                <button type="button" class="btn btn-primary" onclick="disabledP()" id="btnClose">{{ __('all.yes') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->
@endsection

@section('script')
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

    function findProv(filter, code, show) {
        var input, filter;
        input  = document.getElementById(filter);
        filter = input.value.toUpperCase();

        $('#'+show).toggle('show');

        $.ajax({
            type        : "POST",
            url         : "{{ route('findProvUser') }}",
            headers     : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data        : {
                filter  : filter
            },
            dataType    : 'JSON',
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

    function findCity(filter, code, show) {
        $.ajax({
            type        : "POST",
            url         : "{{ route('findCityUser') }}",
            data        : {
                _token  : "{{ csrf_token() }}",
                filter  : filter
            },
            dataType    : 'JSON',
            beforeSend  : function () {
                $('.'+code).ploading({action:'show'});
            },
            success     : function (res) {
                $('#'+show).toggle('show');
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

        $('.filter-prov').hide(); 
        findCity(id, 'filter-city', 'showFilCity');
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

        $('.data-prov').hide(); 
        coordinateCity(id, 'data-city', 'showCity');
    }

    function selectCity(e) {
        var name    = $(e).attr('name');
        var id      = $(e).attr('id');

        $('#city').val(name);

        $('.data-city').hide(); 
        coordinateDistrict(id, 'data-district', 'showDistrict');
    }

    function filterCoordinate(filter, code, show) {
        var input, filter;
        input  = document.getElementById(filter);
        filter = input.value.toUpperCase();

        $('#'+show).toggle('show');

        $.ajax({
            type        : "POST",
            url         : "{{ route('getCoordinateUser') }}",
            data        : {
                _token  : "{{ csrf_token() }}",
                filter  : filter
            },
            dataType    : 'JSON',
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

    function coordinateCity(filter, code, show) {
        $.ajax({
            type        : "POST",
            url         : "{{ route('coordinateCityUser') }}",
            data        : {
                _token  : "{{ csrf_token() }}",
                filter  : filter
            },
            dataType    : 'JSON',
            beforeSend  : function () {
                $('.'+code).ploading({action:'show'});
            },
            success     : function (res) {
                $('#'+show).toggle('show');
                $('.'+code).html(res.data);
            },
            complete    : function () {
                $('.'+code).ploading({action:'hide'});
            }
        });
    }

    function coordinateDistrict(filter, code, show) {
        $.ajax({
            type        : "POST",
            url         : "{{ route('coordinateDistrictUser') }}",
            data        : {
                _token  : "{{ csrf_token() }}",
                filter  : filter
            },
            dataType    : 'JSON',
            beforeSend  : function () {
                $('.'+code).ploading({action:'show'});
            },
            success     : function (res) {
                $('#'+show).toggle('show');
                $('.'+code).html(res.data);
            },
            complete    : function () {
                $('.'+code).ploading({action:'hide'});
            }
        });
    }

    function getLoc(e) {
        $('.data-district').hide();
        $('#district').val($(e).attr('name'));
        getLatLong($(e).attr('name'), 'map_canvas', 'maps-mitra');
    }

    $('#form-cat').hide();

    $(document).on('click','#add-mitra', function () {
        showModal('modal-mitra', 'postmitra');
        $('#id').val('');
        $('#tipe').val('pusat');
        $('#basic-addon1').attr('disabled', true);
        $('#userCode').removeAttr('readonly');
        $('#kategori').val('umum');
        $('#modal-mitra').find('.modal-title').text("{{ __('all.add_partner') }}");
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
                search : $('#search').val()
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
                                ref.alamat,
                                ref.koordinat,
                                ref.active,
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-trash'></i></button></div>", 
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
        $('#id').val($(this).attr('id'));
        $('#userCode').val(data[1]).attr('readonly', true);
        $('#nama').val(data[2]);
        $('#tipe').val(data[3]);
        $('#kategori').val(data[4]);
        $('#dropProv').val(data[5]);
        $('#city').val(data[6]);
        $('#district').val(data[7]);
        $('#address').val(data[8]);

        getLatLong(data[6], 'map_canvas', 'maps-mitra');
        
        $('#modal-mitra').find('.modal-title').text("{{ __('all.edit_user') }} #"+data[0]+"");
    });

    $('#table-maps tbody').on('click', '.action-delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

        showModal('disabled-mitra'); 
        $('#partner_id').val($(this).attr('id'));
        $('#disabled-mitra').find('.modal-title').text("{{ __('all.disabled_partner') }} "+data[2]+"");
    })
    
    showData();

    $("#postmitra").validate({
        rules       : {
            userCode    : "required",
            nama        : "required",
            tipe        : "required",
            kategori    : "required",
            city        : "required",
            province    : "required",
            district    : "required",
            address     : "required",
        },
        messages: {
            userCode    : "{{ __('all.validation.usercode') }}",
            nama        : "{{ __('all.validation.name') }}",
            tipe        : "{{ __('all.validation.tipe') }}",
            kategori    : "{{ __('all.validation.cat') }}",
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
                        notif('success', data.info);
                        showData();
                        resetForm('postmitra','id');
                        $('#modal-mitra').modal('hide');
                    } else {
                        notif('warning', data.info);
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