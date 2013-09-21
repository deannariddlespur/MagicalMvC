<?php
// Make a MySQL Connection
$dbhost = "cis1110.db.2177912.hostedresource.com";
 $dbuser = "cis1110";
 $dbpassword = "Eagles#1";
 $dbdatabase = "cis1110"; 
 
mysql_connect("cis1110.db.2177912.hostedresource.com", "cis1110", "Eagles#1") or die(mysql_error());
mysql_select_db("cis1110") or die(mysql_error());


// Insert a row of information into the table
mysql_query("INSERT INTO  d_riddlespur_DR_table (doctorId, doctorFirstName, doctorLastName, doctorSpecialty)
VALUES(1021, 'Paul', 'Miller', ' eyes migraine headaches-Brain Specialist') ") 
or die(mysql_error()); 

mysql_query("INSERT INTO  d_riddlespur_DR_table (doctorId, doctorFirstName, doctorLastName, doctorSpecialty)
VALUES(1052, 'Zane', 'Riddlespur', 'heart-Cardiology Specialist') ") 
or die(mysql_error()); 

mysql_query("INSERT INTO  d_riddlespur_DR_table (doctorId, doctorFirstName, doctorLastName, doctorSpecialty)
VALUES (1063, 'CIndy', 'Lauper', 'bone and joint- rheumatologist Specialist') ") 

or die(mysql_error());
echo "Data Inserted!";

?> 



