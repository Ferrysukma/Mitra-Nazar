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
                    "limit"         => 10,
                    "pageNumber"    => 0,
                    "search"        => $search,
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            $row    = [];
            foreach ($result as $key => $value) {
                $status = $value->active == '1' ? '<span class="badge badge-success">'.__('all.active')."</span>" : '<span class="badge badge-danger">'.__('all.noactive')."</span>";
                $no = $key + 1;
                $rows   =   "<tr>
                                <td align='center'>".$no."</td>
                                <td style='display:none'>".$value->id."</td>
                                <td>".$value->userCode."</td>
                                <td>".$value->nama."</td>
                                <td>".$value->tipe."</td>
                                <td>".$value->kategori."</td>
                                <td>".$value->provinsi."</td>
                                <td>".$value->kota."</td>
                                <td>".$value->kecamatan."</td>
                                <td>".$value->alamat."</td>
                                <td>
                                <a target='_blank' href='http://maps.google.com/?ll=".$value->koordinat."'>
                                    ".__('all.open_maps')." <i class='fa fa-map-marker-alt'></i>
                                </a>
                                </td>
                                <td>".$status."</td>
                                <td align='center'>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-warning action-edit'  
                                            title='".__('all.button.edit')."' data-toggle='tooltip' data-placement='top'>
                                            <i class='fa fa-edit'></i>
                                        </button>
                                        <button type='button' class='btn btn-sm btn-danger action-delete'  
                                            title='".__('all.button.delete')."' data-toggle='tooltip' data-placement='top'>
                                            <i class='fa fa-trash'></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>";
                $row[]  = $rows;
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

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
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
