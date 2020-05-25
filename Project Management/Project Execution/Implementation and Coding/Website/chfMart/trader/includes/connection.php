<?php $conn = oci_connect('example', 'new_workspace', '//localhost/xe'); 

if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; } else {
   print "Connected to Oracle!"; 
} 

oci_close($conn); 

?>