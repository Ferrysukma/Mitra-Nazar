<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mitra Nazar.id</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon ============================================ -->
	<link rel="shortcut icon" type="assets/image/png" href="{{ asset('assets/admin/image/logo4x.png') }}" />

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Air Datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/air-datepicker/datepicker.min.css') }}">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2/select2-bootstrap4.min.css') }}">
    <!-- datatable -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap4.min.css') }}">
	<!-- ploading js -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/p-loading/p-loading.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <style>
        .readonly {
            background-color : white !important;
        }
        .datepicker{
            z-index:1151;
        }
        #content {
            min-height: calc(100vh - 70px);
        }
        footer {
            height: 4.375rem;
        }
        .select2-link {
            background-color: #42A5F5;
            color           : #fff!important;
            text-align      : center;
            padding         : 10px 10px 10px 10px;
        }
        label {
            font-weight: 800;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div id="bar-chart-bs" style="position: relative; height:auto; width:auto;margin: auto;">
                        <canvas id="bar-canvas-bs"></canvas>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <!-- js -->
    <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('assets/admin/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select2/id.js') }}"></script>
    <!-- Air Datepicker -->
    <script src="{{ asset('assets/admin/js/air-datepicker/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/air-datepicker/datepicker.en.js') }}"></script>
    <!-- Chart js -->
    <script src="{{ asset('assets/admin/js/chart/chart.js') }}"></script>
    <!-- datatables -->
    <script src="{{ asset('assets/admin/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <!-- sweetalert js -->
    <script src="{{ asset('assets/admin/js/sweetalert.js') }}"></script>
    <!-- validator js -->
    <script src="{{ asset('assets/admin/js/bootstrapvalidator.min.js') }}"></script>
    <!-- ploading js -->
    <script src="{{ asset('assets/admin/js/p-loading/p-loading.js') }}"></script>
    <!-- bootbox js -->
    <script src="{{ asset('assets/admin/js/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootbox/bootbox.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js.map"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <!-- api google maps -->
    <script src="{{ asset('assets/admin/js/maps.js') }}"></script>
    <!-- generic js -->
    <script src="{{ asset('assets/admin/js/generic.js') }}"></script>

    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        
        <?php 
            $x = [];
            $y = [];

            foreach ($result as $key) {
                array_push($x, $key->periode);
                array_push($y, $key->amount);
            }

        ?>

        $('#bar-canvas-bs').remove(); $('#bar-chart-bs').append('<canvas id="bar-canvas-bs"><canvas>');
        var ctx = document.getElementById('bar-canvas-bs').getContext('2d');
        var MyChart = new Chart(
            ctx,
            {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($x) ?>,
                    datasets: [{
                        data            : <?php echo json_encode($y) ?>,
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
    </script>

</body>

</html>
