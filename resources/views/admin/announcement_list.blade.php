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
                <div class="container-fluid">
                    <form action="#" method="post" id="postann">
                        <div class="form-group row">
                            <label for="purpose" class="col-sm-3">{{ __('all.table.purpose') }}</label>
                            <div class="col-sm-9">
                                <div class="fm-checkbox row">
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> {{ __('all.checkbox.central') }} </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> {{ __('all.checkbox.regional') }} </label>
                                    </div>
                                </div>
                                <div class="fm-checkbox row">
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> {{ __('all.checkbox.city') }} </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> {{ __('all.checkbox.district') }} </label>
                                    </div>
                                </div>
                                <div class="fm-checkbox row">
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> {{ __('all.checkbox.village') }} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="purpose" class="col-sm-3">{{ __('all.category_coordinator') }}</label>
                            <div class="col-sm-9">
                                <div class="fm-checkbox row">
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> Example 1 </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> Example 2 </label>
                                    </div>
                                </div>
                                <div class="fm-checkbox row">
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> Example 3 </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> Example 4 </label>
                                    </div>
                                </div>
                                <div class="fm-checkbox row">
                                    <div class="col-sm-6">
                                        <label><input type="checkbox" class="i-checks"> Example 5 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="show_date" class="col-sm-3">{{ __('all.show_date') }}</label>
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
                            <label for="title" class="col-sm-3">{{ __('all.table.title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('all.placeholder.title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3">{{ __('all.table.contents') }}</label>
                            <div class="col-sm-9">
                                <textarea name="contents" id="contents" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.button.back') }}</button>
                            <button type="submit" class="btn btn-primary" id="save-ann">{{ __('all.save') }}</button>
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
</script>
@endsection