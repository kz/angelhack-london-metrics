<?php

namespace Metrics\Http\Controllers;

use Illuminate\Http\Request;

use Metrics\Http\Requests;
use Metrics\Http\Controllers\Controller;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->view('app');
    }
}
