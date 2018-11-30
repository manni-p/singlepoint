<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Locations;

class ApiController extends Controller
{


	public function index(Request $request)
	{

		/* Check if API has been cached and cache only if the url query has been cached before */
		$url = request()->url();
		$queryParams = request()->query();

		ksort($queryParams);

		$queryString = http_build_query($queryParams);

		$fullUrl = "{$url}?{$queryString}";

		$rememberKey = sha1($fullUrl);

		if(Cache::has($rememberKey)){
			return response()->json( Cache::get($rememberKey));
		} else {

			/* Check if sort has been added for locations area, leave asc as default */
			$sort = (isset($request->sort) && $request->sort == "desc") ? 'desc' : 'asc';

			$get_locations = Locations::where("active",1);

			/* Check if specific location is being searched */
			if(isset($request->location)){
				$get_locations = $get_locations->where("slug",$request->location)->get();
			} else {
				$get_locations = $get_locations->get();
			}

			if($get_locations->count() == 0){

				$list_create = (object) [
					'meta' => (object) [
						'code' => 204
						,'status' => 'no content'
					]
				];

				// return response()->json((object) $list_create, 204);
				/// showing an example without the 204 status code
				return response()->json((object) $list_create);

			}

			foreach($get_locations as $location){

				/* Turn the relationship into an object */
				$attractions = ($location->attractions->where("active",1)->count() != 0) ? json_decode(json_encode($location->attractions()->where("active",1)->orderBy("name",$sort)->paginate(3)->toArray())) : NULL;

				/* create a meta that will return code 200 and status */
				$list_create['meta'] = (object) [
					'code' => 200
					,'status' => 'success'
				];

				$list_create['data'][] = (object) [

					'location' => (object) [
						'name' => $location->name
						,'slug' => $location->slug
						,'display_name' => $location->display_name
							// ,'more_link' => $location->more_link
						,'latitude' => $location->latitude
						,'longitude' => $location->longitude
					],

					'locations' => $attractions

				];

			}

			/* Create a cache that will last 1 hour */
			Cache::put($rememberKey, (object) $list_create, 60);

			return response()->json((object) $list_create);

		}

	}


}
