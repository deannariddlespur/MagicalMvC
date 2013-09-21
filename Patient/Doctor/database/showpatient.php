<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Show Students</title>
</head>
<body>
<p>
<?php 
 
$conn  = mysql_connect("cis1110.db.2177912.hostedresource.com", "cis1110", "Eagles#1", "dRiddlespurStudentsTable") or die(mysql_error());
$select = mysql_select_db("cis1110", $conn);
$sql = "SELECT * FROM   d_riddlespur_patient_table";
$result = mysql_query($sql) or die(mysql_error());
while ($row = mysql_fetch_assoc($result)){

  foreach($row as $key=>$value){
    print "$key: $value<br />\n";
  } // end foreach
  print "<br />\n";
  
} // end while



?>
</p>
</body>
</html>

 



