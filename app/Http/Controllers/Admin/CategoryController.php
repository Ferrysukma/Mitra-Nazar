<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
    }

    public function index()
    {   
        return view('admin.category_list');
    }

    public function loadlist(Request $request)
    {
        $client     = new Client();

        $url        = $this->base_url . 'mitra/admin/kategori/list';
        
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 1000000000,
                    "pageNumber"    => 0,
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $row[]  = $value;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = 'empty';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function create(Request $request)
    {
        $client     = new Client();
        
        if (isset($request->id) && !empty($request->id)) {
            $url        = $this->base_url . 'mitra/admin/kategori/edit';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "id"    => $request->id,
                        "name"  => $request->name,
                    ]
                ]
            ]);
        } else {
            $url        = $this->base_url . 'mitra/admin/kategori/create';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "name"  => $request->name,
                    ]
                ]
            ]);
        }
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
            
    }

    public function delete(Request $request)
    {
        $client     = new Client();
        
        $url        = $this->base_url . 'mitra/admin/kategori/disable';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "id"         => $request->id
                ]
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

}