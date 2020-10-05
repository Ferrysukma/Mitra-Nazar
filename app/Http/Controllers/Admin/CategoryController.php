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
        if (empty(Session::get('admin_key'))) {
            return redirect('/login_admin');
        }
    }

    public function index()
    {   
        return view('admin.category_list');
    }

    public function loadlist(Request $request)
    {
        $client     = new Client();

        $url        = $this->base_url . 'mitra/admin/kategori/list';
        
        $request    = $client->post($url, [
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
                                <td style='display:none'>".$value->id."</td>
                                <td>".date('d F Y H:i:s', strtotime($value->cdate))."</td>
                                <td>".$value->name."</td>
                                <td>".$value->cby."</td>
                                <td align='center'>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-warning action-edit'  
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

    public function create(Request $request)
    {
        $client     = new Client();

        if (isset($request->id) && !empty($request->id)) {
            $url        = $this->base_url . 'mitra/admin/kategori/edit';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "id"            => $request->id,
                        "name"          => $request->name,
                    ]
                ]
            ]);
        } else {
            $url        = $this->base_url . 'mitra/admin/kategori/create';
            $request    = $client->post($url, [
                'headers'   => [
                    'Authorization' => Session::get('admin_key')
                ],
                'json'      => [
                    "payload"   => [
                        "name"         => $request->name,
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

    public function sub_category($id)
    {
        $client = new Client();

        $url = $this->base_url . 'admin/category/get';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 100,
                    "pageNumber"    => 0,
                    "id"            => $id
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        $url_kategori       = $this->base_url . 'admin/main-category/get';
        $request_kategori   = $client->post($url_kategori, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 100,
                    "pageNumber"    => 0
                ]
            ]
        ]);
        $response_kategori   = $request_kategori->getBody()->getContents();
        $data_kategori       = json_decode((string) $response_kategori, true)['payload'];
        
        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
        } else {
            $result = 'empty';
        }

        return view('admin.masterData.subCategory', ['data' => $result, 'id' => $id, 'data_kategori' => $data_kategori]);
    }

    public function activated_sub_category(Request $request)
    {
        $client = new Client();

        $url = $this->base_url . 'admin/category/activate';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "id"         => $request->id,
                    "active"     => $request->active
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function delete_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/category/delete';
        $request = $client->post($url, [
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
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function add_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/category/add';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "name"         => $request->name,
                    "parentId"     => $request->id
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function update_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/category/edit';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "name"         => $request->name,
                    "id"           => $request->id
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function change_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/category/ubah-kategori';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "parentId"     => $request->kategori,
                    "id"           => $request->idSubkategori
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function sub_sub_category($parentId, $id)
    {
        $client = new Client();

        $url = $this->base_url . 'admin/sub-category/get';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 100,
                    "pageNumber"    => 0,
                    "id"            => $id
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        $url_kategori       = $this->base_url . 'admin/category/get';
        $request_kategori   = $client->post($url_kategori, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "limit"         => 100,
                    "pageNumber"    => 0,
                    "id"            => $parentId,
                ]
            ]
        ]);
        $response_kategori   = $request_kategori->getBody()->getContents();
        $data_kategori       = json_decode((string) $response_kategori, true)['payload'];
        
        if ($status == '000') {
            $result = json_decode((string) $response)->payload;
        } else {
            $result = 'empty';
        }

        return view('admin.masterData.subSubCategory', ['data' => $result, 'id' => $id, 'parentId' =>$parentId, 'data_kategori' => $data_kategori]);
    }

    public function add_sub_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/sub-category/add';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "name"         => $request->name,
                    "categoryId"   => $request->id
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function update_sub_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/sub-category/edit';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "name"         => $request->name,
                    "id"           => $request->id
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function change_sub_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/sub-category/ubah-kategori';
        $request = $client->post($url, [
            'headers'   => [
                'Authorization' => Session::get('admin_key')
            ],
            'json'      => [
                "payload"   => [
                    "categoryId"   => $request->kategori,
                    "id"           => $request->idSubkategori
                ]
            ]
        ]);
        $response   = $request->getBody()->getContents();
        $status     = json_decode((string) $response, true)['status']['statusCode'];

        if ($status == '000') {
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }

    public function delete_sub_sub_category(Request $request)
    {
        $client = new Client();
        $url = $this->base_url . 'admin/sub-category/delete';
        $request = $client->post($url, [
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
            $result = 'success';
        } else {
            $result = 'empty';
        }

        return json_encode($result);
    }
}
