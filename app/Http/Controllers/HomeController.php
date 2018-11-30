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
            $getAPI = file_get_contents(url('/').'/api/v1/p/endpoint?page=1&location='.$request->location.'&sort='.$sort);
        } else {
            $getAPI = file_get_contents(url('/').'/api/v1/p/endpoint?page=1&sort='.$sort);
        }

        $decodeAPI = json_decode($getAPI);

        if($decodeAPI->meta->code == "200"){

            foreach($decodeAPI->data as $data){

                echo "<div style='margin-bottom:20px; display:block;'> <div><strong>".$data->location->name."</strong></div>";

                echo "<div>";

                if($data->locations != null && $data->locations->data != null){

                    foreach($data->locations->data as $attraction){

                        echo "<li>".$attraction->name."</li>";
                    }

                } else {
                    echo "no locations";
                }

                echo "</div></div>";

            }
        } else {
            echo "No content";
        }
    }

}
