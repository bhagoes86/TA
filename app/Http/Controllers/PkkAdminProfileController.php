<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;

use Auth;

class PkkAdminProfileController extends ProfileController
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

        return view( 'pages.pkk.admin.profile.index', compact( 'data' ) );
    }
}
