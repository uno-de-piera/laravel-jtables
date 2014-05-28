<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('jtable');
});

Route::post("getData/{action}", function($action)
{
	switch ($action) 
	{
		case 'list':
			$rows = DB::table('people')->count();
			if(Input::get("jtSorting"))
			{
				$search = explode(" ", Input::get("jtSorting"));
				$data = DB::table("people")
				->skip(Input::get("jtStartIndex"))
				->take(Input::get("jtPageSize"))
				->orderBy($search[0], $search[1])
				->get();
			}
			else
			{
				$data = DB::table("people")
				->skip(Input::get("jtStartIndex"))
				->take(Input::get("jtPageSize"))
				->get();
			}
			return Response::json(
				array(
					"Result"			=>		"OK",
					"TotalRecordCount"	=>		$rows,
					"Records"			=>		$data
				)
			);
			break;
		case 'create':
			$peopleData = array(
				"Name"			=>		Input::get("Name"),
				"Age"			=>		Input::get("Age")
			);
			$people = new People($peopleData);
			if($people->save())
			{
				$person = People::find($people->id);
				$toView = array(
					"0"				=>		$people->id,
					"id"			=>		$people->id,
					"1"				=>		$person->Name,
					"Name"			=>		$person->Name,
					"2"				=>		$person->Age,
					"Age"			=>		$person->Age,
					"3"				=>		$person->RecordDate,
					"RecordDate"	=>		$person->RecordDate
				);

				return Response::json(array(
						"Result"			=>		"OK",
						"Record"			=>		$toView
					)
				);
			}
			break;
		case 'update':
			$person = People::find(Input::get("id"));
			$person->Name = Input::get("Name");
			$person->Age = Input::get("Age");
			if($person->save())
			{
				return Response::json(array(
						"Result"			=>		"OK",
					)
				);
			}
			break;
		case 'delete':
			$person = People::find(Input::get("id"));
			if($person->delete())
			{
				return Response::json(array(
						"Result"			=>		"OK",
					)
				);
			}
			break;
	}
});	