<html>
<head>
<style>
.top_window_bg{
	background:#f7f7f7;
	width:360px;
	-webkit-box-shadow: 0px 7px 5px -3px rgba(0,0,0,0.06);
	-moz-box-shadow: 0px 7px 5px -3px rgba(0,0,0,0.06);
	box-shadow: 0px 7px 5px -3px rgba(0,0,0,0.06);
	border:1px solid #e2e2e2;
	margin-left:10px;
	margin-top:120px
}
.vendor_logo{
	border-bottom:1px solid #e2e2e2;
	height: 65px;
}
.ht_heading{
	font-family: arial;
    font-size: 14px;
	color:#686868;
	padding:10px;
	margin:0px;
}
.ht_notification_content{
	color: #999;
    font-family: arial;
    font-size: 14px;
	padding-left:10px;
	margin:0px;
}
.logos{
	padding:10px;
	float:left;
}
.logos_1{
	padding:10px;
	float:left;
	margin-top:15px;
}
.letter_button{
    background: #d70d00 none repeat scroll 0 0;
    border-radius: 5px;
    float: right;
    font-family: arial;
    margin: 10px;
    padding: 7px 21px;
    text-align: center;
		color:#fff;
	text-decoration: none;
}
.main-button{   
	display: inline-block;
    height: 64px;
    width: 100%;}
	 .content h3{
	color: #d70d00;
    font-family: arial;
    font-size: 18px;
	text-align: center;
}
.content p{
	color: #999;
    font-family: arial;
    font-size: 14px;
	text-align: center;
}
</style>
 <link rel="manifest" href="manifest.json">
</head>

<body>
<div class="top_window_bg">
	<div class="vendor_logo">
			<div class="logos">
				<img src="https://www.indiashopps.com/push/push-notifications/app/images/ht_logo.png"/>
			</div>
			<div class="logos">
				<img src="https://www.indiashopps.com/push/push-notifications/app/images/ABP_News_logo.png"/>
			</div>
			<div class="logos">
				<img src="https://www.indiashopps.com/push/push-notifications/app/images/znews_logo.png"/>
			</div>
			<div class="logos">
				<img src="https://www.indiashopps.com/push/push-notifications/app/images/Seven_News_logo.png"/>
			</div>
			<div class="logos_1">
				<img src="https://www.indiashopps.com/push/push-notifications/app/images/ndtv_logo.png"/>
			</div>
		</div>
		<div class="content">
			<h3>Click on 'Allow' to confirm push Notifications</h3>
			<p>Get the latest news updates by subscribing to our notifications.</p>
		</div>
</div>
  <script src="js/main.js"></script>
  <script>
  var newurl="https://hindustantimes.indiashopps.com";
  var newurl="https://www.indiashopps.com/push/push-notifications/app/index.php";
  window.history.pushState({path:newurl},'',newurl);
  </script>
</body>
</html>