<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Locations;

class LocationController extends Controller
{


	public function index()
	{

		$view = view('location.list');

		$view->locationList = Locations::all();

		return $view;

	}

	public function attraction($locationID)
	{

		$view = view('location.attractions');

		$view->attractionList = Locations::where("id",$locationID)->first()->attractions;

		return $view;

	}


	public function refreshCache()
	{

		Cache::flush();

		return redirect()->back()->with("refresh",1);

	}


	public function toggle(Request $request)
	{

		$getID = $request->input('getID');
		$checked = $request->input('checked');
		$model = "App\\".$request->input('model');

		$edit = $model::find($getID);

		$edit->active = $checked;

		$edit->save();

		echo "success";

	}

	public function delete(Request $request)
	{

		$deleteID = $request->input('deleteID');
		$model = "App\\".$request->input('model');

		$id = $model::find( $deleteID );

		$id->delete();

		echo "refresh";

	}

}
