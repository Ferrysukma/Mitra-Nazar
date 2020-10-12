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
            <div class="card-header py-3">
                <form action="#" method="post" id="postcategory">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7"></div>
                        <div class="col-sm-3">
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="form-control readonly" placeholder="{{ __('all.placeholder.name_category') }}" name="name" id="category_name">
                        </div>
                        <div class="col-sm-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" id="btnSave" disabled onclick="save()">{{ __('all.save') }}</button>
                                <button type="reset" class="btn btn-info ml-1" onclick="resetData()">{{ __('all.button.reset') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body table-category">
                <div class="table-responsive-sm">
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
@endsection

@section('script')
<script>
    var table = $('#table-maps').DataTable();

    function showData() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('listAll') }}",
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            beforeSend: function(){
                table.clear().draw();
                $(".table-category").parent().ploading({action : 'show'});
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
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-trash'></i></button></div>", 
                            ] ).draw( false );
                        });
                    }
                } 
            },
            complete : function () {
                $(".table-category").parent().ploading({action : 'hide'});
            }
        });
    }

    function resetData() {
        $('#id').val('');
        $('#category_name').val('');
        $('#btnSave').attr('disabled', true);
    }

    function save() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('createCategory') }}",
            data	: $('#postcategory').serialize(),
            dataType: "JSON",
            beforeSend: function(){
                $("#btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                $(".table-category").parent().ploading({action : 'show'});
                $('#category_name').attr('readonly', true);
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
                resetData();
                $(".table-category").parent().ploading({action : 'hide'});
                $('#category_name').removeAttr('readonly');
            },
            error 		: function(){
                notif('error', '{{ __("all.error") }}');
            }
        });
    }

    $('#table-maps tbody').on('click', '.action-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $('#id').val($(this).attr('id'));
        $('#category_name').val(data[2]);
        $('#btnSave').removeAttr('disabled');
    });

    $('#table-maps tbody').on('click', '.action-delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

        disable($(this).attr('id'), data[2]);
    })

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
                        url     : "{{ route('deleteCategory') }}",
                        data	: {
                            id  : id,
                        },
                        dataType: "JSON",
                        beforeSend: function(){
                            $(this).buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                            $(".table-category").parent().ploading({action : 'show'});
                        },
                        success     : function(data){
                            if (data.code == 0) {
                                notif('success', '{{ __("all.success") }}', '{{ __("all.alert.delete") }}');
                                showData();
                                resetData();
                            } else {
                                notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_delete") }}');
                            }
                        },
                        complete    : function(){
                            $(this).buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                            $(".table-category").parent().ploading({action : 'hide'});
                        },
                        error 		: function(){
                            notif('error', '{{ __("all.error") }}');
                        }
                    });
                }
            }
        });
    }

    $(document).on('keyup','#category_name', function () {
        var name = $('#category_name').val();
        if (name != '') {
            $('#btnSave').removeAttr('disabled');
        } else {
            $('#btnSave').attr('disabled', true);
        }
    });
    
    showData();

    // $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection