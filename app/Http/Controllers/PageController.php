<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function uploadForm()
    {
        $categories = Category::all();
        return view("client.pages.upload",compact("categories"));
    }
    
}