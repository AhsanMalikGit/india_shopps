<?php
	require('../config.php');
	
	$api = new Api();

	$api->table = "gc_stage_bigbasket";

	extract( $_REQUEST );

	if( isset( $method ) && !empty( $method ) )
	{
		$products = $api->processRequest( $method, @$params );

		$api->outputJSON( $products );
	}
	else
	{
		$api->throwError( "Error: No METHOD specified. !!" );
	}

?>