<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT keywords as keywords from results where keywords LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['keywords'];
	echo "$cname\n";
}
?>