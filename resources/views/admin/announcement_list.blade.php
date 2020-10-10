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
                <div class="table-responsive-sm">
                    <div class="card-title">
                        <h4>{{ __('all.announcement_on') }}</h4>
                    </div>
                    <table class="table table-hover table-striped table-bordered table-condensed" id="table-chart" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="display: none;">Id</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.purpose') }}</th>
                                <th>{{ __('all.start_date') }}</th>
                                <th>{{ __('all.end_date') }}</th>
                                <th>{{ __('all.table.contents') }}</th>
                                <th>{{ __('all.table.created') }}</th>
                                <th>{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="show-active"></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="table-responsive-sm">
                    <div class="card-title">
                        <h4>{{ __('all.announcement_history') }}</h4>
                    </div>
                    <table class="table table-hover table-striped table-bordered table-cosended" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="display: none;">Id</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.purpose') }}</th>
                                <th>{{ __('all.start_date') }}</th>
                                <th>{{ __('all.end_date') }}</th>
                                <th>{{ __('all.table.contents') }}</th>
                                <th>{{ __('all.table.created') }}</th>
                                <th>{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="show-history"></tbody>
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
                                    <input type="text" class="form-control readonly" name="start_date" id="start_date" placeholder="{{ __('all.start_date') }}" readonly autocomplete=off>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('all.to') }}</span>
                                    </div>
                                    <input type="text" class="form-control readonly" name="end_date" id="end_date" placeholder="{{ __('all.end_date') }}" readonly autocomplete=off>
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
                            <button type="submit" class="btn btn-primary" id="save-ann">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>

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
                            <button type="submit" class="btn btn-primary" id="save-cat" disabled onClick="saveCat()">{{ __('all.save') }}</button>
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
    function showForm() {
        showModal('modal-ann', 'postann');
        $('#modal-ann').find('.modal-title').text('{{ __("all.add_ann") }}');
    }

    function showData(params) {
        $.ajax({
            type    : "POST",
            url     : "{{ route('loadListAnnouncement') }}",
            data    : {
                limit   : 10,
                page    : 0,
                params  : params
            },
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            beforeSend: function(){
                if (params == 1) {
                    $('#show-active').empty();
                    $("#table-chart").parent().ploading({action : 'show'});
                } else {
                    $('#show-history').empty();
                    $("#table-maps").parent().ploading({action : 'show'});
                }
            },
            success     : function(data){
                if (data.code == 0) {
                    if (params == 1) {
                        $('#show-active').html(data.data);
                    } else {
                        $('#show-history').html(data.data);
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
            url     : "{{ route('listAll') }}",
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
    
    $(document).on('keyup','#cat_name', function () {
        var name = $('#cat_name').val();
        if (name != '') {
            $('#save-cat').removeAttr('disabled');
        } else {
            $('#save-cat').attr('disabled', true);
        }
    });

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

    $('#postann').bootstrapValidator({
        container: 'tooltip',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            "tujuan[]": {
                validators: {
                    notEmpty: {
                        message: '<b class="text-danger">*{{ __("all.validation.purpose") }}</b>'
                    },
                }
            },
            "kategori[]": {
                validators: {
                    notEmpty: {
                        message: '<b class="text-danger">*{{ __("all.validation.cat") }}</b>'
                    },
                }
            },
            start_date: {
                validators: {
                    notEmpty: {
                        message: '<b class="text-danger">*{{ __("all.validation.sdate") }}</b>'
                    },
                }
            },
            end_date: {
                validators: {
                    notEmpty: {
                        message: '<b class="text-danger">*{{ __("all.validation.edate") }}</b>'
                    },
                }
            },
            judul: {
                validators: {
                    notEmpty: {
                        message: '<b class="text-danger">*{{ __("all.validation.title") }}</b>'
                    },
                }
            },
            isi: {
                validators: {
                    notEmpty: {
                        message: '<b class="text-danger">*{{ __("all.validation.contents") }}</b>'
                    },
                }
            },
        },
        submitHandler : function (form) {
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
                        $('#modal-mitra').modal('hide');
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