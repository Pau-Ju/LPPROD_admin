<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;


class SearchController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = explode(" ", $request->get('s'));

        $in = "";
        for($i =0; $i < count($query) ;$i++){
            $in = $in ."'". $query[$i] ."'". ',';
        }
        $in = substr($in,0, -1);



        $series = Serie::getSearchResults($in);



        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 12;
        $path=LengthAwarePaginator::resolveCurrentPath();
        $series= new LengthAwarePaginator(array_slice($series, $perPage * ($currentPage - 1), $perPage), count($series), $perPage, $currentPage,
            ['path'=>$path, 'query'=> $request->query()
            ]);


        return view('results', compact('series'));
    }
}