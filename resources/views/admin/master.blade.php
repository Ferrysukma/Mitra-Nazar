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

<!-- Content Row -->
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="true">{{ __('all.chart') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="maps-tab" data-toggle="tab" href="#maps" role="tab" aria-controls="maps" aria-selected="false">{{ __('all.maps') }}</a>
    </li>
</ul>
<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Approach chart -->
        
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="btn-group" role="group" style="float:right">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterChart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  onclick="showDropdown('dropChart')">
                                <span>{{ __('all.filter') }}</span> <i class="fa fa-filter"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterChart" id="dropChart" style="width:300px;">
                                <form id="formChart" class="px-4 py-3" action="#">
                                    <div class="form-group">
                                        <input type="text" name="start_date" id="start_dtm_chart" class="form-control" placeholder="{{ __('all.start_date') }}">
                                    </div>
                                    <!-- <div class="form-group">
                                        <input type="text" name="end_date" id="end_dtm_chart" class="form-control" placeholder="{{ __('all.end_date') }}">
                                    </div> -->
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
                    <div class="card-body">
                        <div class="card-title">
                            <h4>{{ __('all.title_chart') }}</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="line-chart-wp chart-display-nn">
                                <canvas id="myChart" style="height:40vh; width:80vw"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <div class="card-title">
                                <h4>{{ __('all.table_chart') }}</h4>
                            </div>
                            <hr>
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
            <div class="tab-pane fade" id="maps" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="btn-group" role="group" style="float:right">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="filterMaps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showDropdown('dropMaps')">
                                <span>{{ __('all.filter') }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right keep-open" aria-labelledby="filterMaps" id="dropMaps" style="width:300px;">
                                <form id="formFilter" class="px-4 py-3" action="#">
                                    <div class="form-group">
                                        <input type="text" name="start_date" id="start_dtm_maps" class="form-control" placeholder="{{ __('all.start_date') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="end_date" id="end_dtm_maps" class="form-control" placeholder="{{ __('all.end_date') }}">
                                    </div>
                                    <div class="form-group">
                                        <select name="provinsi" id="provinsi_maps" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_prov') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="kabupaten" id="kabupaten_maps" class="form-control" style="width: 100% !important;">
                                            <option value="" selected disabled>{{ __('all.placeholder.choose_kab') }}</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h4>{{ __('all.title_maps') }}</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="googleMap"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                        <div class="card-title">
                            <h4>{{ __('all.table_chart') }}</h4>
                        </div>
                        <hr>
                        <table class="table table-hover table-striped table-condensed table-bordered" id="table-maps" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('all.table.date') }}</th>
                                    <th>{{ __('all.table.prov') }}</th>
                                    <th>{{ __('all.table.city') }}</th>
                                    <th>{{ __('all.table.qty') }}</th>
                                    <th>{{ __('all.table.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    </div>
                </div
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
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
                                ref.address,
                                ref.alamat,
                                ref.koordinat,
                                ref.active,
                                "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='{{ __('all.button.edit') }}' data-toggle='tooltip' data-placement='top' id='"+ref.id+"'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='"+ref.id+"' title='{{ __('all.button.delete') }}' data-toggle='tooltip' data-placement='top'><i class='fa fa-trash'></i></button></div>", 
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

    showData();

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

    $('#start_dtm_chart').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            // $('#end_dtm_chart').data('datepicker')
            //     .update('minDate', date);
            // $('#end_dtm_chart').focus();
            showData();
        }
    });

    function selectCity(e) {
        var prov        = $(e).attr('provinsi');
        var city        = $(e).attr('city');

        $('#province').val(prov);
        $('#dropCity').val(city);
        $('.data-city').hide();
        showData();
    }

    $(document).on('click','.dropdown-item.select', function () {
        var prov        = $(this).attr('provinsi');
        var city        = $(this).attr('city');

        $('#province').val(prov);
        $('#dropCity').val(dropCity);

        $('.data-city').hide();
        showData();
    });

    $('#end_dtm_chart').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#start_dtm_chart').data('datepicker')
                .update('maxDate', date);
        }
    });

    $('#start_dtm_maps').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#end_dtm_maps').data('datepicker')
                .update('minDate', date);
            $('#end_dtm_maps').focus();
        }
    });

    $('#end_dtm_maps').datepicker({
        language: 'en',
        dateFormat: 'dd M yyyy',
        autoClose: true,
        onSelect: function(fd, date) {
            $('#start_dtm_maps').data('datepicker')
                .update('maxDate', date);
        }
    });

    // var speedCanvas = document.getElementById("myChart");

    // Chart.defaults.global.defaultFontFamily = "Lato";
    // Chart.defaults.global.defaultFontSize = 18;

    // var dataFirst = {
    //     label: "Car A - Speed (mph)",
    //     data: [0, 59, 75, 20, 20, 55, 40],
    //     lineTension: 0,
    //     fill: false,
    //     borderColor: 'red'
    // };

    // var dataSecond = {
    //     label: "Car B - Speed (mph)",
    //     data: [20, 15, 60, 60, 65, 30, 70],
    //     lineTension: 0,
    //     fill: false,
    //     borderColor: 'blue'
    // };

    // var speedData = {
    //     labels: ["0s", "10s", "20s", "30s", "40s", "50s", "60s"],
    //     datasets: [dataFirst, dataSecond]
    // };

    // var chartOptions = {
    //     legend: {
    //         display: true,
    //         position: 'top',
    //         labels: {
    //             boxWidth: 80,
    //             fontColor: 'black'
    //         }
    //     }
    // };

    // var lineChart = new Chart(speedCanvas, {
    //     type: 'line',
    //     data: speedData,
    //     options: chartOptions
    // });
</script>
@endsection