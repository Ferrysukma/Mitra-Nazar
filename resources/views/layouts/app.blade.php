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
    <link rel="shortcut icon" type="assets/image/png" href="{{ asset('assets/admin/image/logo/icon.png') }}" />

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
        footer {
            margin-top: 162px;
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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white">{{ __('all.admin') }}</span>
                                <i class="fa fa-user-circle"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" onclick="showModal('changePassword','postpass')">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('all.change') }}
                                </a>
                                <a class="dropdown-item" href="#" onclick="showModal('editProfile','postprofile')">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('all.profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="showModal('logoutModal')">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('all.logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="fa fa-flag"></i> {{ __('all.language') }}</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('localization.switch', 'en') }}"><img src="{{ asset('assets/admin/image/en.png') }}" alt="en" srcset width="20%"> Inggris</a>
                            <a class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}" href="{{ route('localization.switch', 'id') }}"><img src="{{ asset('assets/admin/image/idn.png') }}" alt="idn" srcset width="20%"> Indonesia</a>
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
                        <span style="color:#fff!important">Copyright © 2020 . All rights reserved. Mitra Nazar id</span>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">{{ __('all.leave') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">{{ __('all.comment_logout') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('all.cancel') }}</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">{{ __('all.logout') }}</a>
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
                                    <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="{{ __('all.placeholder.password') }}" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" onclick="changeIcon('basic-addon1','oldPassword')"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.new_password') }} <sup class="text-danger">*</sup></label><div class="col-sm-9">
                                <div class="input-group mb-3">
                                <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="{{ __('all.placeholder.new_password') }}" aria-describedby="basic-addon2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2" onclick="changeIcon('basic-addon2','newPassword')"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                            <button type="submit" class="btn btn-primary" id="btn-pass">{{ __('all.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Profile Modal-->
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">{{ __('all.profile') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="postprofile">
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.username') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="username" id="username" class="form-control readonly" placeholder="{{ __('all.placeholder.username') }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.email') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('all.placeholder.email') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old" class="col-sm-3">{{ __('all.form.telp') }} <sup class="text-danger">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="telp" id="telp" class="form-control" placeholder="{{ __('all.placeholder.telp') }}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('all.close') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('all.save') }}</button>
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
    <script src="{{ asset('assets/admin/js/chart/chart.min.js') }}"></script>
    <!-- Google maps js -->
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Ah8Zuhy2ECqqjBNF8ri2xJ7mwwtIbwo&callback=initMap"></script> -->
    <!-- datatables -->
    <script src="{{ asset('assets/admin/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <!-- sweetalert js -->
    <script src="{{ asset('assets/admin/js/sweetalert.js') }}"></script>
    <!-- validator js -->
    <script src="{{ asset('assets/admin/js/bootstrapvalidator.min.js') }}"></script>
    <!-- ploading js -->
    <script src="{{ asset('assets/admin/js/p-loading/p-loading.js') }}"></script>
    <!-- generic js -->
    <script src="{{ asset('assets/admin/js/generic.js') }}"></script>
    <!-- bootbox js -->
    <script src="{{ asset('assets/admin/js/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootbox/bootbox.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js.map"></script>
    
    @yield('script')

    <script>
        function changeIcon(id, kd) {
            if ($('#'+id).find('i').hasClass('fa fa-eye')) {
                $('#'+id).find('i').attr('class','fa fa-eye-slash');
                $('#'+kd).attr('type','text');
            } else {
                $('#'+id).find('i').attr('class','fa fa-eye');
                $('#'+kd).attr('type','password');
            }
        }

        $('#postpass').bootstrapValidator({
            container: 'tooltip',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            submitHandler : function (validator, form, submitButton) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type	: "POST",
                    url		: "{{ route('changePassword') }}",
                    data	: $(form).serialize(),
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
                            notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_pass") }}');
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
    </script>

</body>

</html>
