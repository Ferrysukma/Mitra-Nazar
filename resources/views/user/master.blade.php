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

        .scrollable-menu {
            height: auto;
            max-height: 200px;
            overflow-x: hidden;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23f00' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23f00' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
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

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

                    <!-- Topbar Logo -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
                        <div class="sidebar-brand-icon">
                            <img src="{{ asset('assets/admin/image/mitra-nazar-web-05.png') }}" width="100" height="40" class="d-inline-block align-top" alt="">
                        </div>
                    </a>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item -->
                        <li class="nav-item no-arrow mx-1">
                            <a class="nav-link" href="{{ route('index') }}">{{ __('all.home') }}</a>
                        </li>
                        <li class="nav-item no-arrow mx-1">
                            <a class="nav-link" href="{{ route('downline') }}">Downline</a>
                        </li>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" id="countNotif"></span>
                            </a>
                        <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    {{ __('all.notif') }}
                                </h6>
                                <div id="showNotif"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="#" onclick="showNotif()">{{ __('all.showAll') }}</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small">{{ Session::get('name') }}</span>
                                <img class="img-profile rounded-circle" src="{{ Session::get('image') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" onclick="showModal('changePassword','postpass')">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('all.change') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('config') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('all.setting') }}
                                </a>
                                <a class="dropdown-item" href="#" onclick="showModal('logoutModal')">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('all.logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>

                    <div class="dropdown" style="width:10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/admin/image/' . Session::get('locale') . '.png') }}" alt="id" srcset width="30%" height="100%">
                                <span class="text-white"> {{ Session::get('locale') == 'id' ? 'ID' : 'ENG' }}</span>
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-item" href="{{ Route('localization.switch', Session::get('locale') == 'en' ? 'id' : 'en') }}" title="Select"><img src="{{ asset('assets/admin/image/' . (Session::get('locale') == 'en' ? 'id' : 'en') . '.png') }}" alt="en" srcset width="30%" height="100%"> <span> {{ Session::get('locale') == 'en' ? 'ID' : 'ENG' }}</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('contentUser')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-primary">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span style="color:#fff!important">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-logout">
                <div class="modal-header">
                    <h5 class="modal-title text-white">{{ __('all.leave') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">{{ __('all.comment_logout') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('all.cancel') }}</button>
                    <a class="btn btn-success" id="btn-logout" onclick="logout()"><span class="text-white">{{ __('all.logout') }}</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal-->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content create-pass">
                <div class="modal-header">
                    <h5 class="modal-title text-white">{{ __('all.change') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="postpass">
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.old_password') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="{{ __('all.placeholder.password') }}" aria-describedby="basicOld">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary input-group-text" id="basicOld" onclick="changeIcon('basicOld','oldPassword')"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.new_password') }} <sup class="text-danger">*</sup></label><div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="{{ __('all.placeholder.new_password') }}" aria-describedby="basic-addon2">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary input-group-text" id="basic-addon2" onclick="changeIcon('basic-addon2','newPassword')"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                            <button type="submit" class="btn btn-success" id="btn-pass">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modal-notif" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">{{ __('all.notif') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class=" table table-hover table-striped table-consended table-bordered" id="table-notif" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('all.table.date') }}</th>
                                    <th>{{ __('all.table.message') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                </div>
            </div>
        </div>
    </div>

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
    
    @yield('scriptUser')

    <script>
        var tableNotif = $('#table-notif').DataTable({
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
            "pagingType"        : "simple",
            "columnDefs"        : [ 
                { targets: [0], orderable: false, className	: "text-center" },
            ],
            "initComplete"      : function() {
                $('[data-toggle="tooltip"]').tooltip();
            },
        });

        function logout() {
            $("#btn-logout").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
            $('.modal-logout').ploading({action:'show'});
            window.location = "{{ route('logoutUser') }}";
        }

        function changeIcon(id, kd) {
            if ($('#'+id).find('i').hasClass('fa fa-eye')) {
                $('#'+id).find('i').attr('class','fa fa-eye-slash');
                $('#'+kd).attr('type','text');
            } else {
                $('#'+id).find('i').attr('class','fa fa-eye');
                $('#'+kd).attr('type','password');
            }
        }

        $("#postpass").validate({
            rules       : {
                oldPassword     : "required",
                newPassword     : "required",
            },
            messages: {
                oldPassword     : "{{ __('all.validation.old') }}",
                newPassword     : "{{ __('all.validation.new') }}",
            },
            errorClass      : "invalid-feedback",
            errorElement    : "div",
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr('name') != 'oldPassword') {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            },
            errorPlacement  : function(error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                if (element.attr("name") == "oldPassword" || element.attr('name') == "newPassword") {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler : function (validator, form, submitButton) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type	: "POST",
                    url		: "{{ route('changePassUser') }}",
                    data	: $('#postpass').serialize(),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#btn-pass").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                        $('.create-pass').ploading({action:'show'});
                    },
                    success     : function(data){
                        if (data.code == 0) {
                            notif('success', '{{ __("all.success") }}', data.info);
                            window.location = "{{ route('logoutUser') }}";
                        } else {
                            notif('warning', '{{ __("all.warning") }}', data.info);
                        }
                    },
                    complete    : function(){
                        $("#btn-pass").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                        $('.create-pass').ploading({action:'hide'});
                    },
                    error 		: function(){
                        notif('error', '{{ __("all.error") }}');
                    }
                });
            },
            fields: {
                oldPassword: {
                    validators: {
                        notEmpty: {
                            message: '<b class="text-danger">*{{ __("all.validation.old") }}</b>'
                        },
                    }
                },
                newPassword: {
                    validators: {
                        notEmpty: {
                            message: '<b class="text-danger">*{{ __("all.validation.new") }}</b>'
                        },
                    }
                },
            },
        });

        $('.only-number').keypress(function(event){
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }
        });

        function showNotif(id) {
            showModal('modal-notif');
            showDataNotif();
            readNotif(id);
        }

        function readNotif(id) {
            $.ajax({
                type    : "POST",
                url     : "{{ route('readNotif') }}",
                data    : {
                    _token  : "{{ csrf_token() }}",
                    id      : id,
                },
                dataType: "JSON",
                success     : function(data){
                    if (data.code == 0) {
                        console.log(data.info);
                    } 
                },
            });
        }

        function showDataNotif() {
            $.ajax({
                type    : "POST",
                url     : "{{ route('allNotif') }}",
                data    : {
                    _token  : "{{ csrf_token() }}",
                    page    : 0,
                    limit   : 100000000
                },
                dataType: "JSON",
                beforeSend: function(){
                    tableNotif.clear().draw();
                    $("#table-notif").parent().ploading({action : 'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        list = data.data.data;

                        if(list.length > 0){
                            $.each(list, function(idx, ref){
                                tableNotif.row.add( [
                                    idx + 1,
                                    ref.dtm,
                                    ref.message,
                                ] ).draw( false );
                            });
                        }
                    } 
                },
                complete : function () {
                    $("#table-notif").parent().ploading({action : 'hide'});
                }
            });
        }

        function getLatLong(district, id, map) {
            $.ajax({
                type        : "POST",
                url         : "{{ route('getLatLong') }}",
                headers     : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data        : {
                    address : district
                },
                dataType    : "JSON",
                beforeSend  : function () {
                    $('#'+map).ploading({action:'show'});
                },
                success     : function (res) {
                    $('#lat').val(res.data.lat);
                    $('#lng').val(res.data.long);
                    initialize(res.data.lat, res.data.long, id);
                    $('#'+id).show();
                },
                complete    : function () {
                    $('#'+map).ploading({action:'hide'});
                }
            });
        }

        function notification() {
            $.ajax({
                type    : "POST",
                url     : "{{ route('notification') }}",
                data    : {
                    _token  : "{{ csrf_token() }}",
                    page    : 0,
                    limit   : 5
                },
                dataType: "JSON",
                success : function (res) {
                    list = res.data.data;
                    txt  = '';

                    $('#countNotif').text(res.data.no);

                    if (list.length > 0) {
                        $.each(list, function(idx, ref){
                            txt += '<a class="dropdown-item d-flex align-items-center" onclick="showNotif('+ref.id+')">';
                            txt +=      '<div class="mr-3">';
                            txt +=          '<div class="icon-circle bg-primary">';
                            txt +=              '<i class="fas fa-file-alt text-white"></i>';
                            txt +=          '</div>';
                            txt +=      '</div>';
                            txt +=      '<div>';
                            txt +=          '<div class="small text-gray-500">'+ref.dtm+'</div>';
                            txt +=          '<span class="font-weight-bold">'+ref.message+'</span>';
                            txt +=      '</div>';
                            txt += '</a>';
                        });
                    } else {
                        txt += '<a class="dropdown-item d-flex align-items-center" href="#">';
                        txt +=      '<div>';
                        txt +=          '<span class="font-weight-bold">{{ __("all.datatable.no_data") }}</span>';
                        txt +=      '</div>';
                        txt += '</a>';
                    }

                    $('#showNotif').append(txt);
                } 
            })
        }

        notification();

        // Google Maps
        function initMaps(locations, id) {
            
            var map = new google.maps.Map(document.getElementById(id), {
                zoom        : 5,
                center      : new google.maps.LatLng(-4.793287, 116.885929),
                mapTypeId   : google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                console.log();  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map     : map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>

</body>

</html>
