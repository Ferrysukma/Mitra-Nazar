<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
    }

    public function loadList(Request $request)
    {
        $client     = new Client();

        $url        = $this->base_url . 'user/bankaccount';
        
        $request    = $client->get($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            $rows   = [];
            $count  = 0;
            foreach ($result as $key => $value) {
                $value->namaBank= isset($value->bankInfo) ? $value->bankInfo->namaBank : '';
                $value->bankId  = isset($value->bankInfo) ? $value->bankInfo->kodeBank : '';
                $rows[]         = $value;
                $count          += $key;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => array('data' => $rows, 'count' => $count)));
        } else {
            $result = 'empty';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function create(Request $request)
    {
        $client     = new Client();
        
        if (isset($request->id) && !empty($request->id)) {
            $url        = $this->base_url . 'user/bankaccount/edit';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
                'json'      => [
                    "payload"   => [
                        "id"                    => $request->id,
                        "bankId"                => $request->kodeBank,
                        "nomorRekening"         => $request->nomorRekening,
                        "namaPemilikRekening"   => $request->namaPemilikRekening,
                    ]
                ]
            ]);
        } else {
            $url        = $this->base_url . 'user/savebankaccount';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
                'json'      => [
                    "payload"   => [
                        "bankId"                => $request->kodeBank,
                        "nomorRekening"         => $request->nomorRekening,
                        "namaPemilikRekening"   => $request->namaPemilikRekening,
                    ]
                ]
            ]);
        }
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => $desc, 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => $desc, 'data' => null));
        }
            
    }

    public function delete(Request $request)
    {
        $client     = new Client();
        
        $url        = $this->base_url . 'user/bankaccount/delete';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                "payload"   => $request->id
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => $desc, 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => $desc, 'data' => null));
        }
    }

}