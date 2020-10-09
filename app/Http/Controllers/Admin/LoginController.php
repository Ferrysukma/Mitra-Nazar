<?php

namespace App\Http\Controllers\Admin;

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
        return view('auth.login');
    }

    public function login_by_pass(Request $request)
    {   
        $client = new Client();
        $url = $this->base_url . 'mitra/admin/login';
        try {
            $response = $client->post($url, [
                'json'    => [
                    "email"     => $request->username,
                    "password"  => $request->password,
                ],
            ]);

            $responseBodyAsString = $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response             = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }

        if ($response->getStatusCode() == '200') {
            Session::put('admin_key', json_decode((string) $responseBodyAsString, true)['token']);
            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => Session::get('admin_key')));
        } else {
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login_admin');
    }
    
    public function generateToken(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'mitra/admin/reset-password';
        $request = $client->post($url, [
            'json'      => [
                "email"     => $request->email,
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $description= json_decode((string) $response, true)['status']['statusDesc'];
        
        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }   
    }

    public function verifyToken(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'mitra/admin/verify-reset-password';
        $request = $client->post($url, [
            'json'      => [
                "email"     => $request->email,
                "token"     => $request->token
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $description= json_decode((string) $response, true)['status']['statusDesc'];
        
        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }   
    }

    public function createPassword(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'mitra/admin/generate-password';
        $request = $client->post($url, [
            'json'      => [
                "email"     => $request->email,
                "token"     => $request->token,
                "password"  => $request->password
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $description= json_decode((string) $response, true)['status']['statusDesc'];
        
        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }   
    }
}
