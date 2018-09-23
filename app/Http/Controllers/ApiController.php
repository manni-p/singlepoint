<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Locations;

class ApiController extends Controller
{


	public function index(Request $request)
	{

		/* Check if API has been cached */
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

				return response()->json((object) $list_create);

			}

			foreach($get_locations as $location){

				/* Turn the relationship into an object */
				$attractions = ($location->attractions->where("active",1)->count() != 0) ? json_decode(json_encode($location->attractions->where("active",1)->toArray())) : NULL;

				/* create a meta that will return code 200 and status */
				$list_create['meta'] = (object) [
					'code' => 200
					,'status' => 'success'
				];

				$list_create['data'][] = (object) [

					'location' => (object) [
						'name' => $location->name
							// ,'slug' => $location->slug
						,'display_name' => $location->display_name
							// ,'more_link' => $location->more_link
						,'latitude' => $location->latitude
						,'longitude' => $location->longitude
					],

					'locations' => $attractions

				];

			}

			/* Create a cache that will last 1 hour */

    		Cache::put('cache_api', $list_create, 60); // 1 hour

    	}

    	return response()->json((object) $list_create);

    }


}
