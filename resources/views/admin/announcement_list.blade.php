@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.announcement') }}</h1>
                        <p>{{ __('all.desc_announcement') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Approach table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="btn-group" role="group" style="float:right">
                    <button type="button" class="btn btn-primary btn-sm" id="add-ann" onclick="showForm()"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="card-title">
                        <h4>{{ __('all.announcement_on') }}</h4>
                    </div>
                    <hr>
                    <table class="table table-hover table-striped table-bordered table-condensed" id="table-chart" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.purpose') }}</th>
                                <th>{{ __('all.category_coordinator') }}</th>
                                <th>{{ __('all.start_date') }}</th>
                                <th>{{ __('all.end_date') }}</th>
                                <th>{{ __('all.table.title') }}</th>
                                <th>{{ __('all.table.contents') }}</th>
                                <th>{{ __('all.table.created') }}</th>
                                <th>{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="table-responsive">
                    <div class="card-title">
                        <h4>{{ __('all.announcement_history') }}</h4>
                    </div>
                    <hr>
                    <table class="table table-hover table-striped table-bordered table-cosended" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.purpose') }}</th>
                                <th>{{ __('all.category_coordinator') }}</th>
                                <th>{{ __('all.start_date') }}</th>
                                <th>{{ __('all.end_date') }}</th>
                                <th>{{ __('all.table.title') }}</th>
                                <th>{{ __('all.table.contents') }}</th>
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

<!-- Modal -->
<div class="modal fade" id="modal-ann">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content create-ann">
            <div class="modal-header">
                <h5 class="modal-title text-white"></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="form-cat">
                    <form action="#" method="post" id="postcat">
                        <div class="form-group row">
                            <label for="cat" class="col-sm-3">{{ __('all.category_coordinator') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="cat_name" placeholder="{{ __('all.placeholder.name_category') }}">
                            </div>
                        </div>
                        <hr>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" onClick="formAnn()">{{ __('all.close') }}</button>
                            <button type="submit" class="btn btn-success" id="save-cat" disabled onClick="saveCat()">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>

                <div class="container-fluid" id="form-ann">
                    <form action="#" method="post" id="postann">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="purpose" class="col-sm-3">{{ __('all.table.purpose') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <select name="tujuan[]" id="tujuan" class="form-control select2" multiple="multiple">
                                    <option value="pusat">{{ __('all.checkbox.central') }}</option>
                                    <option value="provinsi">{{ __('all.checkbox.regional') }}</option>
                                    <option value="kota">{{ __('all.checkbox.city') }}</option>
                                    <option value="kecamatan">{{ __('all.checkbox.district') }}</option>
                                    <option value="desa">{{ __('all.checkbox.village') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="purpose" class="col-sm-3">{{ __('all.category_coordinator') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <select name="kategori[]" id="kategori" class="form-control select2 create-cat" multiple="multiple"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="show_date" class="col-sm-3">{{ __('all.show_date') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control readonly" name="start_date" id="start_date" placeholder="{{ __('all.start_date') }}" readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('all.to') }}</span>
                                    </div>
                                    <input type="text" class="form-control readonly" name="end_date" id="end_date" placeholder="{{ __('all.end_date') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3">{{ __('all.table.title') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="judul" id="title" class="form-control" placeholder="{{ __('all.placeholder.title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3">{{ __('all.table.contents') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <textarea name="isi" id="contents" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.button.back') }}</button>
                            <button type="submit" class="btn btn-success" id="save-ann">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var table = $('#table-chart').DataTable({
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
        "responsive"        : true,
        "columnDefs"        : [ 
            { targets: [0], orderable: false, className	: "text-center" },
            { targets: [9], orderable: false, searchable: false, className	: "text-center" },
        ],
    });

    var tables = $('#table-maps').DataTable({
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
        "responsive"        : true,
        "columnDefs"        : [ 
            { targets: [0], orderable: false, className	: "text-center" },
            { targets: [9], orderable: false, searchable: false, className	: "text-center" },
        ],
    });

    function showForm() {
        showModal('modal-ann', 'postann');
        $('#modal-ann').find('.modal-title').text('{{ __("all.add_ann") }}');
    }

    function showData(params) {
        $.ajax({
            type    : "POST",
            url     : "{{ route('loadListAnnouncement') }}",
            data    : {
                params  : params
            },
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            beforeSend: function(){
                if (params == 1) {
                    table.clear().draw();
                    $("#table-chart").parent().ploading({action : 'show'});
                } else {
                    tables.clear().draw();
                    $("#table-maps").parent().ploading({action : 'show'});
                }
            },
            success     : function(data){
                if (data.code == 0) {
                    list = data.data;       

                    if(list.length > 0){    
                        $.each(list, function(idx, ref){
                            if (params == 1) {  
                                table.row.add( [
                                    idx + 1,
                                    moment.utc(ref.cdate).format('DD MMM YYYY hh:mm:ss'),
                                    ref.tujuan,
                                    ref.kategori,
                                    moment.utc(ref.tanggalMulai).format('DD MMM YYYY'),
                                    moment.utc(ref.tanggalSelesai).format('DD MMM YYYY'),
                                    ref.judul,
                                    ref.isi,
                                    ref.cby,
                                    "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button></div>", 
                                ] ).draw( false );
                            } else { 
                                tables.row.add( [
                                    idx + 1,
                                    moment.utc(ref.cdate).format('DD MMM YYYY hh:mm:ss'),
                                    ref.tujuan,
                                    ref.kategori,
                                    moment.utc(ref.tanggalMulai).format('DD MMM YYYY'),
                                    moment.utc(ref.tanggalSelesai).format('DD MMM YYYY'),
                                    ref.judul,
                                    ref.isi,
                                    ref.cby,
                                    "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button></div>", 
                                ] ).draw( false );
                            }
                        });

                    }
                } 
            },
            complete : function () {
                if (params == 1) {
                    $("#table-chart").parent().ploading({action : 'hide'});
                } else {
                    $("#table-maps").parent().ploading({action : 'hide'});
                }
            }
        })
    }

    showData(1);
    showData(2);

    function showCategory() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListCategory') }}",
            dataType: "JSON",
            success     : function(data){
                if (data.code == 0) {
                    $('#kategori').empty();
                    txt  = '';
                    list = data.data;
                    
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            txt += '<option value="'+ref.name+'">'+ref.name+'</option>';
                        });
                    }

                    $('#kategori').append(txt);
                } 
            },
        });
    }

    showCategory();

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
                            $('#modal-ann').find('.modal-title').text("{{ __('all.add_cat') }}");
                        }
                    });
        }
    });

    function formAnn() {
        $('#modal-ann').find('.modal-title').text("{{ __('all.add_partner') }}");
        $("#form-cat").animate({
            width: [ "toggle", "swing" ],
            height: [ "toggle", "swing" ],
            opacity: "toggle"
        }, 1000, "linear", function() {
            $('#form-ann').show('slow');
        });
    }

    function formCategory() {
        $("#form-ann").animate({
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
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data	: $('#postcat').serialize(),
            dataType: "JSON",
            beforeSend: function(){
                $("#save-cat").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".create-ann").ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                    formAnn();
                    showCategory();
                } else {
                    notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
                }
            },
            complete    : function(){
                $("#save-cat").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $('#cat_name').val('');
                $('#save-cat').attr('disabled', true);
                $(".create-ann").ploading({action : 'hide'});
            },
            error 		: function(){
                notif('error', '{{ __("all.error") }}');
            }
        });
    }

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

    $('#form-cat').hide();

    $('#table-chart tbody').on('click', '.action-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        showModal('modal-ann', 'postann');
        $('#modal-ann').find('.modal-title').text("{{ __('all.edit_ann') }} #"+data[0]);
        $('#id').val($(this).attr('id'));
        $('#kategori').val(data[3]).change();
        $('#tujuan').val(data[2]).change();
        $('#start_date').data('datepicker').selectDate(new Date(data[4]));
        $('#end_date').data('datepicker').selectDate(new Date(data[5]));
        $('#title').val(data[6]);
        $('#contents').val(data[7]);
    });

    $('#table-maps tbody').on('click', '.action-edit', function () {
        var data = tables.row( $(this).parents('tr') ).data();
        showModal('modal-ann', 'postann');
        $('#modal-ann').find('.modal-title').text("{{ __('all.edit_ann') }} #"+data[0]);
        $('#id').val($(this).attr('id'));
        $('#kategori').val(data[3]).change();
        $('#tujuan').val(data[2]).change();
        $('#start_date').data('datepicker').selectDate(new Date(data[4]));
        $('#end_date').data('datepicker').selectDate(new Date(data[5]));
        $('#title').val(data[6]);
        $('#contents').val(data[7]);
    });

    $(document).on('keyup','#cat_name', function () {
        var val = $(this).val();
        if (val.length > 0) {
            $('#save-cat').removeAttr('disabled');
        } else {
            $('#save-cat').attr('disabled', true);
        }
    });

    $("#postann").validate({
        rules       : {
            "tujuan[]"          : "required",
            "kategori[]"        : "required",
            "start_date"        : "required",
            "end_date"          : "required",
            "judul"             : "required",
            "isi"               : "required",
        },
        messages: {
            "tujuan[]"          : "{{ __('all.validation.purpose') }}",
            "kategori[]"        : "{{ __('all.validation.cat') }}",
            "start_date"        : "{{ __('all.validation.sdate') }}",
            "end_date"          : "{{ __('all.validation.edate') }}",
            "judul"             : "{{ __('all.validation.title') }}",
            "isi"               : "{{ __('all.validation.contents') }}",
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
            if (element.attr("name") == "start_date" || element.attr("name") == "end_date") {
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
                url		: "{{ route('createAnnouncement') }}",
                data	: $('#postann').serialize(),
                dataType: "JSON",
                beforeSend: function(){
                    $("#save-ann").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-ann').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                        showData(1);
                        showData(2);
                        resetForm('postann','id');
                        $('#modal-ann').modal('hide');
                    } else {
                        notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
                    }
                },
                complete    : function(){
                    $("#save-ann").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $('.create-ann').ploading({action:'hide'});
                },
                error 		: function(){
                    notif('error', '{{ __("all.error") }}');
                }
            });
        }
    });
</script>
@endsection