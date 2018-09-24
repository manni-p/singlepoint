<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

use App\ApiList;
use App\Locations;
use App\Attractions;
use Carbon\Carbon;
use Auth;

class FeedController extends Controller
{


	public function index()
	{

		$view = view('feed.feed');

		$view->apifeed = ApiList::all();

		return $view;

	}

	public function import()
	{

	 /**
     * Build the location and attractions list..
     */

	 $apiFeed = ApiList::all();

	 $countLocations = 0;
	 $countAttractions = 0;

	 foreach($apiFeed as $feed):

	 	$getFeed = @file_get_contents($feed->feed_url);

	 	if($getFeed !== false AND !empty($getFeed)) {
	 		$decode = json_decode($getFeed);
	 	} else {
	 		continue;
	 	}

	 	if(isset($decode->data) && $decode->meta->code == 200){

	 		$checkLocationExist = Locations::where("name",$feed->name);

	 		if(!$checkLocationExist->exists()){

	 			$countLocations++;
	 			$createLocation = new Locations;
	 			$createLocation->name = filter_var($feed->name, FILTER_SANITIZE_STRING);
	 			$createLocation->latitude = filter_var($decode->data->location->latitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	 			$createLocation->longitude = filter_var($decode->data->location->longitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	 			$createLocation->slug = filter_var(str_slug($feed->name, "-"), FILTER_SANITIZE_URL);
	 			$createLocation->more_link = filter_var($decode->data->location->more_link, FILTER_SANITIZE_URL);
	 			$createLocation->display_name = filter_var($decode->data->location->display_name, FILTER_SANITIZE_STRING);

	 			$createLocation->save();

	 			$locationID = $createLocation->id;

	 		} else {
	 			$locationID = $checkLocationExist->first()->id;
	 		}

	 		if(isset($decode->data->locations)){

	 			foreach($decode->data->locations as $location):

	 				$attractionName = filter_var($location->name, FILTER_SANITIZE_STRING);
	 				$attractionCategory = (isset($location->category)) ? filter_var($location->category, FILTER_SANITIZE_STRING) : null;

	 				$attraction = Attractions::where("name",$attractionName)->where("location_id",$locationID)->where("category",$attractionCategory)->exists();

	 				if(!$attraction){

	 					$countAttractions++;

	 					$createAttraction = new Attractions;

	 					$createAttraction->name = filter_var($location->name, FILTER_SANITIZE_STRING);

	 					$createAttraction->location_id = $locationID;

	 					if(isset($location->address)){
	 						$createAttraction->address = filter_var($location->address, FILTER_SANITIZE_STRING);
	 					}

	 					if(isset($location->category)){
	 						$createAttraction->category = filter_var($location->category, FILTER_SANITIZE_STRING);
	 					}

	 					if(isset($location->link)){
	 						$createAttraction->link = filter_var($location->link, FILTER_SANITIZE_URL);
	 					}

	 					if(isset($location->longitude)){
	 						$createAttraction->longitude = filter_var($location->longitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	 					}

	 					if(isset($location->latitude)){
	 						$createAttraction->latitude = filter_var($location->latitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	 					}

	 					if(isset($location->rating)){
	 						$createAttraction->rating = filter_var($location->rating, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	 					}

	 					if(isset($location->description)){
	 						$desc = strip_tags($location->description, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot>');
	 						$createAttraction->description = filter_var($desc, FILTER_SANITIZE_STRING);
	 					}

	 					if(isset($location->image)){
	 						$createAttraction->image = filter_var($location->image, FILTER_SANITIZE_URL);
	 					} elseif(isset($location->image_large)){
	 						$createAttraction->image = filter_var($location->image_large, FILTER_SANITIZE_URL);
	 					}

	 					$createAttraction->save();

	 				}

	 			endforeach;

	 		}

	 	}

	 endforeach;


	 return redirect()->back()->with("attraction_count",$countAttractions)->with("location_count",$countLocations);


	}


}
