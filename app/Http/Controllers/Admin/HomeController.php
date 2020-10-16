<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
    }

    public function index()
    {
        return view('admin.master');
    }

    public function loadList(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'mitra/admin/list-mitra-chart-detail';
        $city       = isset($request->kota) ? $request->kota : 'bandung';
        $prov       = isset($request->provinsi) ? $request->provinsi : 'Jawa barat';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "start"         => date('Y-m-d', strtotime($request->start)),
                    "limit"         => 100000000,
                    "pageNumber"    => 0,
                    "provinsi"      => $prov,
                    "kota"          => $city,
                    "kategori"      => $request->kategori,
                    "tipe"          => $request->tipe
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $value->active      = $value->active == true ? '<span class="badge badge-success">'.__('all.active')."</span>" : '<span class="badge badge-danger">'.__('all.noactive')."</span>";
                $value->koordinat   = "<a target='_blank' href='http://maps.google.com/?ll=".$value->koordinat."'>".__('all.open_maps')." <i class='fa fa-map-marker-alt'></i></a>";
                $row[]              = $value;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = 'empty';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function chart(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'mitra/admin/list-mitra-chart';
        $city       = isset($request->kota) ? $request->kota : 'bandung';
        $prov       = isset($request->provinsi) ? $request->provinsi : 'Jawa barat';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "start"         => date('Y-m-d', strtotime($request->start)),
                    "end"           => date('Y-m-d', strtotime($request->end)),
                    "limit"         => 100000000,
                    "pageNumber"    => 0,
                    "provinsi"      => $prov,
                    "kota"          => $city,
                    "kategori"      => $request->kategori,
                    "tipe"          => $request->tipe
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $value->cdate   = date('d F Y', strtotime($value->cdate));
                $row[]          = $value;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = 'empty';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }
    
    public function getCoordinate(Request $request)
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
                $rows  = "<a class='dropdown-item' name='".$value->province."' id=".$value->provinceId." onclick='selectCity(this)'>".$value->province."</a>";
                $row[]  = $rows;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function coordinateCity(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/city';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "provinceId"    => $request->filter,
                "query"         => ""
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
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function coordinateDistrict(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/subdistrict';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "cityId"    => $request->filter,
                "query"     => ""
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
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
        }
    }

    public function getLatLong(Request $request)
    {
        $address    = str_replace(' ', '', $request->address);
        // Get lattitude & longitude ---
        $apiKey     = 'AIzaSyC7Ah8Zuhy2ECqqjBNF8ri2xJ7mwwtIbwo'; // Google maps now requires an API key.
        $results    = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . $apiKey);
        $json       = json_decode($results, true);

        $latitude   = $json['results'][0]['geometry']['location']['lat']; // Latitude
        $longitude  = $json['results'][0]['geometry']['location']['lng']; // Longitude

        return json_encode(array('code' => 0, 'info' => true, 'data' => array('lat' => $latitude, 'long' => $longitude)));
    }
    
}
