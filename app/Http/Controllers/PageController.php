<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view("admin.pages.index");
    }
    public function home()
    {
        return view("client.pages.index");
    }
}