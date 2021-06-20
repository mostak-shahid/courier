<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        $body_class = 'sidebar-mini';
        $wrapper_class = 'wrapper';
        return view('admin.index', compact('body_class', 'wrapper_class'));
    }
    public function merchant()
    {
        $body_class = 'sidebar-mini';
        $wrapper_class = 'wrapper';
        return view('merchant.index', compact('body_class', 'wrapper_class'));
    }
    public function driver()
    {
        $body_class = 'sidebar-mini';
        $wrapper_class = 'wrapper';
        return view('driver.index', compact('body_class', 'wrapper_class'));
    }
}
