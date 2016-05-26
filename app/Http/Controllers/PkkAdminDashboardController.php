<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PkkAdminDashboardController extends Controller
{
    /**
     * Display PKK administrator dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'pages.pkk.admin.dashboard.index' );
    }
}
