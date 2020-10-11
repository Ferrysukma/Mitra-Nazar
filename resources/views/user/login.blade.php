<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>{{ __('all.login') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon ============================================ -->
	<link rel="shortcut icon" type="assets/image/png" href="{{ asset('assets/admin/image/logo/icon.png') }}" />
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
		.nav-custome .nav-link.active, .show > .nav-custome .nav-link {
			background-color 	: #004185;
			color				: #fff!important;
			font-weight			: 900;
		}

		.nav-custome .nav-link.disabled, .show > .nav-custome .nav-link {
			background-color 	: lightgrey;
			font-weight			: 900;
		}
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
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
                            window.location = "{{ route('home') }}";
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

        $('#show-email').show();
        $('#show-password').hide();
	</script>

</body>
</html>