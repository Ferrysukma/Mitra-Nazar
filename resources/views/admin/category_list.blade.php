@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h3 mb-0 text-gray-800">{{ __('all.category_coordinator') }}</h1>
                        <p>{{ __('all.desc_category') }}</p>
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
                <div class="btn-group" id="gpCat" style="float:right">
                    <button type="button" class="btn btn-primary btn-sm ml-1" onclick="modalshow()">
                        <i class="fa fa-plus"></i> {{ __('all.button.new') }}
                    </button>
                </div>
            </div>
            <div class="card-body table-category">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-consended" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.name_category') }}</th>
                                <th>{{ __('all.table.created') }}</th>
                                <th style="text-align:center">{{ __('all.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="pagination-container">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cat" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content create-cat">
            <div class="modal-header">
                <h3 class="modal-title text-white"></h3>
                <hr>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="postcat">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label for="cat" class="col-sm-3">{{ __('all.category_coordinator') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="cat_name" placeholder="{{ __('all.placeholder.name_category') }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-success" id="save-cat">{{ __('all.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
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
            { targets: [4], orderable: false, searchable: false, className	: "text-center" },
        ],
        "initComplete"      : function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });

    function modalshow() {
        resetData();
        showModal('modal-cat', 'postcat');
        $('#modal-cat').find('.modal-title').text("{{ __('all.add_cat') }}");
    }

    function showData() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListCategory') }}",
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
                                ref.cdate,
                                ref.name,
                                ref.cby,
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-times'></i></button></div>", 
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

    function resetData() {
        $('#id').val('');
        $('#category_name').val('');
    }

    function save() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('createCategory') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data	: $('#postcat').serialize(),
            dataType: "JSON",
            beforeSend: function(){
                $("#save-cat").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".create-cat").ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                    showData();
                    resetData();
                    resetForm('postcat');
                    $('#modal-cat').modal('hide');
                } else {
                    notif('warning', '{{ __("all.warning") }}', data.info);
                }
            },
            complete    : function(){
                $("#save-cat").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                $(".create-cat").ploading({action : 'hide'});
            },
            error 		: function(){
                notif('error', '{{ __("all.error") }}');
            }
        });
    }

    $('#table-maps tbody').on('click', '.action-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        resetData();
        showModal('modal-cat', 'postcat');
        $('#modal-cat').find('.modal-title').text("{{ __('all.edit_cat') }} #"+data[0]);
        $('#id').val($(this).attr('id'));
        $('#cat_name').val(data[2]);
    });

    $('#table-maps tbody').on('click', '.action-delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

        disable($(this).attr('id'), data[2]);
    });

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
                        url     : "{{ route('deleteCategory') }}",
                        data	: {
                            id  : id,
                        },
                        dataType: "JSON",
                        beforeSend: function(){
                            $(this).buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                            $("#table-maps").parent().ploading({action : 'show'});
                        },
                        success     : function(data){
                            if (data.code == 0) {
                                notif('success', '{{ __("all.success") }}', '{{ __("all.alert.delete") }}');
                                showData();
                                resetData();
                            } else {
                                notif('warning', '{{ __("all.warning") }}', data.info);
                            }
                        },
                        complete    : function(){
                            $(this).buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                            $("#table-maps").parent().ploading({action : 'hide'});
                        },
                        error 		: function(){
                            notif('error', '{{ __("all.error") }}');
                        }
                    });
                }
            }
        });
    }
    
    showData();

    $("#postcat").validate({
        rules       : {
            name     : "required",
        },
        messages: {
            name     : "{{ __('all.validation.cat_name') }}",
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
            save();
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection