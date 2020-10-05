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

    public function index(Request $request)
    {
        $client = new Client();

        $url = $this->base_url . 'mitra/admin/kategori/list';
        
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 5,
                    "pageNumber"    => 0,
                ]
            ]
        ]);
        
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
        } else {
            $result = 'empty';
        }
        
        return view('admin.category_list', array('data' => $result));
    }
}
