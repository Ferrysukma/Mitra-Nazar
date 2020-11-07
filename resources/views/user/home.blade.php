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
                        <p>{{ __('all.welcome_us') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="cardHome">

    <div class="col-lg-4">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('all.profil') }}</h6>
            </div>
            <div class="card-body" style="max-height:100vh;min-height:80vh">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 12rem;" alt="" id="imageUser">
                </div>
                <div align="center">
                    <p><b id="coor"></b></p>
                    <b>#</b> <b id="copy"></b> <br>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#copy')">Bagikan</button>
                        <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="btn btn-primary btn-sm ml-1"><i class="fab fa-facebook-f"></i> Bagikan</a></div>
                    </div>

                    <br><br>
                    <b>Rp.</b> <b id="rupiah"></b> <br>
                    <button class="btn btn-sm btn-info" onclick="getSaldo()">{{ __('all.button.take') }}</button>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('all.announcement') }}</h6>
            </div>
            <div class="card-body" style="min-height:35vh">
                <div id="slideControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" id="showAnn"></div>
                    <a class="carousel-control-prev" href="#slideControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" style="color:#000; index-z:9999999"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slideControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" style="color:#000; index-z:9999999"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-8">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('all.comition') }}</h6>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3" style="float:right">
                        <select name="period" id="period" class="form-control select2" onchange="grafikBar()">
                            @for ($i = 2020; $i <= 2030; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100vh;min-height:77vh">
                <div id="bar-chart-bs" style="position: relative; height:auto; width:auto">
                    <canvas id="bar-canvas-bs"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <a href="{{ route('partnerUser', 'provinsi') }}">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.regional') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="countR" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <a href="{{ route('partnerUser', 'kota') }}">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.city') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="countC" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('partnerUser', 'kecamatan') }}">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.district') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="countD" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('partnerUser', 'desa') }}">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" align="center">{{ __('all.checkbox.village') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="countV" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>
