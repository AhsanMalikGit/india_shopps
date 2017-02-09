<?php 
function find_key_value($array, $val)
{
    foreach ($array as $item)
    {
       if (is_array($item))
       {
           find_key_value($item, $val);
       }

        if (isset($item) && $item == $val) return true;
    }

    return false;
}
function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', trim($string));
   $slug = strtolower($slug);
   $slug = str_replace("---","-",$slug);
   $slug = str_replace("--","-",$slug);
   //$slug = str_replace("3/4","3-4",$slug);
   return $slug;
}
function reverse_slug($string){
   $slug = str_replace('-', ' ', trim($string));
   $slug = str_replace("3 4","3/4",$slug);
   $slug = str_replace("3-4","3/4",$slug);
   $slug = strtolower($slug);
   return $slug;
}
function amp_desc($desc)
{
 	$desc = strip_tags($desc,'<table><tbody><tr><td><th>');

	$desc = str_replace("<table>", "", $desc);
	$desc = str_replace("</table>", "", $desc);
	$desc = str_replace("<tr>", "", $desc);
	$desc = str_replace("</tr>", "", $desc);
	
	$desc = str_replace("<th colspan='2'>", '<div class="headdingname">', $desc);
	$desc = str_replace('<th colspan="2">', '<div class="headdingname">', $desc);
	$desc = str_replace("</th>", '</div>', $desc);


	$desc = str_replace("<td class='key'>", '<li>', $desc);
	$desc = str_replace('<td class="key">', '<li>', $desc);
	$desc = str_replace("</td><td class='val'>", '<span>', $desc);
	$desc = str_replace('</td><td class="val">', '<span>', $desc);
	$desc = str_replace("</td>", '</span></li>', $desc);


	return $desc;
}function amp_desc_1($desc)
{
	$desc = str_replace('<table cellspacing="0" class="specTable">', "", $desc);
	$desc = str_replace("</table>", "", $desc);
	$desc = str_replace("<tr>", "", $desc);
	$desc = str_replace("</tr>", "", $desc);
	
	$desc = str_replace('<th colspan="2">', '<li class="boldtext">', $desc);
	$desc = str_replace("</th>", '</li>', $desc);

	$desc = str_replace('<td class="key">', '<li>', $desc);
	$desc = str_replace('</td> <td class="val">', '<span>', $desc);
	$desc = str_replace("</td>", '</span></li>', $desc);
	$desc = strip_tags($desc, '<li><span>');
	return $desc;
}
function unslug($string)
{
   	// $string = str_replace( "-", " ", $string );
	$string =preg_replace('/[-]+/', ' ', trim($string));
   	return ucwords( $string );
}

function clear_url( $url )
{
	if( config('app.seoEnable') )
	{
		$url = explode( config('app.seoURL') , $url );
		$url = $url[0];
	}

	return unslug( $url );
}

function getMiniSpec( $specs, $count = 5 ){

	$specs = explode(";", $specs );
	$return = ""; $i=1;

	foreach( $specs as $spec )
	{
		if( !empty( $spec ) )
		{
			$return .= '<li><i class="fa fa-circle btn-xs"></i> '.$spec.'</li>';
			// $return .= $spec.'<br/>';
		}

		if( $count == $i )
		{
			break;
		}
		else
		{
			$i++;
		}
	}

	return $return;
}

function composer_url( $param = "" )
{
	$com_url = config('app.composer_url');

	if( !empty( $com_url ) )
	{
		return trim($com_url).trim($param);
	}
	else
	{
		return "http://ext.indiashopps.com/composer/site/2.1/".trim($param);
	}
}

function isPricelist($cat)
{		
	$pricelist_cat = array(301,311,313,317,318,319,320,321,322,323,324,325,326,327,328,330,331,332,333,334,335,336,337,338,339,340,341,342,344,345,346,347,348,351,352,359,360,361,364,365,366,370,371,372,374,379,381,382,384,390,392,407,435,436,437,445,446,447,448,471,472,473,476,489,622,623,624,626,627,628,632,635,636,633,637,638,639,640);
	if(in_array($cat,$pricelist_cat))
		return true;

	return false;
}

