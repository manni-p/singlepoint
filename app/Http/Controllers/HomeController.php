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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function example(Request $request)
    {

        $sort = (isset($request->sort) && $request->sort == "desc") ? 'desc' : 'asc';

        if(isset($request->location)){
            $getAPI = file_get_contents(url('/').'/api/v1/p/endpoint?location='.$request->location.'&sort='.$sort);
        } else {
            $getAPI = file_get_contents(url('/').'/api/v1/p/endpoint?sort='.$sort);
        }

        $decodeAPI = json_decode($getAPI);

        foreach($decodeAPI->data as $data){

            echo "<div style='margin-bottom:20px; display:block;'> <div><strong>".$data->location->name."</strong></div>";

            echo "<div>";

            foreach($data->locations as $attraction){
                echo "<li>".$attraction->name."</li>";
            }

            echo "</div></div>";

        }
    }

}
