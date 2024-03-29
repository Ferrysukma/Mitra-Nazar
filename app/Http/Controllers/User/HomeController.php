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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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
                $rows[]         = $key->periode;
            } 
            
            $arr = [];

            for ($i=1; $i <= 12; $i++) { 
                $i      = strlen($i) > 1 ? $i : '0'.$i;
                $false  = count(array_keys($rows, $year.'-'.$i));
                if (!$false) {
                    $arr[]      = (object) ['amount' => 0, 'periode' => date('M', strtotime($year.'-'.$i))];
                }
            }

            foreach ($result as $data) {
                $data->periode  = date('M', strtotime($data->periode));
                $arr[]          = $data;
            } 

            usort($arr, function($a1, $a2) {
                $v1 = strtotime($a1->periode);
                $v2 = strtotime($a2->periode);
                return $v1 - $v2; // $v2 - $v1 to reverse direction
            });

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $arr));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function takeBalance(Request $request)
    {
        $client     = new Client();
        $bank       = explode('~', $request->kodeBank);
        $nominal    = str_replace('.', '', str_replace(',00', '', $request->nominal));
        $url        = $this->base_url . 'withdraw/balance';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                "kodeBank"          => $bank[0],
                "namaBank"          => $bank[1],
                "nomorRekening"     => $request->nomorRekening,
                "pemilikRekening"   => $request->pemilikRekening,
                "nominal"           => $nominal,
                "password"          => $request->password
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
        $url = $this->base_url . 'user/changepassword';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
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
                'id'        => $request->kode,
                'birthday'  => date('Y-m-d', strtotime($request->birthday))
            ]
        ]);

        $resDay     = $reqDay->getBody()->getContents();
        $sDay       = json_decode((string) $resDay, true)['status']['statusCode'];
        $dDay       = json_decode((string) $resDay, true)['status']['statusDesc'];
        
        // upload image
        if ($request->img_upload != 'undefined') {
            $file       = $request->file('img_upload');
            $fileName   = $file->getClientOriginalName();
            $realPath   = $file->getRealPath();
    
            $urlUimg    = $this->base_url . 'image/upload-profile-user';
            $reqUimg    = $client->post($urlUimg, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => Session::get('user_key')
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => file_get_contents($realPath),
                        'filename' => $fileName
                    ]
                ]
            ]);
    
            $resUimg    = $reqUimg->getBody()->getContents();
            $data       = json_decode($resUimg);
    
            if ($data->status->statusCode == '000') {
                // edit image
                $urlImg    = $this->base_url . 'user/profile/edit-picture';
                $reqImg    = $client->post($urlImg, [
                    'headers'   => [
                        'Authorization' => Session::get('user_key')
                    ],
                    'json'      => [
                        'payload'   => $data->payload
                    ]
                ]);
    
                $resImg     = $reqImg->getBody()->getContents();
                $sImg       = json_decode((string) $resImg, true)['status']['statusCode'];
                $dImg       = json_decode((string) $resImg, true)['status']['statusDesc'];
            } else {
                $sImg       = '001';
                $dImg       = 'Upload Fail';
            }
        } else {
            $sImg       = '000';
            $dImg       = 'Success';
        }

        if ($sName == '000' AND $sGender == '000' AND $sDay == '000' AND $sImg == '000') {
            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            if ($sName != '000') {  $decs   = $dName;}
            if ($sGender != '000') {  $decs   = $dGender;}
            if ($sDay != '000') {  $decs   = $dDay;}
            if ($sImg != '000') {  $decs   = $dImg;}

            return json_encode(array('code' => 1, 'info' => $decs, 'data' => null));
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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $result));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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
            foreach ($result as $key => $value) {
                if ($value->isRead == false) {
                    $value->dtm     = date('d F Y H:i:s', strtotime($value->dtm));
                    $row[]          = $value;
                }
            }

            // get count unread notif
            $url_read   = $this->base_url . 'user/total-notifikasi';
            $req_read   = $client->get($url_read, [
                'headers'   => [
                    'Authorization' => Session::get('user_key')
                ],
            ]);

            $res_read   = $req_read->getBody()->getContents();
            $status_read= json_decode((string) $res_read, true)['status']['statusCode'];

            $no         = 0;
            if ($status_read == '000') {
                $no = json_decode((string) $res_read)->payload;
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => array('data' => $row, 'no' => $no)));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function allNotif(Request $request)
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
            foreach ($result as $key => $value) {
                $value->dtm     = date('d F Y H:i:s', strtotime($value->dtm));
                $row[]          = $value;
            }

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => array('data' => $row)));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
        }
    }

    public function readNotif(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'user/read-notifikasi';
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('user_key')
            ],
            'json'      => [
                'payload'   => [
                    "id" => $request->id
                ]
            ]
        ]);

        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => null));
        } else {
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => null));
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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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
                "query"         => $_POST['query'],
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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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
                "query"     => $_POST['query']
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

            return json_encode(array('code' => 0, 'info' => 'true', 'data' => $row));
        } else {
            $result = '<a class="text-center text-gray">'.__('all.datatable.no_data').'</a>';
            
            return json_encode(array('code' => 1, 'info' => 'false', 'data' => $result));
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
