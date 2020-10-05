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
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#" id="postlogin">
					@csrf
					<span class="login100-form-title p-b-51">
                        {{ __('all.login') }} <br>
                    </span>
                    
                    <span class="login100-form-subtitle">
                        {{ __('all.welcome') }}
					</span>
                    
					<div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.username') }}">
						<input class="input100" type="text" name="username" id="username" placeholder="{{ __('all.placeholder.username') }}">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.password') }}">
						<input class="input100" type="password" name="password" id="password" placeholder="{{ __('all.placeholder.password') }}">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								{{ __('all.remember') }}
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								{{ __('all.forget') }}
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="button" class="login100-form-btn" id="btnSave" onclick="login()">
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
		function login() {
			username = $('#username').val();
			password = $('#password').val();

			if (username != '' && password != '') {
				$.ajax({
					type	: "POST",
					url		: "{{ route('login_by_pass') }}",
					data	: $('#postlogin').serialize(),
					dataType: "JSON",
					beforeSend: function(){
						$("#btnSave").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#postlogin").ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.login") }}');
							window.location = "{{ route('home') }}";
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail_login") }}');
						}
					},
					complete    : function(){
						$("#btnSave").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#postlogin").ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				});
				
			}
		}
	</script>

</body>
</html>