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
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('all.profil') }}</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 12rem;" alt="" id="imageUser">
                </div>
                <div align="center">
                    <p><b id="coor"></b></p>
                    <b>#</b> <b id="copy">Hello</b> <br>
                    <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#copy')">{{ __('all.button.copy') }}</button>
                    <br><br>
                    <b id="rupiah">Rupiah</b> <br>
                    <button class="btn btn-sm btn-info" onclick="getSaldo()">{{ __('all.button.take') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('all.comition') }}</h6>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3" style="float:right">
                        <select name="perio" id="period" class="form-control select2" onchange="grafikBar()">
                            @for ($i = 2020; $i <= 2030; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="bar-chart-bs" style="position: relative; height:auto; width:auto">
                    <canvas id="bar-canvas-bs"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-2">
        <div class="card shadow mb-4">
            <div class="card-header bg-warning py-3">
                <h6 class="m-0 font-weight-bold text-white">{{ __('all.info') }}</h6>
            </div>
            <div class="card-body">
                {{ __('all.comment_info') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('all.announcement') }}</h6>
            </div>
            <div class="card-body">
                The styling for this basic card example is created by using default Bootstrap utility classes. By using utility classes, the style of the card component can be easily modified with no need for any custom CSS!
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-5">
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('all.checkbox.regional') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('all.checkbox.city') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('all.checkbox.district') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('all.checkbox.village') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-balance" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content create-balance">
            <div class="modal-header">
                <h5 class="modal-title text-white">{{ __('all.button.take') }}</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="postbalance">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.balance') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="saldo" id="saldo" class="form-control readonly" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.qtyTake') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="email" name="amount" id="amount" class="form-control amount" placeholder="{{ __('all.placeholder.qtyTake') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">Bank <sup class="text-danger">*</sup></label>
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
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.telp') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('all.placeholder.password') }}" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary input-group-text" id="basic-addon1" onclick="changeIcon('basic-addon1','password')"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-primary" id="save-balance">{{ __('all.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptUser')
<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function changeIcon(id, kd) {
        if ($('#'+id).find('i').hasClass('fa fa-eye')) {
            $('#'+id).find('i').attr('class','fa fa-eye-slash');
            $('#'+kd).attr('type','text');
        } else {
            $('#'+id).find('i').attr('class','fa fa-eye');
            $('#'+kd).attr('type','password');
        }
    }

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function getSaldo() {
        showModal('modal-balance', 'postbalance');
        $('#saldo').val($('#rupiah').text());        
    }

    function home() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('showHome') }}",
            dataType: "JSON",
            success : function (res) {
                // profile
                profile = res.data.profile;
                setting(profile.image, profile.koordinatorProfile);
            } 
        })
    }

    function balance() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('balance') }}",
            dataType: "JSON",
            success : function (res) {
                $('#rupiah').text(number_format(res.data.balActive));
            } 
        })
    }

    balance();

    function setting(res, data) {
        $('#imageUser').attr('src', res);
        $('#coor').text(data.tipe)
        $('#copy').text(data.userCode);
    }

    home();

    function grafikBar() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('comition') }}",
            data    : {
                _token  : "{{ csrf_token() }}",
                year    : $('#period').val()
            },
            dataType: "JSON",
            beforeSend: function(){
                $('#bar-chart-bs').ploading({action: 'show'});
            },
            success : function(res){
                var x  = [];
                var y  = [];
                
                list = res.data;
                if (list.length > 0) {
                    $(list).each(function(i){  
                        x.push(list[i].periode); 
                        y.push(list[i].amount);
                    });
                }

                $('#bar-canvas-bs').remove(); $('#bar-chart-bs').append('<canvas id="bar-canvas-bs"><canvas>');
                var ctx = document.getElementById('bar-canvas-bs').getContext('2d');
                var MyChart = new Chart(
                    ctx,
                    {
                        type: 'bar',
                        data: {
                            labels: x,
                            datasets: [{
                                data            : y,
                                backgroundColor : ['#2980D0', '#2A516E','#F07124','#CBE0E3','#979193','#eb4034','#28423f','#54234f','#7583bd','#7ca368','#1d4f24','#707027','#afdeed','#0cb7ed','#303c40'],
                                backgroundColor : ['#2980D0', '#2A516E','#F07124','#CBE0E3','#979193','#eb4034','#28423f','#54234f','#7583bd','#7ca368','#1d4f24','#707027','#afdeed','#0cb7ed','#303c40'],
                            }],
                        },
                        options: {
                            legend: { display: false },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        callback: function(value, index, values) {
                                            return number_format(value);
                                        }
                                    }
                                }]
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, chart){
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                        return datasetLabel + '' + number_format(tooltipItem.yLabel, 2);
                                    }
                                }
                            }
                        }
                    }
                );
            },
            complete : function () {
                $('#bar-chart-bs').ploading({action: 'hide'});
            }
        })
    }

    grafikBar();

    $("#postbalance").validate({
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type	: "POST",
                url		: "{{ route('balance') }}",
                data	: $('#postbalance').serialize(),
                dataType: "JSON",
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