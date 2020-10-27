@extends('user.master')

@section('contentUser')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.home') }}</h1>
                        <p>{{ __('all.welcome') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header bg-warning py-3">
                <h6 class="m-0 font-weight-bold text-white">{{ __('all.info') }}</h6>
            </div>
            <div class="card-body">
                {{ __('all.config_comment') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('all.profil') }}</h6>
            </div>
            <div class="card-body" id="formProfile">
                <form action="#" method="post" id="postprofile">
                    <input type="hidden" name="id" id="idPro">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">ID Downline <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="id" id="userCode" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.name') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('all.placeholder.name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.gender') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="man" value="L">
                                <label class="form-check-label" for="man">
                                    {{ __('all.male') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="woman" value="P">
                                <label class="form-check-label" for="woman">
                                    {{ __('all.female') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.dateBirth') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="birthday" id="birthday" class="form-control" readonly placeholder="{{ __('all.placeholder.dateofbirth') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.img') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="file" name="img_upload" id="img_upload" data-height="30vh" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="1M" data-show-remove="false" class="dropify">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.coordinator_type') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="tipe" id="tipe" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.category_coordinator') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="kategori" id="kategori" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.prov') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="provinsi" id="provinsi" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.city') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="kota" id="kota" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.district') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.table.village') }} </label>
                        <div class="col-sm-9">
                            <input type="text" name="desa" id="desa" class="form-control" readonly>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div style="float:right">
                    <button type="submit" class="btn btn-success" id="save-profile">{{ __('all.save') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-primary">Banking</h6>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary btn-sm float-right" id="add-account"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-bank">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bank</th>
                                <th>{{ __('all.form.account_name') }}</th>
                                <th>{{ __('all.form.account') }}</th>
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
<div class="modal fade" id="modal-account" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content create-account">
            <div class="modal-header">
                <h5 class="modal-title text-white">{{ __('all.') }}</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="postbank">
                    <input type="hidden" name="id" id="idBank">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">Bank<sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <select name="kodeBank" id="kodeBank" class="form-control select2"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.account') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="nomorRekening" id="nomorRekening" class="form-control only-number" placeholder="{{ __('all.placeholder.account') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.account_name') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="namaPemilikRekening" id="namaPemilikRekening" class="form-control" placeholder="{{ __('all.placeholder.account_name') }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-success" id="save-bank">{{ __('all.save') }}</button>  
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptUser')
<script>
    var table = $('#table-bank').DataTable({
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
        "paging"            : false,
        "info"              : false,
        "columnDefs"        : [ 
            { targets: [0], orderable: false, className	: "text-center" },
            { targets: [4], orderable: false, searchable: false, className	: "text-center" },
        ],
        "initComplete"      : function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });

    $(document).on('click','#add-account', function () {
        showModal('modal-account', 'postbank');
        $('#kodeBank').val('').change();
        $('#modal-account').find('.modal-title').text("{{ __('all.add_bank') }}");
    });

    function loadListBank() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "GET",
            url     : "{{ route('account') }}",
            dataType: "JSON",
            beforeSend: function(){
                table.clear().draw();
                $("#table-bank").parent().ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    list = data.data.data;

                    if (data.data.count >= 5) {
                        $('#add-account').hide();
                    } else {
                        $('#add-account').show();
                    }
                    
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            table.row.add( [
                                idx + 1,
                                ref.namaBank,
                                ref.namaPemilikRekening,
                                ref.nomorRekening,
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"' code='"+ref.bankId+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.drop.remove') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-times'></i></button></div>", 
                            ] ).draw( false );
                        });
                    }
                } 
            },
            complete : function () {
                $("#table-bank").parent().ploading({action : 'hide'});
            }
        });
    }

    loadListBank();

    $('#table-bank tbody').on('click', '.action-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        showModal('modal-account', 'postbank');
        $('#modal-account').find('.modal-title').text("{{ __('all.edit_bank') }} #"+data[0]);
        $('#idBank').val($(this).attr('id'));
        $('#kodeBank').val($(this).attr('code')).change();
        $('#namaPemilikRekening').val(data[2]);
        $('#nomorRekening').val(data[3]);
    });

    $('#table-bank tbody').on('click', '.action-delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

        disable($(this).attr('id'), data[2]);
    });

    function disable(id, name) {
        bootbox.confirm({
            message: "{{ __('all.confirm_delete') }} <b>"+name+"</b>?",
            buttons: {
                confirm: {
                    label: '{{ __("all.doit") }}',
                    className: 'btn-success'
                },
                cancel: {
                    label: '{{ __("all.cancel") }}',
                    className: 'btn-secondary'
                }
            },
            callback: function (res) {
                if(res){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type    : "POST",
                        url     : "{{ route('disabledBank') }}",
                        data	: {
                            id  : id,
                        },
                        dataType: "JSON",
                        beforeSend: function(){
                            $(this).buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                            $("#table-bank").parent().ploading({action : 'show'});
                        },
                        success     : function(data){
                            if (data.code == 0) {
                                notif('success', '{{ __("all.success") }}', data.info);
                                loadListBank();
                            } else {
                                notif('warning', '{{ __("all.warning") }}', data.info);
                            }
                        },
                        complete    : function(){
                            $(this).buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                            $("#table-bank").parent().ploading({action : 'hide'});
                        },
                        error 		: function(){
                            notif('error', '{{ __("all.error") }}');
                        }
                    });
                }
            }
        });
    }

    $('#birthday').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
    });

    startDate   = new Date();
    endDate     = startDate.setDate((startDate.getDate() - 1));
    $('#birthday').data('datepicker')
        .update('maxDate', new Date(endDate));

    function profile() {
        $('#formProfile').ploading({action:'show'});

        $.ajax({
            type    : "GET",
            url     : "{{ route('showHome') }}",
            dataType: "JSON",
            success : function (res) {
                // profile
                profile = res.data.profile;
                setting(profile, profile.koordinatorProfile);

                $('#formProfile').ploading({action:'hide'});
            } 
        })
    }

    function profileUser() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('profile') }}",
            dataType: "JSON",
            success : function (res) {
                if (res.data.gender == 'L') {
                    $('#man').attr('checked', true);
                } else {
                    $('#woman').attr('checked', true);
                }
            } 
        })
    }

    profileUser();

    function setting(res, data) {
        $('#idPro').val(data.id);
        $('#userCode').val(data.userCode);
        $('#name').val(res.name);
        $('#tipe').val(data.tipe);
        $('#kategori').val(data.kategori);
        $('#provinsi').val(data.provinsi);
        $('#kota').val(data.kota);
        $('#kecamatan').val(data.kecamatan);
        $('#desa').val(data.desa);
        $("#img_upload").attr("data-default-file", res.image);
        $('.dropify').dropify();
        $('#birthday').val(moment.utc(data.birthday).format('DD MMM YYYY'));
    }

    profile();

    function listBank() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('listBank') }}",
            dataType: "JSON",
            success     : function(data){
                if (data.code == 0) {
                    $('#kodeBank').empty();
                    txt  = '';
                    list = data.data;
                    
                    txt += '<option value="" selected>{{ __("all.placeholder.choose_bank") }}</option>';
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            txt += '<option value="'+ref.kodeBank+'">'+ref.namaBank+'</option>';
                        });
                    }

                    $('#kodeBank').append(txt);
                } 
            },
        });
    }

    listBank();

    $("#postprofile").validate({
        rules       : {
            userCode        : "required",
            name            : "required",
            tipe            : "required",
            kategori        : "required",
            provinsi        : "required",
            kecamatan       : "required",
            kota            : "required",
            birthday        : "required",
            // img_upload      : "required",
            gender          : "required",
        },
        messages: {
            userCode        : "{{ __('all.validation.userCode') }}",
            name            : "{{ __('all.validation.name') }}",
            tipe            : "{{ __('all.validation.tipe') }}",
            kategori        : "{{ __('all.validation.cat') }}",
            provinsi        : "{{ __('all.validation.province') }}",
            kecamatan       : "{{ __('all.validation.district') }}",
            kota            : "{{ __('all.validation.city') }}",
            birthday        : "{{ __('all.validation.birthday') }}",
            // img_upload      : "{{ __('all.validation.img_upload') }}",
            gender          : "{{ __('all.validation.gender') }}",
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
            if (element.attr("name") == "password" ) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler           : function(form) {
            var data = new FormData();
                data.append('img_upload', $('#img_upload')[0].files[0]);
                // data.append('img_upload', $('.dropify-render').find('img').attr('src'));
                data.append('id', $("#idPro").val()); 
                data.append('name', $("#name").val()); 
                data.append('gender', $('input[name=gender]:checked', '#postprofile').val()); 
                data.append('birthday', $("#birthday").val()); 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type	    : "POST",
                url		    : "{{ route('editProfile') }}",
                dataType    : "JSON",
                data        : data,
                enctype     : 'multipart/form-data',
                processData : false,  // Important!
                contentType : false,
                cache       : false,
                beforeSend: function(){
                    $("#save-profile").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('#formProfile').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', data.info);
                    } else {
                        notif('warning', '{{ __("all.warning") }}', data.info);
                    }
                },
                complete    : function(){
                    $("#save-profile").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $('#formProfile').ploading({action:'hide'});
                },
                error 		: function(){
                    notif('error', '{{ __("all.error") }}');
                }
            });
        }
    });

    $("#postbank").validate({
        rules       : {
            kodeBank            : "required",
            nomorRekening       : "required",
            namaPemilikRekening : "required",
        },
        messages: {
            kodeBank            : "{{ __('all.validation.bank') }}",
            nomorRekening       : "{{ __('all.validation.no_rek') }}",
            namaPemilikRekening : "{{ __('all.validation.account_name') }}",
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
            if (element.attr("name") == "password" ) {
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
                type	    : "POST",
                url		    : "{{ route('createBank') }}",
                data	    : $('#postbank').serialize(),
                dataType    : "JSON",
                beforeSend: function(){
                    $("#save-bank").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-account').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', data.info);
                        resetForm('postbank');
                        loadListBank();
                        $('#modal-account').modal('hide');
                    } else {
                        notif('warning', '{{ __("all.warning") }}', data.info);
                    }
                },
                complete    : function(){
                    $("#save-bank").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $('.create-account').ploading({action:'hide'});
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