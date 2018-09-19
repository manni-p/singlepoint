<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Locations;

class ApiController extends Controller
{


	public function index(Request $request)
	{


		if (Cache::has('cache_api')) {

			$list_create = Cache::get('cache_api');

		} else {

			$get_locations = Locations::where("active",1)->get();


			if($get_locations->count() == 0){

				$list_create = (object) [
					'meta' => (object) [
						'code' => 204
						,'status' => 'no content'
					]
				];

				return response()->json($list_create)
				->setStatusCode(204);

			}

			foreach($get_locations as $location){

				$list_create[] = (object) [

					'meta' => (object) [
						'code' => 200
						,'status' => 'success'
					],

					'data' => (object) [

						'location' => (object) [
							'name' => $location->name
							,'slug' => 'slug'
							,'name' => 'name'
							,'display_name' => 'display'
							,'more_link' => 'more'
							,'latitude' => 'lat'
							,'longitude' => 'long'
						],

						'locations' => $location->attractions->where("active",1)->toArray()

					]

				];

			}

    		Cache::put('cache_api', $list_create, 60); // 1 hour

    	}

    	return response()->json($list_create)
    	->setStatusCode(200);

    }


}
