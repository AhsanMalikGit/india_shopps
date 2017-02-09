<?php 
$server = 'localhost';
$login = 'wwwindia_admin'; 
$password = 'yTxAQ}x^_RS)'; 
$db = 'wwwindia_extension';  
// establish database connection
$conn1 = mysqli_connect($server, $login, $password,$db) or die(mysql_error());
$get = $_REQUEST;
//print_r($get);exit;
if(isset($get['action']))
{
	if($get['action'] == 'remove')
	{
		if(isset( $get['email']) && isset( $get['product_id'])&& isset( $get['vendor']))
		{
			$email 		= $get['email'];
			$vendor 	= $get['vendor'];
			$pid		= $get['product_id'];

			$sql = "select * from gc_price_watch1 where email like '$email' and vendor = $vendor and product_id like '$pid'";
			$res = mysqli_query($conn1,$sql);
			if(mysqli_num_rows($res) >0)
			{
				$updt = "update gc_price_watch1 set active=0 where email like '$email' and vendor = $vendor and product_id like '$pid' ";
				mysqli_query($conn1,$updt);
				$keycode = "100";
				$message = "Done.";
				$res = array('keycode'=>$keycode,'status'=>true,'message'=>$message);
				echo json_encode($res);
			}
		}
	}
	else if($get['action'] == 'add' && isset( $get['email'])&& isset( $get['vendor']) && isset( $get['product_id']) && $get['email'] !='' && $get['product_id'] !='')
{
	$email = $save['email'] = $get['email'];
	$save['vendor'] 		= $get['vendor'];
	$save['product_id'] 	= $get['product_id'];
	$save['price_added'] 	= $get['price_added'];
	$save['price_seen'] 	= $get['price_added'];
	//$save['inStock'] 		= 1;
	$save['toSend'] 		= 1;
	$date 					= date_create();
	$save['added_date'] 	= date_format($date,"Y-m-d H:i:s");
	$save['active'] 		= 1;
	$save['source'] 		= 1;

	
	$sql2 = "select * from gc_price_watch1 where email like '$email' and product_id='".$save['product_id']."' and vendor=".$save['vendor'];
	$res2 = mysqli_query($conn1,$sql2);
	if(mysqli_num_rows($res2) ==0)
	{
		$field='';$values='';
		$sql = "insert into gc_price_watch1 (";
		foreach($save as $key=>$val){
			$field .= "`".mysqli_real_escape_string($conn1,$key)."`,";
			$values .= "'".mysqli_real_escape_string($conn1,$val)."',";
		}
		$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
		//echo $sql."<br><br>";exit;		
		mysqli_query($conn1,$sql);
		$keycode = "100";
		$message = "Done.";
		$res = array('keycode'=>$keycode,'status'=>true,'message'=>$message);
		echo json_encode($res);
	}else{
		
		$row2 = mysqli_fetch_object($res2);
		//print_r($row2);exit;
		if($row2->active == 1)
		{
			$keycode = "200";
			$message = "Already Existed.";
			$res = array('keycode'=>$keycode,'status'=>false,'message'=>$message);
			echo json_encode($res);exit;
		}else{
			$sql4 = "update gc_price_watch1 set active=1 where email like '$email' and product_id='".$save['product_id']."' and vendor=".$save['vendor'];
			mysqli_query($conn1,$sql4);
			$keycode = "100";
			$message = "Done.";
			$res = array('keycode'=>$keycode,'status'=>true,'message'=>$message);
			echo json_encode($res);
		}		
	}
		
	$sql1 = "select * from gc_user_email where email like '$email'";
	$res1 = mysqli_query($conn1,$sql1);
	if(mysqli_num_rows($res1) ==0)
	{
		$ins = "insert into gc_user_email values ('$email',0)";
		mysqli_query($conn1,$ins);
		//echo 1;
	}
	$row = mysqli_fetch_row($res1);
	//print_r($row);exit;
	if($row[1] == 0)
	{
		
		$trick = "dealzunli_Niti08-12-87".$email;
		$trick = md5($trick);
		$trick = md5($trick);
		$verLink = "http://www.indiashopps.com/ext/price_watch/email_verify.php?code=".$trick."&email=".$email;
		$verification = '<td colspan="3" height="40" width="250" bgcolor="#CC3714" style="text-align:center"><a href="'.$verLink.'" target="_blank" style="color:white;text-decoration:none;font-weight:bold;">Verify Email</a></td>';
		 $message = <<<EOD

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Price Drop Alert</title>
</head>

<body style="margin:0; padding:0;">
<table width="100%" bgcolor="#f2f2f2" style="font-size:15px;font-family:Arial, Helvetica, sans-serif">
    <tbody>
    <tr>
        <td>
        <table width="600" align="center" valign="top">
          <tbody>
              <tr>
                  <td colspan="3">                      
                    </td>                    
                </tr>
                <tr>
                  <td colspan="2" width="200" height="60"><a href="http://www.indiashopps.com/" target="_blank">
                      <img src="http://www.indiashopps.com/images/logo1.jpg" alt="www.indiashopps.com" width="200" height="88" style="display:block"/></a>
                    </td>
                   
                    <td colspan="1" width="150" height="60" style="font-size:10px;text-align:right">
                    </td>               
                </tr>
               
                <tr>
                  <td colspan="3">
                    <table  align="center" valign="top" bgcolor="#FFFFFF" width="580" style="border-radius:10px;color:#333">
                    <tbody>
                      <tr>
                          <td colspan="5" height="10"></td>
                        </tr>
                        
                        <tr>
                          <td colspan="5" height="10"></td>
                        </tr>
                        <tr>
                          
                            <td colspan="5">
                            <table>
                                <tbody>
                                    <tr>
                                    <td height="5"></td>
                                    </tr><tr>
                                    $verification
                                     
                                    </tr><tr>
                          <td colspan="5" height="10"></td>
                        </tr><tr>
                          <td colspan="5" height="10"><Strong>Thanks for using Indiashopps Price Watcher. </Strong></td></tr>
                         <tr> <td colspan="5" height="10"><Strong>Click the link above to verify your Email-Id. </Strong></td>
                        </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                                    <tr>
                                    <td height="15"></td>
                                    </tr>
                      
                        <tr>
                          <td height="30" colspan="5"></td>
                        </tr>
                    </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
              
            </tbody>
        </table>
        </td>
        </tr>    
    </tbody>
</table>
</body>
</html>


EOD;
  //  echo $message;exit;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Indiashopps Email Verification For Price Alert<pricealert@indiashopps.com>' . "\r\n";
    $headers .= 'Reply-To: pricealert@indiashopps.com' . "\r\n";
   mail($email, 'Indiashopps Price Alert Verify Email', $message, $headers);

	
	}
	
	
 }
	
}
