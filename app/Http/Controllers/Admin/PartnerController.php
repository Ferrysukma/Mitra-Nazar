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
    }

    public function index()
    {
        return view('admin.partner_list');
    }

    public function loadList(Request $request)
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
                    "search"        => $request->search,
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            $row    = [];
            foreach ($result as $value) {
                $explode            = explode(',', $value->koordinat);
                if ($value->active == true) {
                    $value->action      = "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='".__('all.button.edit')."' data-toggle='tooltip' data-placement='top' id='".$value->id."'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger action-delete' id='".$value->id."' status='".$value->active."' title='".__('all.button.delete')."' data-toggle='tooltip' data-placement='top'><i class='fa fa-times'></i></button></div>";
                } else {
                    $value->action      = "<div class='btn-group'><button type='button' class='btn btn-sm btn-warning action-edit' title='".__('all.button.edit')."' data-toggle='tooltip' data-placement='top' id='".$value->id."'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-success action-active' id='".$value->id."' status='".$value->active."' title='".__('all.button.active')."' data-toggle='tooltip' data-placement='top'><i class='fa fa-check'></i></button></div>";
                }

                $value->active      = $value->active == true ? '<span class="badge badge-success">'.__('all.active')."</span>" : '<span class="badge badge-danger">'.__('all.noactive')."</span>";
                $value->koordinat   = "<a target='_blank' href='http://maps.google.com/?ll=".$value->koordinat."'>".__('all.open_maps')." <i class='fa fa-map-marker-alt'></i></a>";
                $value->lat         = $explode[0];
                $value->long        = $explode[1];
                $row[]              = $value;
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = 'empty';
            
            return json_encode(array('code' => 1, 'info' => $desc, 'data' => $result));
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
                    "limit"         => 100000000,
                    "pageNumber"    => 0,
                    "search"        => $request->search
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $prov   = [];
            foreach ($result as $key => $value) {
                array_push($prov, $value->provinsi);
            }

            $data   = array_count_values($prov);
            $row    = [];
            foreach ($data as $rows => $val) {
                $explode = $this->getLatLong($rows);
                $name    = $rows;
                $lat     = $explode['lat'];
                $long    = $explode['long'];
                $row[]   = [$name, $lat, $long, $val];
            }
            
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = 'empty';
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function getLatLong($params)
    {
        $address    = str_replace(' ', '', $params);
        // Get lattitude & longitude ---
        $apiKey     = 'AIzaSyC7Ah8Zuhy2ECqqjBNF8ri2xJ7mwwtIbwo'; // Google maps now requires an API key.
        $results    = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . $apiKey);
        $json       = json_decode($results, true);

        $latitude   = $json['results'][0]['geometry']['location']['lat']; // Latitude
        $longitude  = $json['results'][0]['geometry']['location']['lng']; // Longitude

        return array('lat' => $latitude, 'long' => $longitude);
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
                        "provinsi"      => $request->provinsi,
                        "kota"          => $request->city,
                        "kecamatan"     => $request->district,
                        "alamat"        => $request->address,
                        "desa"          => $request->desa,
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
                        "provinsi"      => $request->provinsi,
                        "kota"          => $request->city,
                        "kecamatan"     => $request->district,
                        "koordinat"     => $request->lat.", ".$request->long,
                        "alamat"        => $request->address,
                        "desa"          => $request->desa,
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
        $status     = $request->active == '1' ? false : true;
        $url        = $this->base_url . 'mitra/admin/disable-mitra';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "id"        => $request->id,
                    "active"    => $status
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
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            return json_encode(array('code' => 1, 'info' => $desc, 'data' => null));
        }
    }

    public function findProv(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/province';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "query" => $request->filter
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $rows  = "<a class='dropdown-item' name='".$value->province."' id=".$value->provinceId." onclick='filterProv(this)'>".$value->province."</a>";
                $row[]  = $rows;
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function findCity(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/city';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "provinceId"    => $request->filter,
                "query"         => $_POST['query']
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $rows  = "<a class='dropdown-item' name='".$value->city."' id=".$value->id." onclick='filterCity(this)'>".$value->city."</a>";
                $row[]  = $rows;
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }
}
