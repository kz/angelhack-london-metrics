<?php

namespace Metrics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Metrics\Http\Requests;
use Metrics\Http\Controllers\Controller;
use Metrics\Idol\Idol;

class IdolController extends Controller
{

    private $idol;

    public function __construct(Idol $idol)
    {
        $this->idol = $idol;
    }

    public function analyseKeyword(){
        $keyword = Input::get('keyword');
        $min_date = (Input::has('min_date')) ? Input::get('min_date') . 'e' : null;
        $max_date = (Input::has('max_date')) ? Input::get('max_date') . 'e' : null;
        $max_results = (Input::has('max_results')) ? Input::get('max_results') : 20;
        $idol = $this->idol;
        $response = $idol->queryTextIndexByKeyword($keyword, $min_date, $max_date, $max_results);


        return $response;
    }

}
