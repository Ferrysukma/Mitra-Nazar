<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
        if (empty(Session::get('admin_key'))) {
            return redirect('/login_admin');
        }
    }

    public function index()
    {
        return view('admin.partner_list');
    }

    public function loadlist(Request $request)
    {
        $client     = new Client();

        $search     = $request->search;
        $url        = $this->base_url . 'mitra/admin/list-mitra';
        
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 10000000,
                    "pageNumber"    => 0,
                    "search"        => '',
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            $row    = [];
            foreach ($result as $key => $value) {
                $value->active      = $value->active == '1' ? '<span class="badge badge-success">'.__('all.active')."</span>" : '<span class="badge badge-danger">'.__('all.noactive')."</span>";
                $value->koordinat   = "<a target='_blank' href='http://maps.google.com/?ll=".$value->koordinat."'>".__('all.open_maps')." <i class='fa fa-map-marker-alt'></i></a>";
                $row[]              = $value;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = 'empty';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function listAll(Request $request)
    {
        $client     = new Client();

        $url        = $this->base_url . 'mitra/admin/list-mitra';
        
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 1000,
                    "pageNumber"    => 0,
                    "search"        => ""
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $explode = explode(', ', $value->koordinat);
                $name    = $value->provinsi;
                $lat     = $explode[0];
                $long    = $explode[1];
                $row[]   = [$name, $lat, $long];
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
            $url        = $this->base_url . 'mitra/admin/edit-mitra';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "id"            => $request->id,
                        "userCode"      => $request->userCode,
                        "nama"          => $request->nama,
                        "kategori"      => $request->kategori,
                        "provinsi"      => $request->province,
                        "kota"          => $request->city,
                        "kecamatan"     => $request->district,
                        "alamat"        => $request->address,
                        "koordinat"     => $request->lat.", ".$request->long
                    ]
                ]
            ]);
        } else {
            $url        = $this->base_url . 'mitra/admin/register-mitra';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "userCode"      => $request->userCode,
                        "nama"          => $request->nama,
                        "kategori"      => $request->kategori,
                        "provinsi"      => $request->province,
                        "kota"          => $request->city,
                        "kecamatan"     => $request->district,
                        "koordinat"     => $request->lat.", ".$request->long,
                        "alamat"        => $request->address,
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
        
        $url        = $this->base_url . 'mitra/admin/disable-mitra';
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

    public function find(Request $request)
    {
        $client     = new Client();
        
        $url        = $this->base_url . 'mitra/admin/findUser';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => $request->id
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }
}
