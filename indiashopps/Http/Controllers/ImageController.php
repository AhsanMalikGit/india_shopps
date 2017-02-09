<?php namespace indiashopps\Http\Controllers;

use DB;
use indiashopps\Http\Controllers\Controller;
use indiashopps\Helpers\helper;
use Illuminate\Http\Request;

class ImageController extends Controller 
{

	public function __construct()
	{

	}

	public function index()
	{
		$image[] = "http://ecx.images-amazon.com/images/I/51KnISjikYL._AA160_.jpg";
		$image[] = "http://ecx.images-amazon.com/images/I/51jeLxhqZTL._AA160_.jpg";
		$image[] = "http://ecx.images-amazon.com/images/I/51CuozF3R0L._AA160_.jpg";
		$image[] = "http://ecx.images-amazon.com/images/I/519S76yaHbL._AA160_.jpg";
		$image[] = "http://ecx.images-amazon.com/images/I/41Bw-soZzUL._AA160_.jpg";
		$image[] = "http://ecx.images-amazon.com/images/I/41c1npb9gSL._AA160_.jpg";

		$this->saveImages( $image );
	}

	protected function saveImages( $images )
	{
		$widths = array( 84, 150, 200, 250, 300 );
		$base  = base_path()."/images/v1/resize/";

		if( !empty( $images ) && is_array( $images ) )
		{
			foreach( $images as $image )
			{
				foreach( $widths as $width )
				{
					if( !file_exists( $base.$width ) )
					{
						mkdir( $base.$width, 0755 );
					}

					$file = basename( $image );
					$img = \Image::make( $image );

					$img->resizeCanvas( $width, $width );
					$img->resize( $width, null, function ($constraint) {
					    $constraint->aspectRatio();
					    $constraint->upsize();
					});

					$img->save( $base.$width."/".$file , 70 );
				}
			}
		}
	}

}