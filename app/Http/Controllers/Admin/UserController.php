<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class UserController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
    }

    public function index()
    {
        return view('admin.user_list');
    }

    public function loadlist(Request $request)
    {
        $client     = new Client();

        $url        = $this->base_url . 'mitra/admin/user/list';
        
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 100000000,
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
                $value->active  = $value->active == '1' ? '<span class="badge badge-success">'.__('all.active')."</span>" : '<span class="badge badge-danger">'.__('all.noactive')."</span>";
                $row[]          = $value;
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
            $url        = $this->base_url . 'mitra/admin/user/edit';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "id"            => $request->id,
                        "nama"          => $request->nama,
                        "phone"         => $request->phone,
                    ]
                ]
            ]);
        } else {
            $url        = $this->base_url . 'mitra/admin/user/add';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "nama"         => $request->nama,
                        "email"        => $request->email,
                        "phone"        => $request->phone,
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
        
        $url        = $this->base_url . 'mitra/admin/user/disable';
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
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => $desc, 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => $desc, 'data' => null));
        }
    }

    public function changePassword(Request $request)
    {
        $client = new Client();

        $url = $this->base_url . 'mitra/admin/user/change-password';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "oldPassword"     => $request->oldPassword,
                    "newPassword"     => $request->newPassword,
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $description= json_decode((string) $response, true)['status']['statusDesc'];
        
        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => $description, 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => $description, 'data' => null));
        }
    }

    public function edit(Request $request)
    {
        $client = new Client();
        
        $url = $this->base_url . 'mitra/admin/user/edit';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "oldPassword"     => $request->oldPassword,
                    "newPassword"     => $request->newPassword,
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $description= json_decode((string) $response, true)['status']['statusDesc'];
        
        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => $description, 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => $description, 'data' => null));
        }
    }
}
