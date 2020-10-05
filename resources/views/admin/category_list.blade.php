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
                            <input type="text" class="form-control" placeholder="{{ __('all.placeholder.name_category') }}" name="name" id="category_name">
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
                    <div class="row">
                        <div class="col-sm-9">
                            <span style="float:right">{{ __('all.datatable.search') }}</span>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="cari" id="cari" class="form-control" placeholder="{{ __('all.placeholder.key') }}">
                        </div>
                    </div><br>
                    <table class="table table-hover table-striped table-bordered table-consended" id="table-maps" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th style="display: none;">Id</th>
                                <th>{{ __('all.table.create_dtm') }}</th>
                                <th>{{ __('all.table.name_category') }}</th>
                                <th>{{ __('all.table.created') }}</th>
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
@endsection

@section('script')
<script>
    function showData() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListCategory') }}",
            dataType: "JSON",
            beforeSend: function(){
                $('#showData').empty();
                $(".table-category").parent().ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    $('#showData').html(data.data);
                } 
            },
            complete : function () {
                $(".table-category").parent().ploading({action : 'hide'});
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
            url     : "{{ route('createCategory') }}",
            data	: $('#postcategory').serialize(),
            dataType: "JSON",
            beforeSend: function(){
                $("#btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
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
                $('#category_name').removeAttr('readonly');
            },
            error 		: function(){
                notif('error', '{{ __("all.error") }}');
            }
        });
    }

    $(document).ready(function(){
        $("#table-maps").on('click','.action-edit',function(){
            var row  = $(this).closest("tr"); 
            
            var col1 = row.find("td:eq(1)").text();
            var col3 = row.find("td:eq(3)").text();

            $('#id').val(col1);
            $('#category_name').val(col3);
            $('#btnSave').removeAttr('disabled');
        });
    });


    $(document).on('keyup','#category_name', function () {
        var name = $('#category_name').val();
        if (name != '') {
            $('#btnSave').removeAttr('disabled');
        } else {
            $('#btnSave').attr('disabled', true);
        }
    });
    
    showData();

    $(document).on('keyup','#cari', function () {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        var $rows = $('#table-maps tbody > tr');

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });

    // $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection