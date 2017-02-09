<?php
	class Api extends Config
	{
		public $table;

		public function __construct()
		{
			parent::__construct();
		}

		public function getProducts( $params = array() )
		{

			$this->processParams();

			$sql = "SELECT pid, image_url, link, name, saleprice, price FROM $this->table limit $this->start, $this->limit";
			
			return array( 
							"total"=> $this->getTotalRows( $this->table ),
							"page" => (int)$this->page,
							"data" => $this->getAllRows( $sql ),
						);
		}

		public function productDetail( $params = array() )
		{
			$pid = @$_REQUEST['pid'];

			if( empty( $pid ) )
			{
				$this->throwError( "Error: Product ID Missing..!" );
			}

			$this->processParams();

			$sql = "SELECT * FROM $this->table WHERE pid = $pid";

			if(  $this->totalRows( $sql ) == 0 )
			{
				$this->throwError( "Error: Invalid Product ID.. !!" );
			}
			
			return array( 
							"total"=> 1,
							"page" => 1,
							"data" => $this->getRowObj( $sql ),
						);
		}

		public function processParams()
		{
			extract( $_REQUEST );

			if( !isset( $page ) || empty( $page ) )
			{
				$this->page = 1;
			}
			else
			{
				$this->page = $page;
			}

			if( !isset( $limit ) || empty( $limit ) )
			{
				$this->limit = 20;
			}
			else
			{
				$this->limit = $limit;
			}

			$this->start = ( $this->page - 1 ) * $this->limit;
		}

		public function processRequest( $method, $params = array() )
		{
			if( $this->tokenVerified() )
			{
				if( method_exists( $this, $method ) )
				{
					return $this->{$method}( $params );
				}
				else
				{
					$this->throwError( "Error: Method Not Found.. !!" );
				}
			}
			else
			{
				header( 'HTTP/1.1 401 Unauthorized', true, 401 );
				$this->throwError( "Error: Un-Authorised Access... !!" );
			}
		}

		public function throwError( $msg )
		{
			$output['status'] 	= "error";
			$output['key_code'] = 404;
			$output['message'] 	= $msg;
			$output['data'] 	= array();

			header('Content-Type: application/json; charset=utf-8');

			echo json_encode( $output );exit;
		}

		public function outputJSON( $response )
		{
			$output['status'] 	= "success";
			$output['key_code'] = 200;
			$output['total'] 	= $response['total'];
			$output['page'] 	= $response['page'];
			$output['data'] 	= $response['data'];

			header('Content-Type: application/json; charset=utf-8');
			echo json_encode( $output );exit;
		}

		public function tokenVerified()
		{
			$token = input('token');

			if( isset( $token ) && !empty( $token ) )
			{
				if( $token == parent::$token )
					return true;
				else
					return false;
			}
			else
			{
				return false;
			}
		}
	}
?>