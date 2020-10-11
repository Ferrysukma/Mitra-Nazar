<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
    }

    public function index()
    {
        return view('user.login');
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
            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $type));
        } else {
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
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
            Session::put('admin_key', json_decode((string) $responseBodyAsString, true)['token']);
            Session::put('type', json_decode((string) $responseBodyAsString, true))['type'];
            Session::put('storeLink', json_decode((string) $responseBodyAsString, true))['storeLink'];
            Session::put('idUser', json_decode((string) $responseBodyAsString, true))['id'];

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('admin_key')));
        } else {
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
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
            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
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
            Session::put('admin_key', json_decode((string) $responseBodyAsString, true)['token']);
            Session::put('type', json_decode((string) $responseBodyAsString, true))['type'];
            Session::put('storeLink', json_decode((string) $responseBodyAsString, true))['storeLink'];
            Session::put('idUser', json_decode((string) $responseBodyAsString, true))['id'];

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('admin_key')));
        } else {
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function loginbyOtp(Request $request)
    {   
        $client = new Client();
        $phone  = $request->email;
        $token  = $request->token;
        try {
            $url_otp      = $this->base_url . 'user/request-otp/validate';
            $request_otp  = $client->post($url_otp, [
                'json'    => [
                    "payload" => [
                        "phoneNumber" => $email,
                        "token"       => $token,
                        "type"        => 'token'
                    ]
                ],
            ]);

            $responseBodyAsString = $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response             = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }

        if ($response->getStatusCode() == '200') {
            $url        = $this->base_url . 'user/login-mitra';
            $requestL   = $client->post($url, [
                'json'      => [
                    'emailOrPhone'  => $phone,
                    'token'         => $token,
                    'type'          => 'token'
                ]
            ]);

            $responseL          = $requestL->getBody()->getContents();
            $data               = json_decode($responseL);

            if ($data->status->statusCode == '000') {
                Session::put('admin_key', json_decode((string) $responseBodyAsString, true)['token']);
                Session::put('type', json_decode((string) $responseBodyAsString, true))['type'];
                Session::put('storeLink', json_decode((string) $responseBodyAsString, true))['storeLink'];
                Session::put('idUser', json_decode((string) $responseBodyAsString, true))['id'];

                echo json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('admin_key')));
            } else {
                echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
            }
        } else {
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/user/login');
    }
}
