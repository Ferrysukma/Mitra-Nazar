<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Guzzle
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->base_url = Controller::api();
    }

    public function index()
    {
        return view('admin.announcement_list');
    }

    public function loadList(Request $request)
    {
        $client     = new Client();

        if (isset($request->params) && !empty($request->params)) {
            if ($request->params == 1) {
                $url    = $this->base_url . 'mitra/admin/pengumuman/list-aktif';
            } else {
                $url    = $this->base_url . 'mitra/admin/pengumuman/list-history';
            }
        }

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
            $url        = $this->base_url . 'mitra/admin/pengumuman/edit';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "id"            => $request->id,
                        "judul"         => $request->judul,
                        "isi"           => $request->isi,
                        "tanggalMulai"  => date('Y-m-d', strtotime($request->start_date)),
                        "tanggalSelesai"=> date('Y-m-d', strtotime($request->end_date)),
                        "tujuan"        => $request->tujuan,
                        "kategori"      => $request->kategori
                    ]
                ]
            ]);
        } else {
            $url        = $this->base_url . 'mitra/admin/pengumuman/create';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "judul"         => $request->judul,
                        "isi"           => $request->isi,
                        "tanggalMulai"  => date('Y-m-d', strtotime($request->tanggalMulai)),
                        "tanggalSelesai"=> date('Y-m-d', strtotime($request->tanggalSelesai)),
                        "tujuan"        => $request->tujuan,
                        "kategori"      => $request->kategori
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
        $desc       = json_decode((string) $response, true)['status']['statusDesc'];

        if ($status == '000') {
            return json_encode(array('code' => 0, 'info' => $desc, 'data' => null));
        } else {
            return json_encode(array('code' => 1, 'info' => $desc, 'data' => null));
        }
    }
}
