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
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-7">
                        <span style="float:right">{{ __('all.datatable.search') }}</span>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="cari" id="cari" class="form-control" placeholder="{{ __('all.placeholder.key') }}">
                    </div>
                    <div class="col-sm-2">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary btn-sm" id="add-user"><i class="fa fa-plus"></i> {{ __('all.button.new') }}</button>
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                                <i class="fa fa-filter"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                                <form id="formFilter" class="px-4 py-3" action="#">
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
            </div>
            <div class="card-body table-user">
                <div class="table-responsive-sm">
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-user" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th style="display: none;">Id</th>
                                <th>{{ __('all.form.username') }}</th>
                                <th>{{ __('all.form.email') }}</th>
                                <th>{{ __('all.form.telp') }}</th>
                                <th>{{ __('all.table.status') }}</th>
                                <th style="text-align:center">{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="showData"></tbody>
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
                <h3 class="modal-title text-white">{{ __('all.add_user') }}</h3>
                <hr>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="postuser">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.username') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="username" id="username" class="form-control" placeholder="{{ __('all.placeholder.username') }}">
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
@endsection

@section('script')
<script>
    function showData() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListUser') }}",
            dataType: "JSON",
            beforeSend: function(){
                $('#showData').empty();
                $(".table-user").parent().ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    $('#showData').html(data.data);
                } 
            },
            complete : function () {
                $(".table-user").parent().ploading({action : 'hide'});
            }
        });
    }

    function resetData() {
        $('#id').val('');
        $('#btnSave').attr('disabled', true);
    }

    function save() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('createUser') }}",
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
                } else {
                    notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
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

    function disable(id, name) {
        bootbox.confirm({
            message: "{{ __('all.confirm_disable') }} <b>"+name+"</b>?",
            buttons: {
                confirm: {
                    label: '{{ __("all.yes") }}',
                    className: 'btn-primary'
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
                                notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_delete") }}');
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
        resetForm('postuser');
        showModal('modal-mitra'); 
    });

    $(document).ready(function(){
        $("#table-maps").on('click','.action-edit',function(){
            var row  = $(this).closest("tr"); 
            
            var col1 = row.find("td:eq(1)").text();
            var col3 = row.find("td:eq(3)").text();

            $('#id').val(col1);
            $('#category_name').val(col3);
            showModal('modal-mitra');
        });

        $("#table-user").on('click','.action-delete',function(){
            var row  = $(this).closest("tr"); 
            
            var col1 = row.find("td:eq(1)").text();
            var col3 = row.find("td:eq(3)").text();

            disable(col1, col3);
        });
    });
    
    showData();

    $(document).on('keyup','#cari', function () {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        var $rows = $('#table-user tbody > tr');

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });

    // $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection