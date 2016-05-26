<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PosyanduDashboardController extends Controller
{
    /**
     * Display PKK Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      	return view( 'pages.posyandu.dashboard.index');
    }
}
