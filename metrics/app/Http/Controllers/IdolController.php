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
        $max_results = (Input::has('max_results')) ? Input::get('max_results') : 20;
        $idol = $this->idol;

        try {
            if (Input::has('min_date') || Input::has('max_date')) {
                $min_date = (Input::has('min_date')) ? Input::get('min_date') . 'e' : null;
                $max_date = (Input::has('max_date')) ? Input::get('max_date') . 'e' : null;
                $response = $idol->queryTextIndexByKeyword($keyword, $min_date, $max_date, $max_results);
            } else {
                $response = $idol->queryTextIndexWithTicker($keyword, $max_results);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500O);
        }

        return response()->json($response, 200);
    }


}
