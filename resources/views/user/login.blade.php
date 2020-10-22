<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>{{ __('all.login') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon ============================================ -->
	<link rel="shortcut icon" type="assets/image/png" href="{{ asset('assets/admin/image/logo4x.png') }}" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/main.css') }}">
<!--===============================================================================================-->
	<!-- ploading js -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/p-loading/p-loading.css') }}">
	<!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/admin/css/select2/select2-bootstrap4.min.css') }}">
	<style>
        form .form-pin input[type="text"]:focus {
            outline: none;
        }
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<img src="{{ asset('assets/admin/image/mitra-nazar-web-05.png') }}" alt="background-logo" style="width:50vw;height:50vh">
			<div class="wrap-login100 p-t-50 p-b-90" id="show-email">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#" id="postemail">
					<span class="login100-form-title p-b-51">
                        {{ __('all.login') }} <br>
                    </span>
                    
                    <span class="login100-form-subtitle">
                        {{ __('all.welcome_us') }}
					</span>
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.emailorphone') }}">
                        <input class="input100" type="email" name="email" id="email" placeholder="{{ __('all.placeholder.emailorphone') }}">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button type="button" class="login100-form-btn btnSave" onclick="validasiLogin('show-email')">
                            {{ __('all.login') }}
                        </button>
                    </div>
                </form>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <p class="text-center mt-4">{{ __('all.login_with') }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="" class="btn btn-block mb-2" style="background-color: #405D9D; color: #fff"> <i class="fa fa-facebook-f"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="#" id="googleLogin" class="btn btn-google btn-block mb-4" style="background-color: #af0000; color: #fff"> <i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
			</div>

            <div class="wrap-login100 p-t-50 p-b-90" id="show-password">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#" id="postpass">
					<span class="login100-form-title p-b-51">
                        {{ __('all.login') }} <br>
                    </span>
                    
                    <span class="login100-form-subtitle">
                        {{ __('all.welcome_us') }}
					</span>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.password') }}">
                        <input class="input100" type="password" name="password" id="password" placeholder="{{ __('all.placeholder.password') }}">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button type="button" class="login100-form-btn btnSave" onclick="loginbyEmail('show-password')">
                            {{ __('all.login') }}
                        </button>
                    </div>
                </form>
                <div class="row mt-3">
                    <div class="col-12">
                        <p class="text-center mt-4">{{ __('all.login_with') }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="" class="btn btn-block mb-2" style="background-color: #405D9D; color: #fff"> <i class="fa fa-facebook-f"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="#" id="googleLogin" class="btn btn-google btn-block mb-4" style="background-color: #af0000; color: #fff"> <i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
			</div>

            <div class="wrap-login100 p-t-50 p-b-90" id="show-method">
                <span class="login100-form-title p-b-51">
                    {{ __('all.login') }} <br>
                </span>
                
                <span class="login100-form-subtitle">
                    {{ __('all.welcome_us') }} <br>
                </span>

                <center>
                    <h4><b>{{ __('all.header_pass') }}</b></h4>
                </center>
                <br>
                <div class="wrap-input100 validate-input m-b-16">
                    <nav class="list-group">
                        <a href="#" class="list-group-item shadow-sm" onclick="showForm('show-pin', 'show-method')"><i class="fa fa-map-pin mr-2"></i></i> {{ __('all.pin') }} <span class="float-right"><i class="fa fa-arrow-right"></i></span></a>
                        <a href="#" class="list-group-item shadow-sm" onclick="sendCode('show-method')"><i class="fa fa-mobile mr-2"></i></i> {{ __('all.phone') }} <span class="float-right"><i class="fa fa-arrow-right"></i></span></a>
                    </nav>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <p class="text-center mt-4">{{ __('all.login_with') }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="" class="btn btn-block mb-2" style="background-color: #405D9D; color: #fff"> <i class="fa fa-facebook-f"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="#" id="googleLogin" class="btn btn-google btn-block mb-4" style="background-color: #af0000; color: #fff"> <i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
			</div> 

            <div class="wrap-login100 p-t-50 p-b-90" id="show-pin">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#" id="postpin">
                    <span class="login100-form-title p-b-51">
                        {{ __('all.login') }}
                    </span>
                    
                    <span class="login100-form-subtitle">
                        {{ __('all.welcome_us') }} <br>
                    </span>

                    <span style="text-align:center;width:100%">
                        <b>{{ __('all.placeholder.pin') }}</b> <br>
                        {{ __('all.comment_pin') }}
                    </span>
                    <br><br>
                    <div class="wrap-input100 validate-input m-b-16">
                        <div class="form-group">
                            <div class="input-pin d-flex justify-content-center">
                                <input name="pin1" id="pin1" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin2" id="pin2" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin3" id="pin3" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin4" id="pin4" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin5" id="pin5" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin6" id="pin6" class="form-control form-pin only-number" maxLength="1" required type="text">
                            </div>
                        </div>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button type="button" class="login100-form-btn btnSave" disabled id="save-pin" onclick="loginbyPin('show-pin')">
                            {{ __('all.login') }}
                        </button>
                    </div>
                </form>
                <div class="row mt-3">
                    <div class="col-12">
                        <p class="text-center mt-4">{{ __('all.login_with') }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="" class="btn btn-block mb-2" style="background-color: #405D9D; color: #fff"> <i class="fa fa-facebook-f"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="#" id="googleLogin" class="btn btn-google btn-block mb-4" style="background-color: #af0000; color: #fff"> <i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
            </div>  
            
            <div class="wrap-login100 p-t-50 p-b-90" id="show-otp">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#" id="postpin">
                    <span class="login100-form-title p-b-51">
                        {{ __('all.login') }}
                    </span>
                    
                    <span class="login100-form-subtitle">
                        {{ __('all.welcome_us') }} <br>
                    </span>

                    <span style="text-align:center;width:100%">
                        <b>{{ __('all.placeholder.otp') }}</b> <br>
                        {{ __('all.comment_otp') }}
                    </span>
                    <br><br>
                    <div class="wrap-input100 validate-input m-b-16">
                        <div class="form-group">
                            <div class="input-pin d-flex justify-content-center">
                                <input name="pin1" id="pin1" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin2" id="pin2" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin3" id="pin3" class="form-control form-pin only-number" maxLength="1" required type="text">
                                <input name="pin4" id="pin4" class="form-control form-pin only-number" maxLength="1" required type="text">
                            </div>
                        </div>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button type="button" class="login100-form-btn btnSave" disabled id="save-pin" onclick="loginbyOtp('show-otp')">
                            {{ __('all.login') }}
                        </button>
                    </div>
                </form>
                <div class="row mt-3">
                    <div class="col-12">
                        <p class="text-center mt-4">{{ __('all.login_with') }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="" class="btn btn-block mb-2" style="background-color: #405D9D; color: #fff"> <i class="fa fa-facebook-f"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="#" id="googleLogin" class="btn btn-google btn-block mb-4" style="background-color: #af0000; color: #fff"> <i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
			</div> 
	</div>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/js/main.js') }}"></script>
    <!-- sweetalert js -->
    <script src="{{ asset('assets/admin/js/sweetalert.js') }}"></script>
    <!-- validator js -->
    <script src="{{ asset('assets/admin/js/bootstrapvalidator.min.js') }}"></script>
    <!-- ploading js -->
	<script src="{{ asset('assets/admin/js/p-loading/p-loading.js') }}"></script>
	<!-- Select 2 -->
    <script src="{{ asset('assets/admin/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select2/id.js') }}"></script>
	<!-- generic js -->
	<script src="{{ asset('assets/admin/js/generic.js') }}"></script>
	
	<script>
        $('#show-password').hide();
        $('#show-method').hide();
        $('#show-pin').hide();
        $('#show-otp').hide();

		function validasiLogin(params) {
			username = $('#email').val();

			if (username != '') {
				$.ajax({
					type	: "POST",
                    url		: "{{ route('validateLogin') }}",
					data	: {
                        _token  : "{{ csrf_token() }}",
                        email   : $('#email').val()
                    },
					dataType: "JSON",
					beforeSend: function(){
						$(".btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#"+params).ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
                            $('#show-email').hide();
                            if (data.data == 'email') {
                                $('#show-password').show();
                            } else {
                                $('#show-method').show();
                            }
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
						}
					},
					complete    : function(){
						$(".btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#"+params).ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				});
			}
        }

        function loginbyEmail(params) {
			password = $('#password').val();

			if (password != '') {
				$.ajax({
					type	: "POST",
                    url		: "{{ route('loginbyPassword') }}",
					data	: {
                        _token  : "{{ csrf_token() }}",
                        email   : $('#email').val(),
                        password: $('#password').val()
                    },
					dataType: "JSON",
					beforeSend: function(){
						$(".btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#"+params).ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.login_us") }}');
                            window.location = "{{ route('index') }}";
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
						}
					},
					complete    : function(){
						$(".btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#"+params).ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				});
			}
        }

        function loginbyPin(params) {
            var pin1    = $('#pin1').val();
            var pin2    = $('#pin2').val();
            var pin3    = $('#pin3').val();
            var pin4    = $('#pin4').val();
            var pin5    = $('#pin5').val();
            var pin6    = $('#pin6').val();

            if (pin1 != '' || pin2 != '' || pin3 != '' || pin4 != '' || pin5 != '' || pin6 != '') {
				$.ajax({
					type	: "POST",
                    url		: "{{ route('loginbyPin') }}",
					data	: {
                        _token  : "{{ csrf_token() }}",
                        email   : $('#email').val(),
                        pin     : $('#pin1').val()+''+$('#pin2').val()+''+$('#pin3').val()+''+$('#pin4').val()+''+$('#pin5').val()+''+$('#pin6').val()
                    },
					dataType: "JSON",
					beforeSend: function(){
						$(".btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#"+params).ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.login_us") }}');
                            window.location = "{{ route('index') }}";
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
						}
					},
					complete    : function(){
						$(".btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#"+params).ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				});
            } else {
                notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
            }
        }

        function sendCode(params) {
            $.ajax({
                type	: "POST",
                url		: "{{ route('sendCode') }}",
                data	: {
                    _token  : "{{ csrf_token() }}",
                    phone   : $('#email').val(),
                },
                dataType: "JSON",
                beforeSend: function(){
                    $(".btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
                    $("#"+params).ploading({action : 'show'});
                },
                success      : function (data) {
                    if (data.code == 0) {
                        showForm('show-otp','show-method');
                    }
                },
                complete     : function(){
                    $(".btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
                    $("#"+params).ploading({action : 'hide'});
                },
                error 		: function(){
                    notif('error', '{{ __("all.error") }}');
                }
            });
        }

        function loginbyOtp(params) {
            var pin1    = $('#pin1').val();
            var pin2    = $('#pin2').val();
            var pin3    = $('#pin3').val();
            var pin4    = $('#pin4').val();

            if (pin1 != '' || pin2 != '' || pin3 != '' || pin4 != '') {
				$.ajax({
					type	: "POST",
                    url		: "{{ route('loginbyOtp') }}",
					data	: {
                        _token  : "{{ csrf_token() }}",
                        email   : $('#email').val(),
                        token   : $('#pin1').val()+''+$('#pin2').val()+''+$('#pin3').val()+''+$('#pin4').val()
                    },
					dataType: "JSON",
					beforeSend: function(){
						$(".btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#"+params).ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.login_us") }}');
                            window.location = "{{ route('index') }}";
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
						}
					},
					complete    : function(){
						$(".btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#"+params).ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				});
            } else {
                notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
            }
        }

        function showForm(id, kd) {
            $('#'+id).show();
            $('#'+kd).hide();
        }

        $(document).ready(function () {
            $(".form-pin").keyup(function (e) {
                if (this.value.length == this.maxLength) {
                    $(this).next('.form-pin').focus();
                } 

                if (e.code == 'Backspace') {
                    // $(this).next('.form-pin').focus();
                }
            });
        });
	</script>

</body>
</html>