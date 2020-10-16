@extends('layouts.app')

@section('content')
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
    <div class="col-lg-12 mb-4">
        <!-- Content Row -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="true">{{ __('all.chart') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="maps-tab" data-toggle="tab" href="#maps" role="tab" aria-controls="maps" aria-selected="false">{{ __('all.maps') }}</a>
            </li>
        </ul>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                        <div class="card-title">
                            <h4>{{ __('all.title_chart') }}</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div style="height:40vh; width:100%">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="maps" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-title">
                            <h4>{{ __('all.title_maps') }}</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="maps-homeMitra">
                                <div id="mapsHomeMitra" style="width:100%;height:50vh"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 card-title">
                        <h4>{{ __('all.table_chart') }}</h4>
                    </div>
                    <div class="col-sm-6" style="float:right">
                        <div class="btn-group" role="group" style="float:right">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterChart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropChart')">
                                <span>{{ __('all.filter') }}</span> <i class="fa fa-filter"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterChart" id="dropChart" style="width:300px;">
                                <form id="formChart" class="px-4 py-3" action="#">
                                    <div class="form-group">
                                        <input type="text" name="start_date" id="start_dtm_chart" class="form-control readonly" placeholder="{{ __('all.start_date') }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="end_date" id="end_dtm_chart" class="form-control readonly" placeholder="{{ __('all.end_date') }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <div class="dropdown">
                                            <input type="text" name="city" class="form-control dropdown-toggle" id="dropCity" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="filterCoordinate('dropCity', 'data-city', 'showCity')" placeholder="{{ __('all.placeholder.findCity') }}">
                                            <div class="dropdown-menu data-city" id="showCity">
                                                <a class="dropdown-item">{{ __('all.datatable.no_data') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="province" id="province" class="form-control readonly" readonly placeholder="{{ __('all.table.prov') }}">
                                    </div>
                                    <div class="form-group">
                                        <select name="tipe" id="tipe" class="form-control select2" onchange="showData()">
                                            <option value="">{{ __('all.placeholder.choose_coortype') }}</option>
                                            <option value="pusat">{{ __('all.checkbox.central') }}</option>
                                            <option value="provinsi">{{ __('all.checkbox.regional') }}</option>
                                            <option value="kota">{{ __('all.checkbox.city') }}</option>
                                            <option value="kecamatan">{{ __('all.checkbox.district') }}</option>
                                            <option value="desa">{{ __('all.checkbox.village') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="kategori" id="kategori" class="form-control select2 create-cat" onchange="showData()"></select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-condensed table-bordered" id="table-chart" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('all.table.join_date') }}</th>
                                <th>{{ __('all.table.partner_id') }}</th>
                                <th>{{ __('all.table.partner_nm') }}</th>
                                <th>{{ __('all.table.coordinator_type') }}</th>
                                <th>{{ __('all.table.prov') }}</th>
                                <th>{{ __('all.table.city') }}</th>
                                <th>{{ __('all.table.address') }}</th>
                                <th>{{ __('all.table.coordinate') }}</th>
                                <!-- <th>{{ __('all.table.downline') }}</th> -->
                                <th>{{ __('all.table.status') }}</th>
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

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Ah8Zuhy2ECqqjBNF8ri2xJ7mwwtIbwo&callback=initMap" defer></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }

        return s.join(dec);
    }

    var table = $('#table-chart').DataTable({
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
            { targets: [10], orderable: false, searchable: false, className	: "text-center" },
        ],
        "initComplete"      : function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });

    function showData() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "POST",
            url     : "{{ route('detailChart') }}",
            data    : {
                start   : $('#start_dtm_chart').val(),
                provinsi: $('#province').val(),
                kota    : $('#dropCity').val(),
                tipe    : $('#tipe').val(),
                kategori: $('#kategori').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                table.clear().draw();
                $("#table-chart").parent().ploading({action : 'show'});
            },
            success     : function(data){
                if (data.code == 0) {
                    list = data.data;
                    
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            table.row.add( [
                                idx + 1,
                                moment.utc(ref.cdate).format('DD MMM YYYY hh:mm:ss'),
                                ref.userCode,
                                ref.nama,
                                ref.tipe,
                                ref.provinsi,
                                ref.kota,
                                ref.alamat,
                                ref.koordinat,
                                ref.active,
                                "<button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-trash'></i></button></div>", 
                            ] ).draw( false );
                        });
                    }
                } 
            },
            complete : function () {
                $("#table-chart").parent().ploading({action : 'hide'});
            }
        });
    }

    showData(1);
    showData(2);

    function showCategory() {
        $.ajax({
            type    : "GET",
            url     : "{{ route('loadListCategory') }}",
            dataType: "JSON",
            success     : function(data){
                if (data.code == 0) {
                    $('#kategori').empty();
                    txt  = '';
                    list = data.data;
                    
                    txt += '<option value="" selected>{{ __("all.placeholder.choose_coorcategory") }}</option>';
                    if(list.length > 0){
                        $.each(list, function(idx, ref){
                            txt += '<option value="'+ref.name+'">'+ref.name+'</option>';
                        });
                    }

                    $('#kategori').append(txt);
                } 
            },
        });
    }

    showCategory();

    function maps() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('listAllPartner') }}",
            data    : {
                params  : 2,
                start   : $('#start_dtm_chart').val(),
                end     : $('#end_dtm_chart').val(),
                provinsi: $('#province').val(),
                kota    : $('#dropCity').val(),
                tipe    : $('#tipe').val(),
                kategori: $('#kategori').val(),
            },
            dataType: "JSON",
            beforeSend: function(){
                $("#maps-homeMitra").ploading({action : 'show'});
            },
            success     : function(data){
                initMaps(data.data, 'mapsHomeMitra');
            },
            complete : function () {
                $("#maps-homeMitra").ploading({action : 'hide'});
            }
        });
    }

    maps();
    loadDataChart();

    function selectCity(e) {
        var prov        = $(e).attr('provinsi');
        var city        = $(e).attr('city');

        $('#province').val(prov);
        $('#dropCity').val(city);
        $('.data-city').hide();
        showData();
    }

    //load data cash
    function loadDataChart() {
        $.ajax({
            type    : "POST",
            url     : "{{ route('loadChart') }}",	
            data    : {
                start   : $('#start_dtm_chart').val(),
                end     : $('#end_dtm_chart').val(),
                provinsi: $('#province').val(),
                kota    : $('#dropCity').val(),
                tipe    : $('#tipe').val(),
                kategori: $('#kategori').val(),
            },
            dataType    : "JSON",
            beforeSend: function(){
                $('#chart').ploading({action: 'show'});
            },
            success : function(res){
                var x  = [];
                var y  = [];
                
                list = res.data;
                if (list.length > 0) {
                    $(list).each(function(i){  
                        x.push(list[i].total); 
                        y.push(list[i].cdate);
                    });
                }
                
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: y,
                        datasets: [{
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: x,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ' ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            },
            complete : function () {
                $('#chart').ploading({action: 'hide'});
            }
        });
    }

    $('#start_dtm_chart').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#end_dtm_chart').data('datepicker')
                .update('minDate', date);
            $('#end_dtm_chart').focus();
            showData();
        }
    });

    $('#end_dtm_chart').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#start_dtm_chart').data('datepicker')
                .update('maxDate', date);
                maps();
                loadDataChart();
        }
    });
</script>
@endsection