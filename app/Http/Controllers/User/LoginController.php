<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Socialite;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->client   = new Client();
        $this->base_url = Controller::api();
    }

    public function index()
    {
        $lang   = Session::get('locale');
        empty($lang) ? Session::put('locale', 'id') : '';
        Session::put('typeLogin', 'user');
        return view('user.login');
    }

    public function loginbyNazar($token)
    {
        $client = new Client();
        $url    = $this->base_url . 'user/home-mitra';
        
        $response = $client->get($url, [
            'headers'   => [
                'Authorization' => $token
            ],
        ]);
    
        $response   = $response->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];
        
        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            Session::put('user_key', $token);
            Session::put('name', strtok($result->profile->name, ' '));
            Session::put('image', $result->profile->image);

            return redirect()->route('index');
        } else {
            return "<script>alert('".$desc."'); window.location = '".route('index')."'</script>";
        }
    }

    public function widget($token, $year)
    {
        $client     = new Client();
        $year       = isset($year) && !empty($year) ? $year : '2020';
        $url        = $this->base_url . 'user/komisi-mitra';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => $token
            ],
            'json'      => [
                'payload'   => [
                    'tahun' => $year
                ]
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            $rows   = [];
            foreach ($result as $key) {
                $rows[]         = $key->periode;
            } 
            
            $arr = [];

            for ($i=1; $i <= 12; $i++) { 
                $i      = strlen($i) > 1 ? $i : '0'.$i;
                $false  = count(array_keys($rows, $year.'-'.$i));
                if (!$false) {
                    $arr[]      = (object) ['amount' => 0, 'periode' => date('M', strtotime($year.'-'.$i))];
                }
            }

            foreach ($result as $data) {
                $data->periode  = date('M', strtotime($data->periode));
                $arr[]          = $data;
            } 

            usort($arr, function($a1, $a2) {
                $v1 = strtotime($a1->periode);
                $v2 = strtotime($a2->periode);
                return $v1 - $v2; // $v2 - $v1 to reverse direction
            });

            return view('user.widget', array('result' => $arr));
        }
    }

    public function validateLogin(Request $request)
    {
        $client     = new Client();
        $email      = $request->email;
        $url        = $this->base_url . 'user/validate';
        $request    = $client->post($url, [
            'json'      => [
                'payload'       => $email
            ]
        ]);

        $response       = $request->getBody()->getContents();
        $data           = json_decode($response);

        strstr($email, '@') ? $type = 'email' : $type = 'phone';

        if ($data->status->statusCode == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $type));
        } else {
            return json_encode(array('code' => 1, 'info' => $data->status->statusDesc, 'data' => null));
        }
    }

    public function loginbyPassword(Request $request)
    {
        $client = new Client();
        try {
            $url        = $this->base_url . 'user/login-mitra';
            $response   = $client->post($url, [
                'json'      => [
                    'emailOrPhone'   => $request->email,
                    'password'       => $request->password,
                ]
            ]);

            $responseBodyAsString = $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response             = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }

        if ($response->getStatusCode() == '200') {
            Session::put('user_key', json_decode((string) $responseBodyAsString, true)['token']);
            Session::put('type', json_decode((string) $responseBodyAsString, true)['type']);
            Session::put('storeLink', json_decode((string) $responseBodyAsString, true)['storeLink']);
            Session::put('idUser', json_decode((string) $responseBodyAsString, true)['id']);

            $url_home   = $this->base_url . 'user/home-mitra';
            $req_home   = $client->get($url_home, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
            ]);

            $res_home   = $req_home->getBody()->getContents();
            $status     = json_decode((string) $res_home, true)['status']['statusCode'];

            if ($status == '000') {
                $result = json_decode((string) $res_home)->payload;
                Session::put('name', strtok($result->profile->name, ' '));
                Session::put('image', $result->profile->image);
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('user_key')));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function sendCode(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'user/request-otp';
        $request    = $client->post($url, [
            'headers'   => [
                'Content-Type'  => 'application/json'
            ],
            'json'      => [
                'payload'       => [
                    'phoneNumber'   => $request->phone,
                    'randomDigit'   => 4,
                    'type'          => 'LOGIN'
                ]
            ]
        ]);

        $response       = $request->getBody()->getContents();
        $data           = json_decode($response);
        
        if ($data->status->statusCode == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function loginbyPin(Request $request)
    {
        $client = new Client();
        try {
            $url        = $this->base_url . 'user/login-mitra';
            $response   = $client->post($url, [
                'json'      => [
                    'emailOrPhone'  => $request->email,
                    'pin'           => $request->pin,
                    'type'          => 'pin'
                ]
            ]);

            $responseBodyAsString = $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response             = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }

        if ($response->getStatusCode() == '200') {
            Session::put('user_key', json_decode((string) $responseBodyAsString, true)['token']);
            Session::put('type', json_decode((string) $responseBodyAsString, true)['type']);
            Session::put('storeLink', json_decode((string) $responseBodyAsString, true)['storeLink']);
            Session::put('idUser', json_decode((string) $responseBodyAsString, true)['id']);

            $url_home   = $this->base_url . 'user/home-mitra';
            $req_home   = $client->get($url_home, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
            ]);

            $res_home   = $req_home->getBody()->getContents();
            $status     = json_decode((string) $res_home, true)['status']['statusCode'];

            if ($status == '000') {
                $result = json_decode((string) $res_home)->payload;
                Session::put('name', strtok($result->profile->name, ' '));
                Session::put('image', $result->profile->image);
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('user_key')));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function loginbyOtp(Request $request)
    {
        $client = new Client();
        try {
            $phone  = $request->email;
            $token  = $request->token;
            
            $url        = $this->base_url . 'user/login-mitra';
            $response   = $client->post($url, [
                'json'      => [
                    'emailOrPhone'  => $phone,
                    'token'         => $token,
                    'type'          => 'token'
                ]
            ]);

            $responseBodyAsString = $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response             = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }

        if ($response->getStatusCode() == '200') {
            Session::put('user_key', json_decode((string) $responseBodyAsString, true)['token']);
            Session::put('type', json_decode((string) $responseBodyAsString, true)['type']);
            Session::put('storeLink', json_decode((string) $responseBodyAsString, true)['storeLink']);
            Session::put('idUser', json_decode((string) $responseBodyAsString, true)['id']);

            $url_home   = $this->base_url . 'user/home-mitra';
            $req_home   = $client->get($url_home, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
            ]);

            $res_home   = $req_home->getBody()->getContents();
            $status     = json_decode((string) $res_home, true)['status']['statusCode'];

            if ($status == '000') {
                $result = json_decode((string) $res_home)->payload;
                Session::put('name', strtok($result->profile->name, ' '));
                Session::put('image', $result->profile->image);
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('user_key')));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false' , 'data' => null));
        }
    }

    public function loginbyGoogle(Request $request)
    {
        $client     = new client();
        $username   = $request->username;
        $token      = $request->token;

        // API Validate User
        $url        = $this->base_url . 'user/validate';
        $request    = $client->post($url, [
            'headers'   => [
                'Content-Type'  => 'application/json'
            ],
            'json'      => [
                'payload'       => $username
            ]
        ]);
        $response       = $request->getBody()->getContents();
        $data           = json_decode($response);

        if ($data->status->statusCode == '000') {
            // API Login Google
            try {
                $url_login      =  $this->base_url . 'user/login-mitra';
                $request_login  = $this->client->post($url_login, [
                    'headers' => ['Content-type' => 'application/json'],
                    'json'    => [
                        'email'   => $username,
                        'idToken' => $token,
                        'type'    => "google",
                    ],
                ]);
                $response_login       = $request_login->getBody()->getContents();
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $request_login        = $e->getResponse();
                $response_login       = $request_login->getBody()->getContents();
            }
            $data_login         = json_decode($response_login);

            if (empty($data_login->status->statusCode)) {
                Session::put('user_key', $data_login->token);
                Session::put('type', $data_login->type);
                Session::put('storeLink', $data_login->storeLink);
                Session::put('idUser', $data_login->id);

                $url_home   = $this->base_url . 'user/home-mitra';
                $req_home   = $this->client->get($url_home, [
                    'headers'   => [
                        'Authorization' => Session::get('user_key')
                    ],
                ]);

                $res_home   = $req_home->getBody()->getContents();
                $status     = json_decode((string) $res_home, true)['status']['statusCode'];

                if ($status == '000') {
                    $result = json_decode((string) $res_home)->payload;
                    Session::put('name', strtok($result->profile->name, ' '));
                    Session::put('image', !empty($result->profile->image) ? $result->profile->image : '');
                }

                return ('/');
            } else {
                redirect('/user/login');
            }
        } else {
            redirect('/user/login');
        }
    }

    public function loginbySosmed($params)
    {
        return Socialite::driver($params)->redirect();
    }

    public function loginbyFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        // API Validate User
        $url        = $this->base_url . 'user/validate';
        $request    = $this->client->post($url, [
            'headers'   => [
                'Content-Type'  => 'application/json'
            ],
            'json'      => [
                'payload'       => $user->email
            ]
        ]);
        $response       = $request->getBody()->getContents();
        $data           = json_decode($response);

        if ($data->status->statusCode == '000') {
            if ($this->loginbyFacebookProcess($user->email, $user->id) == true) {
                return redirect('/');
            } else {
                return redirect('/user/login');
            }
        }
    }

    public function loginbyFacebookProcess($email, $id)
    {
        // API Login By Facebook
        try {
            $url_login      =  $this->base_url . 'user/login-mitra';
            $request_login  = $this->client->post($url_login, [
                'headers' => ['Content-type' => 'application/json'],
                'json'    => [
                    'email'      => $email,
                    'idFacebook' => $id,
                    'type'       => "facebook",
                ],
            ]);
            $response_login       = $request_login->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $request_login        = $e->getResponse();
            $response_login       = $request_login->getBody()->getContents();
        }

        $data_login         = json_decode($response_login);

        if (empty($data_login->status->statusCode)) {
            Session::put('user_key', $data_login->token);
            Session::put('type', $data_login->type);
            Session::put('storeLink', $data_login->storeLink);
            Session::put('idUser', $data_login->id);

            $url_home   = $this->base_url . 'user/home-mitra';
            $req_home   = $this->client->get($url_home, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
            ]);

            $res_home   = $req_home->getBody()->getContents();
            $status     = json_decode((string) $res_home, true)['status']['statusCode'];

            if ($status == '000') {
                $result = json_decode((string) $res_home)->payload;
                Session::put('name', strtok($result->profile->name, ' '));
                Session::put('image', !empty($result->profile->image) ? $result->profile->image : '');
            }

            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/user/login');
    }
}
