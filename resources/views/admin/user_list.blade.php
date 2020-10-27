@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.users') }}</h1>
                        <p>{{ __('all.desc_users') }}</p>
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
            <div class="card-header">
                <div class="btn-group" id="gpUser" style="float:right">
                    <button type="button" class="btn btn-primary btn-sm ml-1" id="add-user" onclick="showModal('modal-mitra','postuser')"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                        <i class="fa fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                        <form id="formFilter" class="px-4 py-3" action="#">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" style="width: 100% !important;">
                                    <option value="{{ __('all.active') }}">{{ __('all.active') }}</option>
                                    <option value="{{ __('all.noactive') }}">{{ __('all.noactive') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body table-user">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-user" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th>{{ __('all.form.username') }}</th>
                                <th>{{ __('all.form.email') }}</th>
                                <th>{{ __('all.form.telp') }}</th>
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
        <div class="modal-content create-user">
            <div class="modal-header">
                <h3 class="modal-title text-white"></h3>
                <hr>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="postuser">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.username') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="{{ __('all.placeholder.username') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.email') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="email" name="email" id="mail" class="form-control readonly" placeholder="{{ __('all.placeholder.email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.telp') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" id="phone" class="form-control only-number" placeholder="{{ __('all.placeholder.telp') }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-success" id="btnSave">{{ __('all.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password -->
@endsection

@section('script')
<script>
    var table = $('#table-user').DataTable({
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
            { targets: [5], orderable: false, searchable: false, className	: "text-center" },
        ],
        "initComplete"      : function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });

    function showData() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListUser') }}",
            dataType: "JSON",
            beforeSend: function(){
                table.clear().draw();
                $(".table-user").parent().ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    list = data.data;
                    
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            table.row.add( [
                                idx + 1,
                                ref.nama,
                                ref.email,
                                ref.phone,
                                ref.active,
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-times'></i></button></div>", 
                            ] ).draw( false );
                        });
                    }
                } 
            },
            complete : function () {
                $(".table-user").parent().ploading({action : 'hide'});
            }
        });
    }

    function disable(id, name) {
        bootbox.confirm({
            message: "{{ __('all.confirm_disable') }} <b>"+name+"</b>?",
            buttons: {
                confirm: {
                    label: '{{ __("all.yes") }}',
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
                        url     : "{{ route('deleteUser') }}",
                        data	: {
                            id  : id,
                        },
                        dataType: "JSON",
                        beforeSend: function(){
                            $(this).buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                            $(".table-user").parent().ploading({action : 'show'});
                        },
                        success     : function(data){
                            if (data.code == 0) {
                                notif('success', '{{ __("all.success") }}', '{{ __("all.alert.delete") }}');
                                showData();
                            } else {
                                notif('warning', '{{ __("all.warning") }}', data.info);
                            }
                        },
                        complete    : function(){
                            $(this).buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                            $(".table-user").parent().ploading({action : 'hide'});
                        },
                        error 		: function(){
                            notif('error', '{{ __("all.error") }}');
                        }
                    });
                }
            }
        });
    }

    $(document).on('click','#add-user', function () {
        $('#id').val('');
        $('#mail').removeAttr('readonly');
        $('#modal-mitra').find('.modal-title').text("{{ __('all.add_user') }}");
    });

    $("#table-user tbody").on('click','.action-edit',function(){
        var data = table.row( $(this).parents('tr') ).data();
        showModal('modal-mitra', 'postuser');
        $('#id').val($(this).attr('id'));
        $('#nama').val(data[1]);
        $('#mail').attr('readonly', true).val(data[2]);
        $('#phone').val(data[3]);
        $('#modal-mitra').find('.modal-title').text("{{ __('all.edit_user') }} #"+data[0]);
    });

    $("#table-user").on('click','.action-delete',function(){
        var data = table.row( $(this).parents('tr') ).data();
        var id   = $(this).attr('id');

        disable(id, data[2]);
    });
    
    showData();

    $("#postuser").validate({
        rules       : {
            nama     : "required",
            phone    : "required",
            email    : {
                required    : true,
                email       : true
            }
        },
        messages: {
            nama     : "{{ __('all.validation.username') }}",
            phone    : "{{ __('all.validation.phone') }}",
            email    : {
                required    : "{{ __('all.validation.email') }}",
                email       : "{{ __('all.validation.formatEmail') }}"
            }
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
            if (element.attr("name") == "account_name" ) {
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
                url		: "{{ route('createUser') }}",
                data	: $('#postuser').serialize(),
                dataType: "JSON",
                beforeSend: function(){
                    $("#btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-user').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                        showData();
                        resetForm('postuser');
                        $('#modal-mitra').modal('hide');
                        $('#mail').removeAttr('readonly');
                    } else {
                        notif('warning', '{{ __("all.warning") }}', data.info);
                    }
                },
                complete    : function(){
                    $("#btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $('.create-user').ploading({action:'hide'});
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