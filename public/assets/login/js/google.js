/* Google Auth */
var googleUser = {};
var startApp = function () {
    gapi.load('auth2', function () {
        auth2 = gapi.auth2.init({
            client_id: '404874804614-i5celo8pa2d2ciacvro4717sljamt11n.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
        });
        attachSigninGoogle(document.getElementById('googleLogin'));
    });
};

function attachSigninGoogle(element) {
    auth2.attachClickHandler(element, {},
        function (googleUser) {
            var profile     = googleUser.getBasicProfile();
            var url         = '/login_by_google';
            var email       = profile.getEmail();
            var id_token    = googleUser.getAuthResponse().id_token;

            $.ajax({
                type    : "GET",
                url     : url,
                data    : {username: email, token: id_token},
                success : function (response) {
                    window.location.replace(response);
                }
            });
        }
    );
}
/* End Google Auth */
