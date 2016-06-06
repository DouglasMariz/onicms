<?php

namespace Onicms\Http\Controllers\Admin;

use Onicms\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/home');
    }
}
