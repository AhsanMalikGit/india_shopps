<?php 
@session_start();
require_once("conn.php");
	# Check for session timeout, else initiliaze time
	if (isset($_SESSION['timeout_g'])) {	
		# Check Session Time for expiry
		#
		# Time is in seconds. 10 * 60 = 600s = 10 minutes
		if ($_SESSION['timeout_g'] + 24 * 60 * 60 < time()){
			session_destroy();
		}
	}
	else {
		# Initialize variables
		$_SESSION['user_g']="";
		$_SESSION['pass_g']="";
		$_SESSION['timeout_g']=time();
	}

	# Store POST data in session variables
	if (isset($_POST["user"])) {	
		$_SESSION['user_g'] = $_POST['user'];
		$_SESSION['pass_g'] = hash('sha256',$_POST['pass']);
	}
if($_SESSION['user_g'] == "gamesBot"	&& $_SESSION['pass_g'] == "4089351df054975446a78435bf382e196b4101d1596d130ada14e6cdd324a252")
{	


if(isset($_GET['date']))
{
	$date = mysql_real_escape_string($_GET['date']);
	$sql="SELECT ip_address, date_format(`date`,'%d-%m-%Y %H:%i:%s') FROM `bitly_install` WHERE  date_format(`date`,'%d-%m-%Y') = '".$date."' order by date asc";
	$res = mysql_query($sql) or die(mysql_error());
	
	echo "<br><br>";
	echo "<table border=1 cellpadding=4 style='border-collapse: collapse;'>";
	echo "<TR><TH>ID</TH><TH>IP Address</TH><TH>Date</TH></TR>";
	$i=1;
	while($row = mysql_fetch_row($res))
	{
		
		echo "<TR><TD>".$i++."</TD><TD>".$row[0]."</TD><TD>".$row[1]."</TD></TR>";
	}
	echo "</table>";

}else{

	$sql="SELECT count(*), date_format(`date`,'%d-%m-%Y') FROM `bitly_install` WHERE   date_format(`date`,'%m') = month(curdate()) and date_format(`date`,'%Y') = year(curdate()) group by date_format(`date`,'%d-%m-%Y') order by date desc";
	$res = mysql_query($sql) or die(mysql_error());	

	echo "<br><br>";
	echo "<table border=1 cellpadding=4 style='border-collapse: collapse;'>";
	echo "<TR><TH>No. of Installs</TH><TH>Date</TH></TR>";
	while($row = mysql_fetch_row($res))
	{	
		echo "<TR><TD>".$row[0]."</TD><TD><a href='http://www.yourshoppingwizard.com/ext/install_report.php?date=".$row[1]."'>".$row[1]."</a></TD></TR>";
	}
	echo "</table>";
}
}
	else
	{
		# Show login form. Request for username and password
		{?>
			<html>
			<body>		
				<form method="POST" action="">
					Username: <input type="text" name="user"><br/>
					Password: <input type="password" name="pass"><br/>
					<input type="submit" name="submit" value="Login">
				</form>
			</body>
			</html>	
		<?}
	}
?>
