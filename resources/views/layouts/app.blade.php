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
    <link rel="shortcut icon" type="assets/image/png" href="{{ asset('assets/admin/image/logo4x.png') }}"/>

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

                    <!-- Topbar Search -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                        <div class="sidebar-brand-icon">
                            <img src="{{ asset('assets/admin/image/mitra-nazar-web-05.png') }}" style="height:70px;width:190px" class="d-inline-block align-top" alt="">
                        </div>
                    </a>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item -->
                        <li class="nav-item no-arrow mx-1">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('all.home') }}</a>
                        </li>
                        <li class="nav-item no-arrow mx-1">
                            <a class="nav-link" href="{{ route('partner') }}">{{ __('all.partners') }}</a>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>{{ __('all.setting') }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <a class="dropdown-item" href="{{ route('user') }}">
                                    {{ __('all.users') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('announcement') }}">
                                    {{ __('all.announcement') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('category') }}">
                                    {{ __('all.category') }}
                                </a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                    </ul>

                    <div class="dropdown" style="width:10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle text-white"></i>
                                <span class="mr-2 d-none d-lg-inline text-white">{{ strtok(Session::get('username'), ' ') }}</span>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="showModal('changePassword','postpass')">
                                        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('all.change') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="showModal('logoutModal')">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('all.logout') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="dropdown" style="width:10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/admin/image/' . Session::get('locale') . '.png') }}" alt="id" srcset width="30%" height="75%">
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
                    @yield('content')
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
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.con_password') }} <sup class="text-danger">*</sup></label><div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="password" name="conPassword" id="conPassword" class="form-control" placeholder="{{ __('all.placeholder.confirmpassword') }}" aria-describedby="basic-addon3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary input-group-text" id="basic-addon3" onclick="changeIcon('basic-addon3','conPassword')"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                    <button type="submit" class="btn btn-success" id="btn-pass">{{ __('all.save') }}</button>
                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>

    <!-- api google maps -->
    <script src="{{ asset('assets/admin/js/maps.js') }}"></script>
    <!-- generic js -->
    <script src="{{ asset('assets/admin/js/generic.js') }}"></script>
    
    @yield('script')

    <script>
        function logout() {
            $("#btn-logout").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
            $('.modal-logout').ploading({action:'show'});
            window.location = "{{ route('logout') }}";
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

        function changePass() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type	: "POST",
                url		: "{{ route('changePassword') }}",
                data	: $('#postpass').serialize(),
                dataType: "JSON",
                beforeSend: function(){
                    $("#btn-pass").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $('.create-pass').ploading({action:'show'});
                },
                success     : function(data){
                    if (data.code == 0) {
                        notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
                        window.location = "{{ route('logout') }}";
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
                        infowindow.setContent(locations[i][0]+' ('+locations[i][3]+')');
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }

        $("#postpass").validate({
            rules       : {
                oldPassword     : "required",
                newPassword     : "required",
                conPassword     : {
                    required    : true,
                    equalTo     : "#newPassword"
                }
            },
            messages: {
                oldPassword     : "{{ __('all.validation.old') }}",
                newPassword     : "{{ __('all.validation.new') }}",
                conPassword     : {
                    required    : "{{ __('all.validation.confirm') }}",
                    equalTo     : "{{ __('all.validation.equalTo') }}"
                }
            },
            errorClass      : "invalid-feedback",
            errorElement    : "div",
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr('name') != 'oldPassword') {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                } else if ($(element).attr('name') == 'oldPassword') {
                    $(element).removeClass('is-invalid').removeClass('is-valid');
                }
            },
            errorPlacement  : function(error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                if (element.attr("name") == "oldPassword" || element.attr('name') == "newPassword" || element.attr('name') == "conPassword") {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler : function (validator, form, submitButton) {
                changePass();
            }
        });
    </script>

</body>

</html>
