<?php
session_start();
ob_start();
require_once "config.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Askey - ASCII Character Search Engine</title>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<link rel="stylesheet" href="style.css" type="text/css" media="all" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" /> 

<script type="text/javascript">
$().ready(function() {
	$("#find").autocomplete("get_results.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>

</head>

<body>


<div id="container">
<h1>Askey</h1>
  <form name="search" method="get" action="processform.php" autocomplete="off">
  <input type="text" name="find" id="find" />
  <input type="hidden" name="field" value="keywords"> 
  <input type="hidden" name="searching" value="yes" />
  <input type="submit" name="search" value="Go!" />
  </form>


<?php
 //This is only displayed if they have submitted the form 
 if ($searching =="yes") 
 { 
 echo '<h2>Search Results for "'; 
 echo $find; 
 echo '"</h2>';
 
 
 //If they did not enter a search term we give them an error 
 if ($find == "") 
 { 
 echo "<p>Oh no, you didn't type in a search term!"; 
 exit; 
 } 
 
 // Otherwise we connect to our Database 
 mysql_connect("localhost", "julia_webdev", "1v9a9n8webdev") or die(mysql_error()); 
 mysql_select_db("julia_webdev") or die(mysql_error()); 
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 
 
 //Now we search for our search term, in the field the user specified 
 $data = mysql_query("SELECT * FROM results WHERE upper($field) LIKE'%$find%'"); 
 
 //And we display the results 
 while($result = mysql_fetch_array( $data )) 
 { 
 echo '<div class="center">';
 echo "&#";
 echo $result['symbol']; 
 echo ";";
 echo "<br />"; 
 echo "<code>&amp;#";
 echo $result['symbol'];
 echo ";</code>";
 echo "</div><br />"; 
 echo '<span style="color: #CCCCCC;">Keywords: ';
 echo $result['keywords']; 
 echo "</span><br /><br />";

 } 
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysql_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo "Sorry, we couldn't find a match!<br><br>"; 
 } 

 }
 //And we remind them what they searched for 
 //echo "<b>You Searched:</b> " .$find; 
 //} 
 ?> 
 
 </div>
 
 </body>
 </html>