<br><br>
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary input-group-text">Rp</button>
                                </div>
                                <input type="text" name="saldo" id="saldo" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.type') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="one" value="1" onclick="changeType(1)">
                                <label class="form-check-label" for="one">
                                    Manual
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="two" value="2" onclick="changeType(2)">
                                <label class="form-check-label" for="two">
                                    {{ __('all.form.otomatic') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="idType">
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">Bank <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <select name="kodeBank" id="bank" class="form-control select2" onchange="fillDetail()"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.account') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="nomorRekening" id="no_rek" class="form-control only-number manual" placeholder="{{ __('all.placeholder.account') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.account_name') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <input type="text" name="pemilikRekening" id="account_name" class="form-control manual" placeholder="{{ __('all.placeholder.account_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">PIN <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('all.placeholder.pin') }}" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary input-group-text" id="basic-addon1" onclick="changeIcon('basic-addon1','password')"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old" class="col-sm-3">{{ __('all.form.qtyTake') }} <sup class="text-danger">*</sup></label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary input-group-text">Rp</button>
                                </div>
                                <input type="text" name="nominal" id="amount" class="form-control amount" placeholder="{{ __('all.placeholder.qtyTake') }}">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                <button type="submit" class="btn btn-success" id="save-balance">{{ __('all.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="fb-root"></div>
@endsection

@section('scriptUser')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v8.0" nonce="mvxPrWKX"></script>
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
        $('#one').attr('checked', true);
        $('#saldo').val($('#rupiah').text());        
    }

    function home() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('showHome') }}",
            dataType: "JSON",
            beforeSend : function () {
                $('#cardHome').ploading({action:"show"});
            },
            success : function (res) {
                // profile
                profile = res.data.profile;
                setting(profile.image, profile.koordinatorProfile);

                // pengumuman
                setAnn(res.data.pengumuman);

                //downline
                downline(res.data.downline)
            },
            complete : function () {
                $('#cardHome').ploading({action:"hide"});
            }
        })
    }

    function downline(res) {
        var prov = res.provinsi;
        var city = res.kota;
        var dist = res.kecamatan;
        var vill = res.desa;

        if (prov == '' || prov == null) { prov = 0 }
        if (city == '' || city == null) { city = 0 }
        if (dist == '' || dist == null) { dist = 0 }
        if (vill == '' || vill == null) { vill = 0 }

        $('#countR').text(prov);
        $('#countC').text(city);
        $('#countD').text(dist);
        $('#countV').text(vill);
    }

    function changeType(id) {
        if (id == 2) {
            $('#two').attr('checked', true);
            $('#one').removeAttr('checked');
            $('#idType').val(2);
            $('.manual').attr('readonly', true);
            listBank();
        } else {
            getBank();
            $('#one').attr('checked', true);
            $('#two').removeAttr('checked');
            $('#idType').val(1);
            $('.manual').removeAttr('readonly');
        }

        fillDetail();
    }

    changeType(1);

    function fillDetail() {
        var id      = $('#bank').val();
        var type    = $('#idType').val();

        if (type == 2) {
            var split   = id.split('~');
            $('#no_rek').val(split[2]);
            $('#account_name').val(split[3]);
        } else {
            $('#no_rek').val('');
            $('#account_name').val('');
        }
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

    function setAnn(res) {
        $('#showAnn').empty();
        if (res.length > 0) {
            txt = '';
            $(res).each(function (idx, data) {
                if (idx == 0) {
                    var active = 'active';
                } else {
                    var active = '';
                }

                txt += '<div class="carousel-item '+active+'">';
                txt +=      '<div class="card border shadow h-100 py-2">';
                txt +=          '<div class="card-body">';
                txt +=              '<div class="row no-gutters align-items-center">';
                txt +=                  '<div class="col mr-2 text-center">';
                txt +=                      '<div class="text-lg font-weight-bold text-uppercase mb-1">'+data.judul+'</div>';
                txt +=                      '<div class="h5 mb-0 text-gray-800">'+data.isi+'</div>';
                txt +=                  '</div>';
                txt +=              '</div>';
                txt +=          '</div>';
                txt +=      '</div>';
                txt += '</div>';
            });

            $('#showAnn').append(txt);
        }
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
        })
    }

    grafikBar();

    function listBank() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('account') }}",
            dataType: "JSON",
            success     : function(data){
                if (data.code == 0) {
                    $('#bank').empty();
                    txt  = '';
                    list = data.data.data;

                    txt += '<option value="" selected disabled>{{ __("all.placeholder.choose_bank") }}</option>';
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            txt += '<option value="'+ref.bankInfo.kodeBank+'~'+ref.namaBank+'~'+ref.nomorRekening+'~'+ref.namaPemilikRekening+'">'+ref.namaBank+' ~ '+ref.nomorRekening+' ~ '+ref.namaPemilikRekening+'</option>';
                        });
                    }

                    $('#bank').append(txt);
                } 
            },
        });
    }

    function getBank() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('listBank') }}",
            dataType: "JSON",
            success     : function(data){
                if (data.code == 0) {
                    $('#bank').empty();
                    txt  = '';
                    list = data.data;
                    
                    txt += '<option value="" selected>{{ __("all.placeholder.choose_bank") }}</option>';
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            txt += '<option value="'+ref.kodeBank+'~'+ref.namaBank+'">'+ref.namaBank+'</option>';
                        });
                    }

                    $('#bank').append(txt);
                } 
            },
        });
    }

    $("#postbalance").validate({
        rules       : {
            nominal         : "required",
            kodeBank        : "required",
            pemilikRekening : "required",
            nomorRekening   : "required",
            password        : {
                required    : true,
                maxlength   : 6
            }
        },
        messages: {
            nominal         : "{{ __('all.validation.amount') }}",
            kodeBank        : "{{ __('all.validation.bank') }}",
            pemilikRekening : "{{ __('all.validation.account_name') }}",
            nomorRekening   : "{{ __('all.validation.no_rek') }}",
            password        : {
                required    : "{{ __('all.validation.password') }}",
                maxlength   : "{{ __('all.validation.maxPin') }}",
            }
        },
        errorClass      : "invalid-feedback",
        errorElement    : "div",
        highlight: function (element, errorClass, validClass) {
            var check = $(element).attr('readonly');
            if (typeof check == 'undefined' && $(element).attr('name') != "password") {
                $(element).addClass('is-invalid').removeClass('is-valid');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            var check = $(element).attr('readonly');
            if (typeof check == 'undefined' && $(element).attr('name') != "password") {
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
                type	: "POST",
                url		: "{{ route('takeBalance') }}",
                data	: $('#postbalance').serialize(),
                dataType: "JSON",
                beforeSend: function(){
                    $("#save-balance").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-balance').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', data.info);
                        resetForm('postbalance');
                        $('#modal-balance').modal('hide');
                    } else {
                        notif('warning', '{{ __("all.warning") }}', data.info);
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

    $(document).ready(function () {
        $('.carousel').carousel({
            interval: 6000
        })
    });

    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection