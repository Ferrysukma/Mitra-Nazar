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
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">ID Downline <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="id" id="userCode" class="form-control readonly" readonly>
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
                                <input class="form-check-input" type="radio" name="exampleRadios" id="man" value="laki-laki">
                                <label class="form-check-label" for="man">
                                    {{ __('all.male') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="woman" value="perempuan">
                                <label class="form-check-label" for="woman">
                                    {{ __('all.female') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.dateBirth') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="birthday" id="birthday" class="form-control readonly" readonly placeholder="{{ __('all.placeholder.dateofbirth') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.img') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="file" class="dropify" name="img_upload" id="img_upload" data-height="300" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div style="float:right">
                    <button type="submit" class="btn btn-primary" id="save-profile">{{ __('all.save') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Banking</h6>
            </div>
            <div class="card-body" id="formBank">
                <form action="#" method="post" id="postbank">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">Bank<sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <select name="bank" id="bank" class="form-control select2"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.account') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_rek" id="no_rek" class="form-control only-number" placeholder="{{ __('all.placeholder.telp') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.account_name') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="{{ __('all.placeholder.account_name') }}">
                        </div>
                    </div>
                    <hr>
                    <div align="right">
                        <button type="submit" class="btn btn-primary" id="save-bank">{{ __('all.save') }}</button>
                    </div>
                </form>
            </div>
            <div class="card-footer" id="tableBank">
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
@endsection

@section('scriptUser')
<script>
    $('.dropify').dropify({
        messages: {
            default: "{{ __('all.drop.drag') }}",
            replace: "{{ __('all.drop.replace') }}",
            remove:  "{{ __('all.drop.remove') }}",
            error:   'error'
        }
    });

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
        $.ajax({
            type    : "GET",
            url     : "{{ route('showHome') }}",
            dataType: "JSON",
            success : function (res) {
                // profile
                profile = res.data.profile;
                setting(profile, profile.koordinatorProfile);
            } 
        })
    }

    function setting(res, data) {
        $('#userCode').val(data.userCode);
        $('#name').val(res.name);
        $('#img_upload').attr("data-default-file", res.image);
        $('#birthday').val(moment.utc(data.birthday).format('DD MMM YYYY'))
    }

    profile();

    $("#postprofile").validate({
        rules       : {
            saldo           : "required",
            amount          : "required",
            bank            : "required",
            account_name    : "required",
            no_rek          : "required",
            password        : "required",
        },
        messages: {
            saldo           : "{{ __('all.validation.saldo') }}",
            amount          : "{{ __('all.validation.amount') }}",
            bank            : "{{ __('all.validation.bank') }}",
            account_name    : "{{ __('all.validation.account_name') }}",
            no_rek          : "{{ __('all.validation.no_rek') }}",
            password        : "{{ __('all.validation.password') }}",
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
            if (element.attr("name") == "password" ) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler           : function(form) {
            var data = new FormData();
                data.append('img_upload', $('#img_upload')[0].files[0]);
                data.append('tanggal', $("#tanggal").val()); 
                data.append('parent_name', $("#parent").val()); 
                data.append('description', $("#description").val()); 
                data.append('kavling_id', $("#kavling_id").val()); 
                data.append('progress', $("#progress").val()); 
                data.append('before', $("#before").val()); 
                data.append('component_id', $("#component_id").val()); 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type	    : "POST",
                url		    : "{{ route('balance') }}",
                data	    : $('#postbalance').serialize(),
                dataType    : "JSON",
                data        : data,
                enctype     : 'multipart/form-data',
                processData : false,  // Important!
                contentType : false,
                cache       : false,
                beforeSend: function(){
                    $("#save-balance").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-balance').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                        resetForm('postbalance');
                        $('#modal-balance').modal('hide');
                    } else {
                        notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
                    }
                },
                complete    : function(){
                    $("#save-balance").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $('.create-balance').ploading({action:'hide'});
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