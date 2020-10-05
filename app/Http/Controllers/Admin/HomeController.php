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
        if (empty(Session::get('admin_key'))) {
            return redirect('/login');
        }
    }

    public function index()
    {
        return view('admin.master');
    }
}
