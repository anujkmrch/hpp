<?php

namespace Hpp\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        return "Hello";
    }
}