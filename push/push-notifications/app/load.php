<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Test</title>

<html>
<head>

<title>Test</title>
<meta charset="utf-8" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <script>
$(function(){
    $('a').on('click', function(e){
        e.preventDefault();
        $('<div/>', {'class':'myDlgClass', 'id':'link-'+($(this).index()+1)})
        .load($(this).attr('href')).appendTo('body').dialog();
    });
});
  </script>

</head>
<body>
<a id="openwindow" href="https://www.indiashopps.com/push/push-notifications/app/index.php">Click me to test.</a>
</body>
</html>
