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

			if(isset($decode->data)){

				$checkLocationExist = Locations::where("name",$feed->name);

				if(!$checkLocationExist->exists()){

					$countLocations++;
					$createLocation = new Locations;
					$createLocation->name = $feed->name;
					$createLocation->latitude = $decode->data->location->latitude;
					$createLocation->longitude = $decode->data->location->longitude;
					$createLocation->slug = $decode->data->location->slug;
					$createLocation->more_link = $decode->data->location->more_link;
					$createLocation->display_name = $decode->data->location->display_name;

					$createLocation->save();

					$locationID = $createLocation->id;

				} else {
					$locationID = $checkLocationExist->first()->id;
				}

				if(isset($decode->data->locations)){

					foreach($decode->data->locations as $location):

						$attraction = Attractions::where("name",$location->name)->where("location_id",$locationID)->where("category",$location->category)->exists();

						if(!$attraction){

							$countAttractions++;

							$createAttraction = new Attractions;

							$createAttraction->name = $location->name;
							$createAttraction->location_id = $locationID;
							$createAttraction->address = $location->address;
							$createAttraction->category = $location->category;
							$createAttraction->link = $location->link;
							$createAttraction->longitude = $location->longitude;
							$createAttraction->latitude = $location->latitude;

							if(isset($location->image)){
								$createAttraction->image = $location->image;
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
