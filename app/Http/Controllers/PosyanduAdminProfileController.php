<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;

use Auth;

class PosyanduAdminProfileController extends ProfileController
{
    /**
     * Display PKK administrator profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['user'] = Auth::user();

        return view( 'pages.posyandu.admin.profile.index', compact( 'data' ) );
    }
}
