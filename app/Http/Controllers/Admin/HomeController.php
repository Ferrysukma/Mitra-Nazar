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
        $request    = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "start"         => $result->start,
                    "limit"         => $request->limit,
                    "pageNumber"    => $request->page,
                    "provinsi"      => $request->provinsi,
                    "kota"          => $request->kota,
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
                $status = $value->active == '1' ? '<span class="badge badge-success">'.__('all.active')."</span>" : '<span class="badge badge-danger">'.__('all.noactive')."</span>";
                $no = $key + 1;
                $rows   =   "<tr>
                                <td align='center'>".$no."</td>
                                <td style='display:none'>".$value->id."</td>
                                <td>".$value->nama."</td>
                                <td>".$value->email."</td>
                                <td>".$value->phone."</td>
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
    
    public function getCoordinate(Request $request)
    {
        $client     = new Client();
        $url        = $this->base_url . 'find/district';
        $request    = $client->get($url, ['query' => ['page' => 0, 'query' => $request->filter]]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
            
            $row    = [];
            foreach ($result as $key => $value) {
                $rows  = "<a class='dropdown-item select' provinsi='".$value->province."' city='".$value->city."' type='".$value->type."' district='".$value->subdistrictName."' id=".$value->id."'>".$value->subdistrictName.", ".$value->type.", ".$value->city.", ".$value->province."</a>";
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
