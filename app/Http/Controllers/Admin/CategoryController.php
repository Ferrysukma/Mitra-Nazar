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

    public function index()
    {   
        return view('admin.category_list');
    }

    public function loadlist(Request $request)
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
            
            $row    = [];
            foreach ($result as $key => $value) {
                $no = $key + 1;
                $rows   =   "<tr>
                                <td align='center'>".$no."</td>
                                <td>".date('d F Y H:i:s', strtotime($value->cdate))."</td>
                                <td>".$value->name."</td>
                                <td>".$value->cby."</td>
                                <td align='center'>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-warning' onclick='edit()' 
                                            title='".__('all.button.edit')."' data-toggle='tooltip' data-placement='top'>
                                            <i class='fa fa-edit'></i>
                                        </button>
                                        <button type='button' class='btn btn-sm btn-danger' onclick='delete()' 
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
}
