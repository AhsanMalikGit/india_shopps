<?php namespace indiashopps\Http\Controllers;

use indiashopps\Http\Controllers\Controller;

class ValentineController extends Controller {

	/**
	* Shoes listing Under given Min & Max Price	
	*/
	public function index()
	{
		return view("v1.valentine.index");
	}
	public function day($day="rose")
	{
		$data["title"] = "$day day";
		$data["h1"] = "$day day";
		$data["day"] = $day;
		return view("v1.valentine.day_products",$data);
	}

}