function getCompCats()
{
	return array(301,311,313,317,318,319,320,321,322,323,324,325,326,327,328,330,331,332,333,334,335,336,337,338,339,340,341,342,344,345,346,347,348,351,352,359,360,361,364,365,366,370,371,372,374,379,381,382,384,390,392,407,435,436,437,445,446,447,448,471,472,473,476,489,622,623,624,626,627,628,632,635,636,633,637,638,639,640);
}

function seoUrl( $url )
{
	if( config('app.seoEnable') )
	{
		$url .= config('app.seoURL').".html";
	}

	return $url;
}

function getImage($img,$vendor,$size=false)
{
	switch($vendor)
		{
			case 0:
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}
			break;
			case 1:
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}
				if(strpos($img,',') || strpos($img,';'))
				{					
					if(strpos($img,','))
					{
						$img = explode(",",$img);
					}else if(strpos($img,';')){
						$img = explode(";",$img);
					}
					$img = $img[0];
				}
				$csize = explode("-",$img);
				$index = (sizeof($csize)-2);
				// dd($index);	
				$csize = @$csize[$index];
				if($size && $size!=$csize)
				{
					if(!strpos($img,$size) && strpos($img,$csize))
					{
						if($size == 'L')
							$img = str_replace($csize,'original',$img);
						if($size == 'M')
							$img = str_replace($csize,'400x400',$img);
						if($size == 'S')
							$img = str_replace($csize,'275x275',$img);
						if($size == 'XS')
							$img = str_replace($csize,'100x100',$img);
						if($size == 'XXS')
							$img = str_replace($csize,'75x75',$img);
						
					}
				}
				
				break;
		case 2:	
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}			
				$img = str_replace("catalog_xs","product2",$img);	
				if($size=='L')
				{
					$img = str_replace("_xxs.","_l.",$img);					
				}				
				break;
		case 3:		
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}
				if($size=='L')
				{
					$img = str_replace("._SL160_","",$img);
					$img = str_replace("._SL425_","",$img);
					$img = str_replace("._SS40_","",$img);
				}else if($size=='XS')
				{
					$img = str_replace("._SL160_","._SL75_",$img);
					$img = str_replace("._SL425_","._SL75_",$img);
					$img = str_replace("._SS40_","._SL75_",$img);
				}
				break;
		case 23:
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}
				if($size=='L')
				{					
					$img = str_replace("bigthumb/","zoom/",$img);
				}else if($size=='M')
				{
					$img = str_replace("bigthumb/","438x531/",$img);
				}				
				break;
			case 16:
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}
				if($size=='L')
				{
					$img = str_replace("166x194/","",$img);
				}//else{
					//$img = str_replace("166x194/","",$img);
				//}				
				break;
			case 21:	
				if($size=='L')
					$img = str_replace("-small","-large",$img);				
				break;
			case 22:
				if(!is_file_exists($img))
				{
					$img = str_replace("1_c","2_c",$img);
				}								
				break;
			case 35:	
				if($size=='L')
					$img = str_replace("210x","410x",$img);			
				else
				{
					if(json_decode($img) != NULL)
					{
						$img = json_decode($img);
						$img = $img[0];				
					}	
				}
				break;
			case 54:	
				if(json_decode($img) != NULL)
					{
						$img = json_decode($img);
						$img = $img[0];				
					}	
				if($size=='L')
					$img = str_replace("97Wx144H","1348Wx2000H",$img);	
				elseif($size=='M')
					$img = str_replace("97Wx144H","437Wx649H",$img);			
				
				break;
						
			default:			
				if(json_decode($img) != NULL)
				{
					$img = json_decode($img);
					$img = $img[0];														
				}
				break;
		}
	return $img;
}
function getImageNew($img,$size=false)
{
	if( empty($img) )
    {
    	return "http://www.indiashopps.com/images/v1/imgNoImg.png";
    }
	if(json_decode($img) != NULL)
	{
		$img = json_decode($img);
		$img = $img[0];														
	}
	if(is_array($img))
       $img = $img[0];
	$domain = getDomain($img);	
	if($domain && $size)
	{
	switch(strtolower($domain))
		{			
			case 'fkcdn':
			case 'flipkart':
			case 'flixcart':	
				if(strpos($img,',') || strpos($img,';'))
				{					
					if(strpos($img,','))
					{
						$img = explode(",",$img);
					}else if(strpos($img,';')){
						$img = explode(";",$img);
					}
					$img = $img[0];
				}

				if(strpos($img,'-'))
				{ 
					$csize = explode("-",$img);
					$csize = $csize[sizeof($csize)-2];					 
					if($size == 'L'){
						$img = str_replace($csize,'original',$img);
						$img = str_replace('128/128','832/832',$img);
					}
					elseif($size == 'M'){
						$img = str_replace($csize,'400x400',$img);
						$img = str_replace('128/128','400/400',$img);
					}
					elseif($size == 'S'){
						$img = str_replace($csize,'275x275',$img);
						$img = str_replace('128/128','400/400',$img);
					}
					elseif($size == 'XS'){ 
						$img = str_replace($csize,'100x100',$img);
					}
					elseif($size == 'XXS'){
						$img = str_replace($csize,'75x75',$img);	
					}
				}
				break;
			case 'jabong':				
			case 'jassets':				
				$img = str_replace("catalog_xs","product2",$img);	
				if($size=='L')
				{
					$img = str_replace("_xxs.","_l.",$img);					
				}				
				break;				
				break;
			case 'amazon':		
			case 'images-amazon':	
				//print_r($img);exit;
				if($size=='L')
				{
					$img = str_replace("._SL160_","",$img);
					$img = str_replace("._SX425_","",$img);
					$img = str_replace("._SX450_","",$img);
					$img = str_replace("._SS40_","",$img);
				}else if($size=='M')
				{
					$img = str_replace("._SL160_","._SX425_",$img);
					$img = str_replace("._SX450_","._SX425_",$img);
					$img = str_replace("._SS40_","._SX425_",$img);
				}else if($size=='S')
				{
					$img = str_replace("._SL75_","._SL160_",$img);
					$img = str_replace("._SX425_","._SL160_",$img);
					$img = str_replace("._SX450_","._SL160_",$img);
					$img = str_replace("._SL425_","._SL160_",$img);
					$img = str_replace("._SS40_","._SL160_",$img);
				}else if($size=='XS')
				{
					$img = str_replace("._SL160_","._SL110_",$img);
					$img = str_replace("._SX425_","._SL110_",$img);
					$img = str_replace("._SL425_","._SL110_",$img);
					$img = str_replace("._SS40_","._SL110_",$img);
					$img = str_replace("._SX450_","._SL110_",$img);
				}else if($size=='XXS')
				{
					$img = str_replace("._SL160_","._SL75_",$img);
					$img = str_replace("._SX425_","._SL75_",$img);
					$img = str_replace("._SL425_","._SL75_",$img);
					$img = str_replace("._SS40_","._SL75_",$img);
					$img = str_replace("._SX450_","._SL75_",$img);
				}
				break;
			case 'paytm':	
				//print_r($img);exit;
				if($size=='M')
				{
					$img = str_replace("0x1920","323x575",$img);					
				}else if($size=='S')
				{
					$img = str_replace("0x1920","0x275",$img);					
				}else if($size=='XS')
				{
					$img = str_replace("0x1920","0x90",$img);					
				}
				break;			
			case 'sdlcdn':
			case 'snapdeal':				
				if($size=='L')
				{
					$img = str_replace("166x194/","",$img);
				}				
				break;			
			case 'myntassets':				
				if($size=='L')
				{
					$img = str_replace("w_240","w_1080",$img);
					$img = str_replace("w_180","w_1080",$img);
					$img = str_replace("h_240","",$img);
				}else if($size=='M')
				{
					$img = str_replace("w_240","w_480",$img);
					$img = str_replace("w_180","w_480",$img);
					$img = str_replace("h_240","",$img);
				}else if($size=='XS')
				{
					$img = str_replace("w_240","w_100",$img);
				}					
				break;			
			case 'infibeam':				
				if($size=='L')
				{
					$img = str_replace("999x320x320","999x400x400",$img);					
				}else if($size=='M')
				{
					$img = str_replace("999x320x320","999x320x320",$img);					
				}else if($size=='S')
				{
					$img = str_replace("999x320x320","999x275x275",$img);
				}else if($size=='XS')
				{
					$img = str_replace("999x320x320","999x100x100",$img);
				}else if($size=='XXS')
				{
					$img = str_replace("999x320x320","999x75x75",$img);
				}					
				break;			
			case '91-img':				
			case 'indiatimes':				
				if($size=='L')
				{
					$img = str_replace("small","large",$img);					
				}else if($size=='M')
				{
					$img = str_replace("large","large",$img);					
				}else if($size=='S')
				{
					$img = str_replace("large","small",$img);
				}else if($size=='XS')
				{
					$img = str_replace("large","small",$img);
				}else if($size=='XXS')
				{
					$img = str_replace("large","small",$img);
				}					
				break;			
			case 'tatacliq':				
				if($size=='L')
				{
					$img = str_replace("97Wx144H","1348Wx2000H",$img);			
				}else if($size=='M')
				{
					$img = str_replace("97Wx144H","437Wx649H",$img);						
				}				
				break;			
				
			
		}
	}
	return $img;
}
function getDomain($url)
{
	
	$dom = parse_url($url);
	if(isset($dom['host']))
	{
		$domain = str_replace(".com","",$dom['host']);
		$domain = explode(".",$domain);
		return $domain[(count($domain)-1)];
	}
	return false;
	//print_r($domain[1]);
}
function is_file_exists($filePath)
{
      return is_file($filePath) && file_exists($filePath);
}

