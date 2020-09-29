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
    <link rel="shortcut icon" type="assets/image/png" href="{{ asset('assets/mitra/image/logo/icon.png') }}" />
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/font-awesome/css/font-awesome.min.css') }}">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/meanmenu/meanmenu.min.css') }}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/animate.css') }}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/normalize.css') }}">
	<!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/wave/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/wave/button.css') }}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/notika-custom-icon.css') }}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/main.css') }}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/style.css') }}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/responsive.css') }}">
    <!-- modernizr JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- Data Table CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/jquery.dataTables.min.css') }}">
    <!-- Air Datepicker
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/air-datepicker/datepicker.min.css') }}">
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mitra/css/select2/select2-bootstrap4.min.css') }}">

    <style>
        .dropdown-menu {
            padding-top : 1.5rem !important;
            padding-right : 1.5rem !important;
            padding-left : 1.5rem !important;
            right : 0 !important;
            left : unset !important;
            width : 300px;
        }

        .readonly {
            background-color : white !important;
        }
    </style>
</head>

<body>
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <ul class="nav navbar-nav notika-top-nav" style="float:left;">
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="fa fa-flag"></i> {{ __('all.language') }}</span></a>
                            <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                <div class="hd-message-info">
                                    <a href="#">
                                        <div class="hd-message-sn">
                                            <div class="hd-message-img chat-img">
                                                
                                            </div>
                                            <div class="hd-mg-ctn">
                                                <a class="{{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('localization.switch', 'en') }}">English</a>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="hd-message-sn">
                                            <div class="hd-message-img chat-img">
                                            </div>
                                            <div class="hd-mg-ctn">
                                                <a class="{{ app()->getLocale() == 'id' ? 'active' : '' }}" href="{{ route('localization.switch', 'id') }}">Bahasa Indonesia</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('all.home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('partner') }}">{{ __('all.partners') }}</a>
                            </li>
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span>{{ __('all.setting') }}</span></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-message-info">
                                        <a href="{{ route('user') }}">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">

                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>{{ __('all.users') }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('user') }}">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>{{ __('all.announcement') }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>{{ __('all.category') }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span>{{ __('all.admin') }} <i class="fa fa-user"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-message-info">
                                        <a href="#" onclick="showModal('changePassword')">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">

                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>{{ __('all.change') }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" onclick="showModal('editProfile')">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>{{ __('all.profile') }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>{{ __('all.logout') }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->

    <main class="py-4">
        
        <!-- Start Modal Change Password -->
        <div class="modal fade" id="changePassword" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">{{ __('all.change') }}</h3>
                        <hr>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post">
                            <div class="form-group row">
                                <label for="old" class="col-sm-3">{{ __('all.form.old_password') }} <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('all.placeholder.password') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="old" class="col-sm-3">{{ __('all.form.new_password') }} <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('all.placeholder.new_password') }}">
                                    
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
        <!-- End Modal Change Password -->

        <!-- Start Modal Change Password -->
        <div class="modal fade" id="editProfile" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">{{ __('all.profile') }}</h3>
                        <hr>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post">
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
        <!-- End Modal Change Password -->
          
        @yield('content')
    </main>

    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2020 
. All rights reserved. Mitra Nazar id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->

    <!-- jquery
		============================================ -->
    <script src="{{ asset('assets/mitra/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/wow.min.js') }}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/jquery-price-slider.js') }}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/owl.carousel.min.js') }}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/jquery.scrollUp.min.js') }}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/meanmenu/jquery.meanmenu.js') }}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/counterup/counterup-active.js') }}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/sparkline/sparkline-active.js') }}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/flot/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/flot/flot-active.js') }}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/knob/knob-active.js') }}"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/wave/wave-active.js') }}"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/todo/jquery.todo.js') }}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/plugins.js') }}"></script>
    <!-- Google map JS
    ============================================ -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVOIQ3qXUCmKVVV7DVexPzlgBcj5mQJmQ&callback=initMap"></script>
	<!--  Chat JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/chat/moment.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/chat/jquery.chat.js') }}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/main.js') }}"></script>
    <!-- Data Table JS
		============================================ -->
    <script src="{{ asset('assets/mitra/js/data-table/jquery.dataTables.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/mitra/js/data-table/dataTables.bootstrap4.min.js') }}"></script> -->
    <!-- Air Datepicker
    ============================================ -->
    <script src="{{ asset('assets/mitra/js/air-datepicker/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/air-datepicker/datepicker.en.js') }}"></script>

    <!-- chart js -->
    <script src="{{ asset('assets/mitra/js/chartjs/chart.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/chartjs/chart.min.js') }}"></script>

    <!-- select 2 -->
    <script src="{{ asset('assets/mitra/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/mitra/js/select2/id.js') }}"></script>

    @yield('script')

    <script>
        function showModal(modal) {
            $('#'+modal).modal({backdrop: 'static', keyboard: false});
            $('#'+modal).modal('show');
        }

        function modalSelect2(modal) {
            $('#'+modal).find('select').select2({
                theme: 'bootstrap4',
                dropdownParent: '#'+modal
            });
        }

        $('select').select2({
            theme: 'bootstrap4',
        });

        $("#btnFilter").on('click',function() {
            if ($("#dropdownFilter").hasClass('show')) {
                $("#dropdownFilter").dropdown('hide');
            } else {
                $("#dropdownFilter").dropdown('show');
            }
        });
    </script>
</body>

</html>