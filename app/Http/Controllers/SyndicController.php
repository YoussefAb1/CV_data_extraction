<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Syndic;


class SyndicController extends Controller
{
    public function SyndicDashboard(){
    return view('syndic.syndic_dashboard');
}
}

?>