function truncate ($str, $length=10, $trailing='...')
{
/*
** $str -String to truncate
** $length - length to truncate
** $trailing - the trailing character, default: "..."
*/
      // take off chars for the trailing
      $length-=mb_strlen($trailing);
      if (mb_strlen($str)> $length)
      {
         // string exceeded length, truncate and add trailing dots
         return mb_substr($str,0,$length).$trailing;
      }
      else
      {
         // string was already short enough, return the string
         $res = $str;
      }
 
      return $res;
 
}
function clean($string)
{
	$string = str_replace('"', "", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace(" ", "-", $string);
	$string = str_replace("---", "-", $string);
	return $string;
}

function cleanID($string)
{
	$find = array(".",'"','&','+',"'"," ");
	$repl = array('','','','',"","-");

	$string = str_replace($find, $repl , $string);
	$string = str_replace($find, $repl , $string);
	return $string;
}

function ppLink( &$p, $brand )
{
	if( $p->grp !== $p->parent_category && !empty( $p->parent_category ) )
	{
		$url = seoUrl( url( create_slug($p->grp)."/".create_slug($p->parent_category)."/".create_slug($brand->key)."--".create_slug($p->category) ) );
	}
	else
	{
		$url = seoUrl( url( create_slug($p->grp)."/".create_slug($brand->key)."--".create_slug($p->category) ) );
	}

	return $url;
}

function canonical_url()
{
	$canonical_url = str_replace("/amp","",(str_replace('/index.php','',Request::URL())));
	if (strpos($canonical_url, '.html') !== false) {
		$canonical_url = explode(".html", $canonical_url);
		$canonical_url = $canonical_url[0].".html";	
	}
	return $canonical_url;
}
function amp_url()
{
	return str_replace('/index.php','',Request::URL())."/amp";
}

function newUrl( $path = "" )
{
	$showDomain = false;
	$path = str_replace("/index.php","",$path );

	if( $showDomain )
	{
		return url( $path );
	}
	else
	{
		if( $_SERVER['HTTP_HOST'] == "localhost" )
		{
			$base = "/indiashopps/";
		}
		else
		{
			$base = "/";
		}

		if( empty( $path ) || trim($path) == "/" )
		{
			return $base;
		}
		else
		{
			if( $path[0] == "/" )
			{
				return $path;
			}
			else
			{
				return $base.$path;
			}
		}
	}
}
?>
