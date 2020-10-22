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
			<img src="{{ asset('assets/admin/image/mitra-nazar web-05.png') }}" alt="background-logo" style="width:50vw;height:50vh">
			<div class="wrap-login100 p-t-50 p-b-90" id="show-login">
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
							<a href="#" class="txt1" onclick="showEmail()">
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
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
			</div>
			
			<div class="wrap-login100 p-t-50 p-b-90" id="show-email" hidden>
				<div class="back-login">
					<a href="#" onclick="showLogin()" id="backLogin"><span class="fa fa-arrow-left" style="font-weight:900"> Login</span> </a> 
					<hr>
				</div>
				<span class="login100-form-title p-b-51">
					{{ __('all.welcome') }} <br>
				</span>
				
				<span class="login100-form-subtitle">
					<nav class="nav nav-custome nav-justified">
						<a class="nav-item nav-link disabled email" href="#">Email</a>
						<a class="nav-item nav-link disabled token" href="#">Token</a>
						<a class="nav-item nav-link disabled password" href="#">{{ __('all.button.newP') }}</a>
					</nav> <br>
				</span>

				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#">
					<div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.email') }}">
						<input class="input100" type="email" name="email" id="email" placeholder="{{ __('all.placeholder.email') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="submit" class="login100-form-btn" id="save-email" onclick="generateToken()">
							{{ __('all.save') }}
						</button>
					</div>
				</form>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
			</div>

			<div class="wrap-login100 p-t-50 p-b-90" id="show-token" hidden>
				<span class="login100-form-title p-b-51">
					{{ __('all.welcome') }} <br>
				</span>
				
				<span class="login100-form-subtitle">
					<nav class="nav nav-custome nav-justified">
						<a class="nav-item nav-link disabled email" href="#">Email</a>
						<a class="nav-item nav-link disabled token" href="#">Token</a>
						<a class="nav-item nav-link disabled password" href="#">{{ __('all.button.newP') }}</a>
					</nav> <br>
				</span>

				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#">
					<b>* {{ __('all.comment_token') }}</b>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.token') }}">
						<input class="input100" type="text" name="token" id="token" placeholder="{{ __('all.placeholder.token') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="submit" class="login100-form-btn" id="save-token" onclick="verifyToken()">
							{{ __('all.save') }}
						</button>
					</div>
				</form>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>

			</div>

			<div class="wrap-login100 p-t-50 p-b-90" id="show-password" hidden>
				<span class="login100-form-title p-b-51">
					{{ __('all.welcome') }} <br>
				</span>
				
				<span class="login100-form-subtitle">
					<nav class="nav nav-custome nav-justified">
						<a class="nav-item nav-link disabled email" href="#">Email</a>
						<a class="nav-item nav-link disabled token" href="#">Token</a>
						<a class="nav-item nav-link disabled password" href="#">{{ __('all.button.newP') }}</a>
					</nav> <br>
				</span>

				<form class="login100-form validate-form flex-sb flex-w" method="post" action="#">
					<div class="wrap-input100 validate-input m-b-16" data-validate = "{{ __('all.validation.new') }}">
						<input class="input100" type="text" name="password" id="newpassword" placeholder="{{ __('all.placeholder.new_password') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="submit" class="login100-form-btn" id="save-password" onclick="createPassword()">
							{{ __('all.save') }}
						</button>
					</div>
				</form>
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center mt-2">Mitra Nazar ID © 2019 - {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
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
		function login() {
			username = $('#username').val();
			password = $('#password').val();

			if (username != '' || password != '') {
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

		$(document).on('keyup','.input100', function () {
			if (event.keyCode === 13) {
				$("button[type='button']").click();
			}
		});

		function navigasi(id, kd, cd) {
			$('#show-'+id).removeAttr('hidden');
			$('#show-'+id).find('.disabled.'+id).removeClass('disabled').addClass('active');

			$('#show-'+kd).attr('hidden', true);
			$('#show-'+kd).find('.disabled.'+kd).removeClass('active').addClass('disabled');

			$('#show-'+cd).attr('hidden', true);
			$('#show-'+cd).find('.disabled.'+cd).removeClass('active').addClass('disabled');
		}

		function generateToken() {
			if ($('#email').val() != null && $('#email').val() != '') {
				$.ajax({
					type		: "POST",
					url			: "{{ route('generateToken') }}",
					headers		: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data		: {
						"_token": "{{ csrf_token() }}",
						email	: $('#email').val()
					},
					dataType: "JSON",
					beforeSend: function(){
						$("#save-email").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#show-email").ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
							showToken();
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
						}
					},
					complete    : function(){
						$("#save-email").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#show-email").ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				})
			}
		}

		function verifyToken() {
			if ($('#token').val() != null && $('#token').val() != '') {
				$.ajax({
					type		: "POST",
					url			: "{{ route('verifyToken') }}",
					headers		: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data		: {
						"_token": "{{ csrf_token() }}",
						email	: $('#email').val(),
						token	: $('#token').val()
					},
					dataType: "JSON",
					beforeSend: function(){
						$("#save-token").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#show-token").ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
							showPassword();
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
						}
					},
					complete    : function(){
						$("#save-token").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#show-token").ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				})
			}
		}

		function createPassword() {
			if ($('#newpassword').val() != null && $('#newpassword').val() != '') {
				$.ajax({
					type		: "POST",
					url			: "{{ route('createPassword') }}",
					headers		: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data		: {
						"_token": "{{ csrf_token() }}",
						email	: $('#email').val(),
						token	: $('#token').val(),
						password: $('#newpassword').val()
					},
					dataType: "JSON",
					beforeSend: function(){
						$("#save-password").buttonLoader('show', '{{ __("all.buttonloader.wait") }}');
						$("#show-password").ploading({action : 'show'});
					},
					success     : function(data){
						if (data.code == 0) {
							notif('success', '{{ __("all.success") }}', '{{ __("all.alert.success") }}');
							$('#show-password').hide();
							$('#show-login').show();
						} else {
							notif('warning', '{{ __("all.warning") }}', '{{ __("all.alert.fail") }}');
						}
					},
					complete    : function(){
						$("#save-password").buttonLoader('hide', '{{ __("all.buttonloader.done") }}');
						$("#show-password").ploading({action : 'hide'});
					},
					error 		: function(){
						notif('error', '{{ __("all.error") }}');
					}
				})
			}
		}

		function showLogin() {
			$("#show-email").animate({
				width: [ "toggle", "swing" ],
				height: [ "toggle", "swing" ],
				opacity: "toggle"
			}, 1000, "linear", function() {
				$('#show-login').show('slow');
			});
		}

		function showEmail() {
			$("#show-login").animate({
				width: [ "toggle", "swing" ],
				height: [ "toggle", "swing" ],
				opacity: "toggle"
			}, 500, "linear", function() {
				$('#show-email').show('slow');
				navigasi('email','token','password');
			});
		}

		function showToken() {
			$("#show-email").animate({
				width: [ "toggle", "swing" ],
				height: [ "toggle", "swing" ],
				opacity: "toggle"
			}, 1000, "linear", function() {
				$('#show-token').show('slow');
				navigasi('token','email','password');
			});
		}

		function showPassword() {
			$("#show-token").animate({
				width: [ "toggle", "swing" ],
				height: [ "toggle", "swing" ],
				opacity: "toggle"
			}, 1000, "linear", function() {
				$('#show-password').show('slow');
				navigasi('password','token','email');
			});
		}
	</script>

</body>
</html>