<?php

namespace App\Http\Controllers\User;

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
        return view('user.home');
    }

    public function home(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'user/home-mitra';
        $request    = $client->get($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function balance(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'saldo';
        $request    = $client->get($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function comition(Request $request)
    {
        $client     = new Client();
        $year       = isset($request->year) && !empty($request->year) ? $request->year : '2020';
        $url        = $this->base_url . 'user/komisi-mitra';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'payload'   => [
                    'tahun' => $year
                ]
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            $rows   = [];
            foreach ($result as $key) {
                $key->periode   = date('F Y', strtotime($key->periode));
                $rows[]         = $key;
            } 

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $rows));
        } else {
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function profile(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'user/profile';
        $request    = $client->get($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function editProfile(Request $request)
    {
        $client     = new Client();

        // name
        $urlName    = $this->base_url . 'user/profile/edit-name';
        $reqName    = $client->post($urlName, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'payload'   => [
                    'id'    => $request->id,
                    'name'  => $request->name
                ]
            ]
        ]);

        $resName    = $reqName->getBody()->getContents();
        $sName      = json_decode((string) $resName, true)['status']['statusCode'];
        $dName      = json_decode((string) $resName, true)['status']['statusDesc'];
        
        // gender
        $urlGender  = $this->base_url . 'user/profile/edit-gender';
        $reqGender  = $client->post($urlGender, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'payload'   => [
                    'id'        => $request->id,
                    'gender'    => $request->gender
                ]
            ]
        ]);

        $resGender  = $reqGender->getBody()->getContents();
        $sGender    = json_decode((string) $resGender, true)['status']['statusCode'];
        $dGender    = json_decode((string) $resGender, true)['status']['statusDesc'];
                    
        // birthday
        $urlDay     = $this->base_url . 'user/profile/edit-birthday';
        $reqDay    = $client->post($urlDay, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'id'        => $request->id,
                'birthday'  => date('Y-m-d', strtotime($request->birthday))
            ]
        ]);

        $resDay     = $reqDay->getBody()->getContents();
        $sDay       = json_decode((string) $resDay, true)['status']['statusCode'];
        $dDay       = json_decode((string) $resDay, true)['status']['statusDesc'];
        
        // name
        $urlImg    = $this->base_url . 'user/profile/edit-picture';
        $reqImg    = $client->post($urlImg, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'payload'   => $request->img_upload
            ]
        ]);

        $resImg     = $reqImg->getBody()->getContents();
        $sImg       = json_decode((string) $resImg, true)['status']['statusCode'];
        $dImg       = json_decode((string) $resImg, true)['status']['statusDesc'];

        if ($sName == '000' AND $sGender == '000' AND $sDay == '000' AND $sImg == '000') {
            echo json_encode(array('code' => 0, 'info' => $dName, 'data' => null));
        } else {
            if ($sName != '000') {  $decs   = $dName;}
            if ($sGender != '000') {  $decs   = $dGender;}
            if ($sDay != '000') {  $decs   = $dDay;}
            if ($sImg != '000') {  $decs   = $dImg;}

            echo json_encode(array('code' => 1, 'info' => $decs, 'data' => null));
        }
    }

    public function listBank(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'user/list-bank';
        $request    = $client->get($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function notification(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'user/notifikasi-mitra';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'payload'   => [
                    'pageNumber'    => $request->page,
                    'limit'         => $request->limit
                ]
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            $no     = 0;
            foreach ($result as $key => $value) {
                $no             += $key + 1;
                $value->dtm     = date('d F Y', strtotime($value->dtm));
                $row[]          = $value;
            }
            
            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => array('data' => $row, 'no' => $no)));
        } else {
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function getCoordinate(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/province';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
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
                $rows  = "<a class='dropdown-item' name='".$value->province."' id=".$value->provinceId." onclick='selectProv(this)'>".$value->province."</a>";
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
                'Authorization' => Session::get('user_key')
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
                $rows  = "<a class='dropdown-item' name='".$value->city."' id=".$value->id." onclick='selectCity(this)'>".$value->city."</a>";
                $row[]  = $rows;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function coordinateDistrict(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/subdistrict';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
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
                $rows  = "<a class='dropdown-item' name='".$value->subdistrictName."' id=".$value->id." onclick='getLoc(this)'>".$value->subdistrictName."</a>";
                $row[]  = $rows;
            }

            echo json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            echo json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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
